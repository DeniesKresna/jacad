<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\ApiController;
use App\Models\AcademyPeriod;
use App\Models\AcademyPeriodCustomer;
use App\Models\Payment;

class AcademyPeriodController extends ApiController
{
    public function index(Request $request) {
        $page = $request->page;
        $page_size = $request->page_size;
        $search = $request->search;
        $active= $request->active;

        $academy_periods= AcademyPeriod::with(['academy', 'creator'])
            ->when($request->has('search') && $search, function($query) use ($search) {
                $query->whereHas('academy', function($query) use ($search) {
                            $query->where('academies.name', 'LIKE', '%'.$search.'%');
                      })
                      ->orWhereHas('creator', function($query) use ($search) {
                          $query->where('users.name', 'LIKE', '%'.$search.'%');
                      });
            })
            ->when($request->has('active'), function($query) use ($active) {
                $query->where('active', $active);
            })
            ->orderBy('id', 'desc')
            ->paginate($page_size);

        return response()->json($academy_periods);
    }

    public function show($id) {
        $academy_period= AcademyPeriod::with(['academy', 'mentors'])->findOrFail($id);

        return response()->json($academy_period);
    }

    public function store(Request $request) {
        $datas= $request->all();
        $datas['mentors']= json_decode($datas['mentors']);
        $datas['creator_id']= 1;
        $datas['active']= 0;

        $validator= Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 422);
        }

        $academy_period= AcademyPeriod::create($datas);
        $academy_period->mentors()->attach($datas['mentors']);
        
        if (!$academy_period->save()) {
            return response()->json(['message' => 'Create academy period failed'], 500);
        }

        return response()->json(['message' => "Academy period {$academy_period->period} created!"]);
    }

    public function update(Request $request, $id) {
        $datas= $request->all();
        $datas['updater_id']= 1;

        $validator= Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 422);
        }

        $academy_period= AcademyPeriod::findOrFail($id);
        $academy_period->update($datas);
        $academy_period->mentors()->sync($datas['mentors']);
        
        if (!$academy_period->save()) {
            return response()->json(['message' => 'Update academy period failed'], 500);
        }

        return response()->json(['message' => "Academy period {$academy_period->period} updated!"]);
    }

    public function destroy(Request $request, $id) {
        $academy_period= AcademyPeriod::findOrFail($id);
        $academy_period->delete();

        if (!$academy_period->save()) {
            return response()->json(['message' => 'Delete academy period failed'], 500);
        }

        return response()->json(['message' => "Academy period {$academy_period->period} deleted!"]);
    }

    public function activate($id) {
        $academy_period= AcademyPeriod::with('academy')->findOrFail($id);
        $status= '';

        $deactivate_other_periods= AcademyPeriod::whereHas('academy', function($query) use ($academy_period) {
            $query->where('name', $academy_period->academy->name);
        })
        ->update(['active' => 0, 'updater_id' => 1]);

        if (!$deactivate_other_periods) {
            return response()->json(['message' => 'Deactivate other periods failed'], 500);
        }

        if ($academy_period->active == 0) {
            $academy_period->active= 1;
            $status= 'activated';
        }  else  {
            $academy_period->active= 0;
            $status= 'deactivated';    
        }

        if (!$academy_period->save()) {
            return response()->json(['message' => 'Activate period failed'], 500);
        }

        return response()->json(['message' => "Academy period {$academy_period->period} {$status}!"]);
    }

    public function getCustomers(Request $request) {
        $page = $request->page;
        $page_size = $request->page_size;
        $search = $request->search; 
        $status= $request->status;
    
        $period_customers= DB::table('academy_period_customer')
            ->join('academy_periods', 'academy_periods.id', 'academy_period_customer.academy_period_id')
            ->join('academies', 'academies.id', 'academy_periods.academy_id')
            ->join('users', 'users.id', 'academy_period_customer.customer_id')
            ->when($request->has('search') && $search, function($query) use ($search) {
                $query->where('academies.name', 'like', '%'.$search.'%')
                      ->orWhere('users.name', 'like', '%'.$search.'%');
            })
            ->when($request->has('status'), function($query) use ($status) {
                $query->where('academy_period_customer.status', $status);
            })
            ->orderBy('academy_period_customer.id', 'desc')
            ->select(
                'academy_periods.id as id',
                'academies.name as academy_name', 
                'academy_periods.period as academy_period', 
                'users.name as customer_name', 
                'academy_period_customer.price as price', 
                'academy_period_customer.description as description', 
                'academy_period_customer.payment_id as payment_id',
                'academy_period_customer.status as status'
            )
            ->paginate($page_size);
        
        return response()->json($period_customers);
    }

    public function destroyCustomer($id) {
        $academy_period_customer= AcademyPeriodCustomer::findOrFail($id);

        if (in_array($academy_period_customer->status, [1, 2])) {
            return response()->json(['message' => 'Delete academy period customer failed, because already paid'], 409);
        }

        if ($academy_period_customer->delete() === 0) {
            return response()->json(['message' => 'Delete academy period customer failed'], 500);
        }

        return response()->json(['message' => 'Academy period customer deleted!']);
    }
}
