<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\ApiController;
use App\Models\AskCareer;
use App\Models\Mentoring;

class AskCareerController extends ApiController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $page = $request->page;
        $page_size = $request->page_size;
        $search= $request->search;

        $ask_careers= AskCareer::with('mentor')
            ->when($request->has('search') && $request->search, function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%')
                      ->orWhereHas('mentor', function ($query) use ($search) {
                        $query->where('name', 'like', '%'.$search.'%');
                      });
            })
            ->orderBy('id', 'DESC')
            ->paginate($page_size);
        
        return response()->json($ask_careers);
    }

    public function show($id) {
        $ask_career= AskCareer::with('mentor')->findOrFail($id);

        return response()->json($ask_career);
    }

    public function store(Request $request) {
        $datas= $request->all();
        $datas['creator_id']= 1;
        
        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 422);
        }

        $ask_career= AskCareer::create($datas);
        $ask_career->mentor()->associate($datas['mentor']);
        
        if (!$ask_career->save()) {
            return response()->json(['message' => 'Create ask career failed'], 500);
        }

        return response()->json(['message' => "Ask Career {$ask_career->name} created!"]);
    }
    
    public function update(Request $request, $id) {
        $datas= $request->all();
        $datas['updater_id']= 1;    

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 422);
        }

        $ask_career= AskCareer::findOrFail($id);
        $ask_career->update($datas);
        $ask_career->mentor()->associate($datas['mentor']);
        
        if (!$ask_career->save()) {
            return response()->json(['message' => 'Update ask career failed'], 500);
        }

        return response()->json(['message' => "Ask Career {$ask_career->name} updated!"]);
    }

    public function destroy(Request $request, $id) {
        $ask_career= AskCareer::findOrFail($id);
        
        if ($request->has('hard')) {
            if (filter_var(request()->hard, FILTER_VALIDATE_BOOLEAN)) {
                $ask_career->forceDelete();
                
                return response()->json(['message' => "Ask Career {$ask_career->name} permanently deleted!"]);
            }
        }
        
        $ask_career->delete();

        if (!$ask_career->save()) {
            return response()->json(['message' => 'Delete ask career failed'], 500);
        }

        return response()->json(['message' => "Ask Career {$ask_career->name} deleted!"]);
    }

    public function getAskCareerCustomer(Request $request) {
        $page = $request->page;
        $page_size = $request->page_size;
        $search= $request->search;
        
        $mentorings= Mentoring::with(['creator', 'ask_career'])
            ->when($request->has('search') && $request->search, function($query) use ($search) {
                    $query->whereHas('ask_career', function($query) use ($search) {
                        $query->where('ask_careers.name', 'like', '%'.$search.'%')
                              ->orWhereHas('mentor', function($query) use ($search) {
                                $query->where('mentors.name', 'like', '%'.$search.'%');
                              });
                    })
                    ->orWhereHas('creator', function($query) use ($search) {
                        $query->where('users.name', 'like', '%'.$search.'%');
                    });
            })
            ->orderBy('id', 'desc')
            ->paginate($page_size);

        return response()->json($mentorings);
    }
}
