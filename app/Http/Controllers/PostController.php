<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('tag')) {
            $tagName = $request->query('tag');
            $tag = Tag::where('name', $tagName)->first();

            if ($tag) {
                $posts = $tag->posts()->with('user', 'tags')->get();
            } else {
                $posts = collect();
            }
        } else {
            $posts = Post::with('user', 'tags')->get();
        }
        return PostResource::collection($posts);
    }

    public function searchById($id)
    {
        $post = Post::with('user', 'tags')->findOrFail($id);
        return new PostResource($post);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = auth()->id();
        $post->save();

        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }

        return response()->json($post, 201);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'tags' => 'sometimes|array',
            'tags.*' => 'exists:tags,id',
            'author' => 'sometimes|string|exists:users,name'
        ]);

        if ($request->has('title')) {
            $post->title = $request->title;
        }
        if ($request->has('content')) {
            $post->content = $request->content;
        }
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }
        if ($request->has('author')) {
            $author = User::where('name', $request->author)->first();
            if ($author) {
                $post->user_id = $author->id;
            }
        }

        $post->save();
        return new PostResource($post);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 204);
    }
}