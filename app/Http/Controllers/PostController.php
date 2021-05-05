<?php

namespace App\Http\Controllers;
use App\Models\Post;    //php artisan make:model Post --resource
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return "Postcontroller@index";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
        //view('資料夾名稱.檔案名稱');
        //回到create.blade.php頁面
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());    
        //將request收到的所有參數內容輸出

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = new Post;
        $post->title = request('title');
        $post->content = request('content');
        $post->user_id = \Auth::id();
        $post->save();

        return redirect()->to('/') ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //dd($post);  
        //從資料庫中取得資料

        return view('posts.edit', compact('post'));
        //將$post的資料傳入去view裡面
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //$post是資料庫的資料, $request是修改後的資料
        //驗證title和content為必填欄位
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post->title = request('title');
        $post->content = request('content');
        $post->user_id = \Auth::id();
        $post->save();

        return redirect()->route('posts.edit', [$post->id])->with('success',true) ;
        //停留在edit的頁面,如果成功回傳true到success
        //edit.blade.php第9行,session判斷success是否為true 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post -> delete();

        return redirect()->to("/");
    }
}
