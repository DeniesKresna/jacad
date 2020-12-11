<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\ApiController;
use App\Models\AcademyPeriod;

class AcademyPeriodController extends ApiController
{
    public function index(Request $request) {
        $page = $request->page;
        $page_size = $request->page_size;
        $search = $request->search;
        $active= $request->active;

        $academy_periods= AcademyPeriod::when($request->has('search') && $search, function($query) use ($search) {
            $query->where('period', 'like', '%'.$search.'%')
                    ->orWhereHas('academy_class', function($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
            });
        })->when($request->has('active'), function($query) use ($active) {
            $query->where('active', $active);
        })->with('academy_class')
        ->orderBy('id', 'desc')
        ->paginate($page_size);

        return response()->json($academy_periods);
    }

    public function show($id) {
        $academy_period= AcademyPeriod::with('academy_class')->findOrFail($id);

        return response()->json($academy_period);
    }

    public function store(Request $request) {
        $datas= $request->all();
        $datas['creator_id']= 1;
        $datas['active']= 0;

        $validator= Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__), [
            'period.required' => 'Kolom periode harus diisi',
            'price.required' => 'Kolom harga harus diisi',
            'description.required' => 'Kolom deskripsi harus diisi',
            'academy_id.not_in' => 'Kolom akademi harus diisi'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 422);
        }

        $academy_period= AcademyPeriod::create($datas);
        $academy_period->save();

        if ($academy_period) {
            return response()->json(['message' => 'Berhasil menyimpan Academy Period!']);
        } else {
            return response()->json(['message' => 'Terjadi kendala, silahkan hubungi teknisi']);
        }
    }

    public function update(Request $request, $id) {
        $datas= $request->all();
        $datas['updater_id']= 1;

        $academy_period= AcademyPeriod::with('academy_class')->findOrFail($id);

        if ($request->has('activate')) {
            $status= '';
            
            AcademyPeriod::whereHas('academy_class', function($query) use ($academy_period) {
                $query->where('name', $academy_period->academy_class->name);
            })->update([
                'active' => 0,
                'updater_id' => $datas['updater_id']
            ]);

            if ($academy_period->active == 0) {
                $academy_period->active= 1;
                $status= 'diaktifkan';
            }  else  {
                $academy_period->active= 0;
                $status= 'dinon-aktifkan';    
            }

            $academy_period->save();

            if ($academy_period) {
                return response()->json(['message' => 'Berhasil '.$status.'!']);
            } else {
                return response()->json(['message' => 'Terjadi kendala, silahkan hubungi teknisi'], 400);
            }
        }

        $validator= Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__), [
            'period.required' => 'Kolom periode harus diisi',
            'price.required' => 'Kolom harga harus diisi',
            'description.required' => 'Kolom deskripsi harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 422);
        }

        $academy_period->update($datas);
        $academy_period->save();

        if ($academy_period) {
            return response()->json(['message' => 'Berhasil menyimpan perubahan!']);
        } else {
            return response()->json(['message' => 'Terjadi kendala, silahkan hubungi teknisi'], 400);
        }
    }

    public function destroy(Request $request, $id) {
        $academy_period= AcademyPeriod::findOrFail($id);

        $academy_period->delete();
        $academy_period->save();

        if ($academy_period) {
            return response()->json(['message' => 'Berhasil terhapus!']);
        } else {
            return response()->json(['message' => 'Terjadi kendala, silahkan hubungi teknisi']);
        }
    }

    public function getPeriodCustomers(Request $request) {
        $page = $request->page;
        $page_size = $request->page_size;
        $search = $request->search; 
        $status= $request->status;

        /*$period_customers= AcademyPeriod::whereHas('period_customers')
            ->with('period_customers')
            ->orderBy('id', 'desc')
            ->get()
            ->pluck('period_customers')
            ->first();

        foreach ($period_customers as $key => $period_customer) {
            $period_customer->academy_class= AcademyPeriod::with('academy_class')->findOrFail($period_customer->pivot->academy_period_id)->academy_class;
        }*/
        
        $period_customers= DB::table('academy_period_customer')
            ->join('academy_periods', 'academy_periods.id', 'academy_period_customer.academy_period_id')
            ->join('academies', 'academies.id', 'academy_periods.academy_id')
            ->join('users', 'users.id', 'academy_period_customer.customer_id')
            ->when($request->has('search') && $search, function($query) use ($search) {
                $query->where('academies.name', 'like', '%'.$search.'%')
                    ->orWhere('users.name', 'like', '%'.$search.'%');
            })->when($request->has('status'), function($query) use ($status) {
                $query->where('academy_period_customer.status', $status);
            })->select(
                'academies.name as academy_name', 
                'academy_periods.period as academy_period', 
                'users.name as customer_name', 
                'academy_period_customer.price as price', 
                'academy_period_customer.description as description', 
                'academy_period_customer.status as status'
            )->orderBy('academy_period_customer.id', 'desc')
            ->paginate($page_size);
        
        return response()->json($period_customers);
    }
}
