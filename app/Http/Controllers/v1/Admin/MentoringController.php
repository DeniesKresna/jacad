<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;

use App\Models\Mentoring;

class MentoringController extends ApiController
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
        $mentorings= Mentoring::with(['creator', 'ask_career'])->when($request->has('search') && $request->search, function($query) use ($search) {
            $query->whereHas('ask_career', function($query) use ($search) {
                $query->where('ask_careers.name', 'like', '%'.$search.'%')
                    ->orWhereHas('mentor', function($query) use ($search) {
                        $query->where('mentors.name', 'like', '%'.$search.'%');
                    });
            })->orWhereHas('creator', function($query) use ($search) {
                $query->where('users.name', 'like', '%'.$search.'%');
            });
        })->orderBy('id', 'desc')
        ->paginate($page_size);

        return response()->json($mentorings);
    }

    public function show($id) {
        $mentoring= Mentoring::with(['ask_career', 'creator'])->findOrFail($id);

        return response()->json($mentoring);
    }

    public function update(Request $request, $id) {
        $datas= $request->all();
        $datas['updater_id']= 1;

        return response()->json();
    }
}
