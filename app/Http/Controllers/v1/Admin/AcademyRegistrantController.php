<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use App\Models\AcademyRegistrant;

class AcademyRegistrantController extends ApiController
{
    public function index(Request $request) {
        $page_size = $request->page_size;
        $academy_registrants= AcademyRegistrant::where('id', '>', 0);

        if ($request->has('search') && $request->search) {
            $search= $request->search;
            $academy_registrants= $academy_registrants
                ->where('name', 'like', '%'.$search.'%')
                ->orWhereHas('academy', function($query) use ($search) {
                    $query->where('academies.name', 'like', '%'.$search.'%');
                });
        }

        $academy_registrants= $academy_registrants
            ->with('academy')
            ->orderBy('id', 'desc')
            ->paginate($page_size);

        return response()->json($academy_registrants);
    }

    public function show($id) {
        $academy_registrant= AcademyRegistrant::findOrFail($id);

        return response()->json($academy_registrant);
    }
}
