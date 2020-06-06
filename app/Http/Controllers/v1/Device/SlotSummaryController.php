<?php

namespace App\Http\Controllers\v1\Device;

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

    public function generatePerHourDate(Request $request)
    {
        set_time_limit(0);
        $date = !empty($request->date) ? $request->date : date("Y-m-d");
        $hour = !empty($request->hour) ? $request->hour : date("H", strtotime("-1 hour"));
        $slot_impressions = DB::table('slot_impressions')
            ->where('play_start_time', 'like', $date . " " . $hour . '%')
            ->orderBy("play_start_time", "asc")
            ->get();
        if ($slot_impressions) {
            $result = [];
            foreach ($slot_impressions as $row) {
                $time_interval = abs(strtotime($row->play_start_time) - strtotime($row->play_end_time));
                $result[$row->content_id . "_" . $row->imei]["content_id"] = $row->content_id;
                $result[$row->content_id . "_" . $row->imei]["campaign_id"] = $row->campaign_id;
                $result[$row->content_id . "_" . $row->imei]["date"] = $date;
                $result[$row->content_id . "_" . $row->imei]["hour"] = $hour;
                $result[$row->content_id . "_" . $row->imei]["device_id"] = $row->device_id;
                $result[$row->content_id . "_" . $row->imei]["device_line_id"] = $row->device_line_id;
                $result[$row->content_id . "_" . $row->imei]["imei"] = $row->imei;
                if (!isset($result[$row->content_id . "_" . $row->imei]["play_count"]))
                    $result[$row->content_id . "_" . $row->imei]["play_count"] = 0;
                else
                    $result[$row->content_id . "_" . $row->imei]["play_count"] += 1;
                if (!isset($result[$row->content_id . "_" . $row->imei]["play_time"]))
                    $result[$row->content_id . "_" . $row->imei]["play_time"] = 0;
                else
                    $result[$row->content_id . "_" . $row->imei]["play_time"] += $time_interval;
            }
            foreach (to_object($result) as $row) {
                $find = DB::table('slot_summaries')
                    ->where("date", $row->date)
                    ->where("hour", $row->hour)
                    ->where("content_id", $row->content_id)
                    ->where("imei", $row->imei)
                    ->first();
                if ($find) {
                    DB::table('slot_summaries')
                        ->where("date", $row->date)
                        ->where("hour", $row->hour)
                        ->where("content_id", $row->content_id)
                        ->where("imei", $row->imei)
                        ->update(to_array($row));
                } else {
                    DB::table('slot_summaries')->insert(to_array($row));
                }
            }
            return response()->json(['status' => 'ok']);
        }
        return response()->json(['status' => 'not-ok']);
    }


    public function generateDailyPerHourDate(Request $request)
    {
        set_time_limit(0);
        $date = !empty($request->date) ? $request->date : date("Y-m-d");
        $slot_impressions = DB::table('slot_impressions')
            ->where('play_start_time', 'like', $date . '%')
            ->orderBy("play_start_time", "asc")
            ->get();
        if ($slot_impressions) {
            $result = [];
            foreach ($slot_impressions as $row) {
                $hour = date("H", strtotime($row->play_start_time));
                $time_interval = abs(strtotime($row->play_start_time) - strtotime($row->play_end_time));
                if(!empty($row->guaranteed_id)){
                    $row->campaign_id = 0;
                } else {
                    $row->guaranteed_id = 0;
                }
                $key = $hour . "_" . $row->content_id . "_" . $row->imei . "_" . $row->campaign_id . "_" . $row->guaranteed_id;
                $result[$key]["content_id"] = $row->content_id;
                $result[$key]["campaign_id"] = $row->campaign_id;
                $result[$key]["guaranteed_id"] = $row->guaranteed_id;
                $result[$key]["guaranteed"] = $row->guaranteed;
                $result[$key]["date"] = $date;
                $result[$key]["hour"] = $hour;
                $result[$key]["device_id"] = $row->device_id;
                $result[$key]["device_line_id"] = $row->device_line_id;
                $result[$key]["imei"] = $row->imei;
                if (!isset($result[$key]["play_count"]))
                    $result[$key]["play_count"] = 0;
                else
                    $result[$key]["play_count"] += 1;
                if (!isset($result[$key]["play_time"]))
                    $result[$key]["play_time"] = 0;
                else
                    $result[$key]["play_time"] += $time_interval;
            }
            foreach (to_object($result) as $row) {
                $find = DB::table('slot_summaries')
                    ->where("date", $row->date)
                    ->where("hour", $row->hour)
                    ->where("guaranteed_id", $row->content_id)
                    ->where("campaign_id", $row->content_id)
                    ->where("content_id", $row->content_id)
                    ->where("imei", $row->imei)
                    ->first();
                if ($find) {
                    DB::table('slot_summaries')
                        ->where("date", $row->date)
                        ->where("hour", $row->hour)
                        ->where("guaranteed_id", $row->content_id)
                        ->where("campaign_id", $row->content_id)
                        ->where("content_id", $row->content_id)
                        ->where("imei", $row->imei)
                        ->update(to_array($row));
                } else {
                    DB::table('slot_summaries')->insert(to_array($row));
                }
            }
            return response()->json(['status' => 'ok']);
        }
        return response()->json(['status' => 'not-ok']);
    }
}
