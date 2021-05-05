<?php

namespace App\Http\Controllers;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    
    public function index()
    {
        return view('schedule');
    }

    public function edit(string $schedule_id)
    { 
        $schedule = Schedule::find($schedule_id);

        return response()->json($schedule);
    }

    public function update(Request $request,Schedule $schedule )
    {   
        $schedule = Schedule::find($request->schedule_id);
        
        $schedule->Mon =$request->Mon;
        $schedule->Tue = $request->Tue;
        $schedule->Wed = $request->Wed;
        $schedule->Thu =$request->Thu;
        $schedule->Fri = $request->Fri ;
    
        $schedule->save();

        return response()->json($schedule);
    }

}