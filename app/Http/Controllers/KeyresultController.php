<?php

namespace App\Http\Controllers;
use App\Helpers\Cmf;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organization;
use App\Models\Epic;
use App\Models\activities;
use App\Models\attachments;
use App\Models\flag_members;
use App\Models\flags;
use App\Models\flag_comments;
use App\Models\escalate_cards;
use App\Models\key_result;
use App\Models\key_chart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;

class KeyresultController extends Controller
{
    public function getkeyresult(Request $request)
    {
        $data = key_result::find($request->id);
        $html = view('keyresult.modal', compact('data'))->render();
        return $html;
    }
    public function updategeneral(Request $request)
    {
        $data = key_result::find($request->id);
        $data->key_name = $request->key_name;
        $data->key_start_date = $request->key_start_date;
        $data->key_end_date = $request->key_end_date;
        $data->key_detail = $request->key_detail;
        $data->save();

        if(!$request->key_name)
        {
            $update = key_result::find($request->id);
            $update->trash = $data->created_at;
            $update->save(); 
        }else{
            $update = key_result::find($request->id);
            $update->trash = Null;
            $update->save(); 
        }


        if ($data->type == "unit") {
            $organization = DB::table("business_units")
                ->where("id", $data->unit_id)
                ->first();
            $objective = DB::table("objectives")
                ->where("unit_id", $data->unit_id)
                ->where("trash", null)
                ->where("type", "unit")
                ->get();
        }

        if ($data->type == "stream") {
            $organization = DB::table("value_stream")
                ->where("id", $data->unit_id)
                ->first();
            $objective = DB::table("objectives")
                ->where("unit_id", $data->unit_id)
                ->where("trash", null)
                ->where("type", "stream")
                ->get();
        }

        if ($data->type == "BU") {
            $organization = DB::table("unit_team")
                ->where("id", $data->unit_id)
                ->first();
            $objective = DB::table("objectives")
                ->where("unit_id", $data->unit_id)
                ->where("trash", null)
                ->where("type", "BU")
                ->get();
        }

        if ($data->type == "VS") {
            $organization = DB::table("value_team")
                ->where("id", $data->unit_id)
                ->first();
            $objective = DB::table("objectives")
                ->where("unit_id", $data->unit_id)
                ->where("trash", null)
                ->where("type", "VS")
                ->get();
        }

        if ($data->type == "org") {
            $organization = DB::table("organization")
                ->where("id", $data->unit_id)
                ->first();
            $objective = DB::table("objectives")
                ->where("unit_id", $data->unit_id)
                ->where("trash", null)
                ->where("type", "org")
                ->get();
        }

        if ($data->type == "orgT") {
            $organization = DB::table("org_team")
                ->where("id", $data->unit_id)
                ->first();
            $objective = DB::table("objectives")
                ->where("unit_id", $data->unit_id)
                ->where("trash", null)
                ->where("type", "orgT")
                ->get();
        }


        return view(
            "objective.objective-render",
            compact("organization", "objective")
        );


    }
    public function showheader(Request $request)
    {
        $data = key_result::find($request->id);
        $html = view('keyresult.modalheader', compact('data'))->render();
        return $html;
    }
    public function showtab(Request $request)
    {
        if($request->tab == 'general')
        {
            $data = key_result::find($request->id);

            $html = view('keyresult.tabs.general', compact('data'))->render();
            return $html;
        }
        if($request->tab == 'targets')
        {
            $data = key_result::find($request->id);
            $html = view('keyresult.tabs.target', compact('data'))->render();
            return $html;
        }
        if($request->tab == 'values')
        {
            $data = key_result::find($request->id);
            $report = DB::table('sprint')->where('user_id',Auth::id())->where('status',NULL)->where('value_unit_id',$data->unit_id)->first();
            if($report)
            {
                $KEYChart =  DB::table('key_chart')->where('key_id',$request->id)->where('IndexCount',$report->IndexCount)->first();
                if(!$KEYChart)
                {

                }
                $key = key_result::find($request->id);
                $keyQAll = DB::table('key_chart')->where('key_id',$request->id)->get();    
                $html = view('keyresult.tabs.values',compact('data','KEYChart','key','report','keyQAll'));
            }else{
                $noreport = 'no';
                $html = view('keyresult.tabs.values',compact('data','noreport'));
            }  
            return $html;
        }
        if($request->tab == 'weighttab')
        {
            $data = key_result::find($request->id);
            $html = view('keyresult.tabs.weight', compact('data'))->render();
            return $html;
        }
        if($request->tab == 'charts')
        {
            $data = key_result::find($request->id);
            $html = view('keyresult.tabs.charts', compact('data'))->render();
            return $html;
        }
        if($request->tab == 'teams')
        {
            $data = key_result::find($request->id);
            $html = view('keyresult.tabs.teams', compact('data'))->render();
            return $html;
        }
        if($request->tab == 'okrmapper')
        {
            $data = key_result::find($request->id);
            $html = view('keyresult.tabs.okrmapper', compact('data'))->render();
            return $html;
        }
    }
    public function addquartervalue(Request $request)
    {
        DB::table('key_quarter_value')->insert([
          'key_chart_id' => $request->key_chart_id,
          'key_id' => $request->id,
          'sprint_id' => $request->sprint_id,
          'value' => $request->value,
        ]);
        $data = key_result::find($request->id);
        $report = DB::table('sprint')->where('user_id',Auth::id())->where('status',NULL)->where('value_unit_id',$data->unit_id)->first();
        $KEYChart =  DB::table('key_chart')->where('key_id',$request->id)->where('IndexCount',$report->IndexCount)->first();
        $key = key_result::find($request->id);
        $keyQAll = DB::table('key_chart')->where('key_id',$request->id)->get();    
        $html = view('keyresult.tabs.values',compact('data','KEYChart','key','report','keyQAll'));
        return $html;
    }
    public function deletequartervalue(Request $request)
    {
        $key_quarter_value = DB::table('key_quarter_value')->where('id',$request->id)->first();
        $data = key_result::find($key_quarter_value->key_id);
        $report = DB::table('sprint')->where('user_id',Auth::id())->where('status',NULL)->where('value_unit_id',$data->unit_id)->first();
        $KEYChart =  DB::table('key_chart')->where('key_id',$key_quarter_value->key_id)->where('IndexCount',$report->IndexCount)->first();
        $key = key_result::find($key_quarter_value->key_id);
        $keyQAll = DB::table('key_chart')->where('key_id',$key_quarter_value->key_id)->get();
        DB::table('key_quarter_value')->where('id',$request->id)->delete(); 
        $html = view('keyresult.tabs.values',compact('data','KEYChart','key','report','keyQAll'));
        return $html;
    }
    public function createkeyresult(Request $request)
    {
        $objective = DB::Table('objectives')->where('id' , $request->obj_id)->first();
        $create = new key_result();
        $create->user_id = Auth::id();
        $create->obj_id = $request->obj_id;
        $create->key_status = 'To Do';
        $create->unit_id = $objective->unit_id;
        $create->type = $objective->type;
        $create->save();        
        $update = key_result::find($create->id);
        $update->trash = $create->created_at;
        $update->key_start_date = $create->created_at;
        $update->key_end_date = $create->created_at;
        $update->save(); 
        return $create->id;
    }
    public function changekeyresultstatus(Request $request)
    {
        $update = key_result::find($request->id);
        $update->key_status = $request->status;
        $update->save();
        $data = key_result::find($request->id);
        $html = view('keyresult.modalheader', compact('data'))->render();
        return $html;
    }
    public function updatetarget(Request $request)
    {
        $update = key_result::find($request->id);
        $update->key_result_type = $request->key_result_type;
        $update->key_unit = $request->key_unit;
        $update->init_value = $request->init_value;
        $update->target_number = $request->target_number;
        $update->save();
        if($request->IndexCount)
        {
            foreach ($request->IndexCount as $indkey => $r) {
                
                $keychart = key_chart::where('key_id' , $request->id)->where('IndexCount' , $r)->first();
                $updatekeychart = key_chart::find($keychart->id);
                $updatekeychart->quarter_value = $request->Target[$indkey];
                $updatekeychart->save();
            }
        }
        $objective = DB::Table('objectives')->where('id' , $update->obj_id)->first();
        $check = key_chart::where('key_id' , $request->id)->count();
        if($check > 0)
        {
            $counter = $check;    
        }else{
            $counter = 0;    
        }
        if($request->has("newtarget")) {
            foreach ($request->newtarget as $key => $value) {
                $counter++;
                DB::table("key_chart")->insert([
                    "quarter_value" => $request->newtarget[$key],
                    "key_id" => $request->id,
                    "buisness_unit_id" => $objective->unit_id,
                    "IndexCount" => $counter,
                ]);
            }
        }
        $data = key_result::find($request->id);
        $html = view('keyresult.tabs.target', compact('data'))->render();
        return $html;
    }
    public function removeweight(Request $request)
    {
        DB::table('key_result')->where('id' , $request->id)->update(array('weight' => 0));
    }
    public function addweight(Request $request)
    {
        DB::table('key_result')->where('id' , $request->id)->update(array('weight' => $request->weight));   
    }
}