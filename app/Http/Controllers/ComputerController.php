<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Models\Post;    //php artisan make:model Post --resource

class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $id)
    {
        //$post = DB::table('posts')->get( );
        //return view('classroom',compact('post')) -> with('classroom_id', $id);

        return view('classroom') -> with('id', $id);
        
    }

    /**
     * Show the form for creating a new resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,string $id)
    {
        $post = new Post;
        $post->name = $request->name;
        $post->asset_num = $request->asset_num ;
        $post->status = $request->status;
        $post->classroom_id = $id;
        $post->save();
        
        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function edit(string $computer_id)
    { 
        //$post = DB::table('posts')->where('computer_id', $computer_id)->first();
        $post = Post::find($computer_id);

        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Post $post )
    {   
        $post = Post::find($request->computer_id);
        
        $post->name =$request->name;
        $post->asset_num = $request->asset_num ;
        $post->status = $request->status;
        $post->save();

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function delete(string $computer_id)
    {
        $post = Post::find($computer_id);
        $post->delete();
        return response()->json(['success'=>'Record has been deleted']); 
    }

  
}
