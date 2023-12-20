<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogFilterRequest;
use App\Http\Requests\CreatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function create()
    {
        $post = new Post();
        return view('blog.create', ['post' => $post]);
    }

    public function store(CreatePostRequest $request)
    {
        $post = Post::create($request->validated());
        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', 'Post created');
    }
    public function index(): View {
       return view('blog.index', ['posts' => Post::with('tags', 'category')->paginate(10)]);
    }

    public function update(Post $post, CreatePostRequest $request)
    {
        $post->update($request->validated());
        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', 'Post updated');
    }

    public function edit(Post $post)
    {

        return view('blog.edit', ['post' => $post, 'categories' => Category::select('id', 'name')->get(), 'tags' => Tag::select('id', 'name')->get()]);
    }
    public function show(string $slug, Post $post) : RedirectResponse | view {
        if($post->slug != $slug){
            return to_route('blog.show', ['slug' => $post->slug, 'post' => $post->id]);
        }

        return view('blog.show', [
            'post' => $post
        ]);
    }
}