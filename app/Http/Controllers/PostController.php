<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $datas=User::with('posts')->paginate(10);
//        dd($datas);

        return view('home',['datas'=>$datas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     */
    public function store(Request $request)
    {
        $post=new Post();
        $post->text=$request->name;
        $post->user_id=$request->user_id;
        $post->save();

//        Post::create($this->validateData());
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     */
    public function edit($post)
    {
        $post=Post::find($post);
//        dd($post);

            $data = User::with('posts')->paginate(10);

            return view('home',['datas'=>$data,'post'=>$post]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     */
    public function update(Request $request, Post $post)
    {
        $name=$this->validateData()['name'];
//        dd($name);
        $this->updateData($post,$name);

        return redirect()->route('post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     */
    public function destroy(Post $post)
    {
        //
    }
}
