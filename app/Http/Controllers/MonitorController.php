<?php

namespace App\Http\Controllers;

use App\Models\Monitor;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,string $id)
    {
        $monitor = new monitor;
        $monitor->name = $request->name;
        $monitor->snid = $request->snid ;
        $monitor->status = $request->status;
        $monitor->classroom_id = $id;
        $monitor->save();
        
        return response()->json($monitor);
    }

    
    public function edit(string $monitor_id)
    { 
        $monitor = Monitor::find($monitor_id);

        return response()->json($monitor);
    }

    public function update(Request $request,Monitor $monitor )
    {   
        $monitor = Monitor::find($request->monitor_id);
        
        $monitor->name =$request->name;
        $monitor->snid = $request->snid ;
        $monitor->status = $request->status;
        $monitor->save();

        return response()->json($monitor);
    }

    public function delete(string $monitor_id)
    {
        $monitor = Monitor::find($monitor_id);
        $monitor -> delete();
        return response()->json(['success'=>'Record has been deleted']); 
    }
}
