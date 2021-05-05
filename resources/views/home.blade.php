@extends('layouts.app')

@section('content')     <!--繼承app.blade.php-->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach(App\Models\Post::orderBy('created_at','DESC')->get() as $post)
            <div class="card">
                <div class="card-header">
                    #{{ $post->id }}
                    {{ $post->title }} @ {{ $post->created_at }}

                    @auth
                    <a href="{{ route('posts.edit' , [$post->id] ) }}">(Edit)</a>
                    <!--回傳文章id才知道要編輯哪一篇(網址會顯示id)-->
                    @endauth 
                    <!--登入才顯示-->

                </div>
                <div class="card-body">
                    {!! nl2br($post->content) !!}
                    <!--分行符號轉換為<br>-->
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

