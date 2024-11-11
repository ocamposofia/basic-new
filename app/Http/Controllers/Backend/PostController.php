<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $posts = Post::orderBy("created_at","desc")->get();
       //$posts = Post::latesty()->get();
       //$posts = Post::all();
       return view("posts.index", compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        //dd($request->all());
        //Guardar
        $post = Post::create([
            'user_id'=> auth()->user()->id
        ] + $request->all());

        //Imagen
        if ($request->file('file')) {
            $post->image = $request->file('file')->store('posts', 'public');
            $post->save();
        }

        //Retornar
        return back()->with('status','Creado con éxito ');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->all());

        //Imagen
        if ($request->file('file')) {
        //Storage::delete($post->image);
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->image = $request->file('file')->store('posts', 'public');
        $post->save();
    }
        return back()->with('status','Actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //Eliminacion de la imagen 
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();

        return back()->with('status','Eliminado con éxito');
    }
}
