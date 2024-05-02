<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', ['posts' => Post::all()]);
    }

    public function store(Request $request){
        //create an instance of the Post model and save the data
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = rand(1, 5);
        $post->save();
        return redirect('/posts');
    }

    public function show($id){
        // the firstOrFail() method will throw an exception if the post is not found
        $post = Post::with('user')->where('id', $id)->firstorFail();
        return view('posts.show', ['post' => $post]);
    }

    public function edit($id){
        // the firstOrFail() method will throw an exception if the post is not found
        $post = Post::where('id', $id)->firstOrFail();
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, $id){
        // the firstOrFail() method will throw an exception if the post is not found
        $post = Post::where('id', $id)->firstOrFail();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        return redirect('/posts');
    }

    public function destroy($id){
        // the firstOrFail() method will throw an exception if the post is not found
        $post = Post::where('id', $id)->firstOrFail();
        $post->delete();
        return redirect('/posts');
    }

}
