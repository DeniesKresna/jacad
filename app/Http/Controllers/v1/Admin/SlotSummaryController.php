<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Device;
use App\Models\DeviceSchedule;
use App\Models\LayoutBox;
use App\Models\SlotImpression;
use App\Models\SlotSummary;
use Illuminate\Support\Facades\DB;

class SlotSummaryController extends ApiController
{
    public function index(Request $request) {
        $page = !empty($request->page)?$request->page:1;
        $page_size = !empty($request->page_size)?$request->page_size:10;
        $search = $request->search;
        $datas = SlotSummary::with("device","campaign","guaranteed","device_line","content");
        $datas = $datas->where(function($query) use($search){
            $query->where('date','like','%'.$search.'%');
        });
        if(!empty($request->imei))
            $datas = $datas->where('imei','=',$request->imei);
        $datas = $datas->orderBy('id', 'desc')->paginate($page_size, ["*"], "page", $page);
        $data = [
            "total"=>$datas->total(),
            "page_size"=>$datas->perPage(),
            "page"=>$datas->currentPage(),
            "result"=>$datas->items(),
            "previous_page_url" => $datas->previousPageUrl(),
            "next_page_url" => $datas->nextPageUrl(),
        ];
        return self::success_responses($data);
    }

}
