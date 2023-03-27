<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        return view('dashboard.post.index',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate();
        return view('dashboard.post.create',['post' => new Post(),'categories' => $categories]);


        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePost $request)
    {
        Post::create($request->validated());
        return back()->with('status', 'Publicacion ha sido creada con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.post.show',["post" => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {   
        $categories = Category::orderBy('created_at', 'desc')->paginate();
        return view('dashboard.post.edit',["post" => $post, 'categories' => $categories]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePost $request, Post $post)
    {
        $post->update($request->validated());
        return back()->with('status', 'Post fue modificado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('status', 'Post eliminado exitosamente');
    }

    public function category(Category $category)
    {
        return $this->sucessResponse($category->post);
    }

    public function url_clean(String $url_clean)
    {
        $post = Post::where('url_clean', $url_clean)->get();
        $post->image;
        $post->category;
        return $this->sucessResponse($post);

    }

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'create');
    }

}
