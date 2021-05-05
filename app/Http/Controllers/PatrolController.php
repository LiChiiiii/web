<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patrol;  
use App\Models\Classroom; 
use Illuminate\Support\Facades\DB;

class PatrolController extends Controller
{
    
    public function index()
    {
        $data = DB::table('patrols')->orderBy('patrol_id','desc')->paginate(10);
        return view('patrol',['patrols'=>$data]);
    }

    public function create(Request $request)
    {
        $patrol = new Patrol;
        $patrol->staff = $request->staff;
        $patrol->patrol_time = $request->patrol_time;
        $patrol->status = $request->status;
        $patrol->save();

        
        return response()->json($patrol);
    }

    public function edit(string $patrol_id)
    { 
        $patrol = Patrol::find($patrol_id);

        return response()->json($patrol);
    }

    public function update(Request $request,Patrol $patrol )
    {   
        $patrol = Patrol::find($request->patrol_id);

        $patrol->patrol_time = $request->patrol_time ;
        $patrol->status = $request->status;
        $patrol->save();

        return response()->json($patrol);
    }

    public function delete(string $patrol_id)
    {
        $patrol = Patrol::find($patrol_id);
        $patrol->delete();
        return response()->json(['success'=>'Record has been deleted']); 
    }

    public function changeStatus(Request $request)
    {
        $classroom = Classroom::find($request->id);
        $classroom->status = $request->status;
        $classroom->save();

        return response()->json($classroom); 
    }
 
}