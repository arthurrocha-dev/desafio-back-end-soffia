<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostController extends Controller
{

    /**
     * @OA\Get(
     *     path="api/posts",
     *     summary="Get list of posts",
     *     description="Get a list of posts, optionally filtered by tag",
     *     operationId="getPosts",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="tag",
     *         in="query",
     *         description="Tag to filter posts by",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of posts",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Post")
     *         )
     *     )
     * )
    */
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

    /**
     * @OA\Get(
     *     path="api/posts/{id}",
     *     summary="Get post by ID",
     *     description="Get a single post by its ID",
     *     operationId="getPostById",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the post to retrieve",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post details",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post not found"
     *     )
     * )
    */
    public function searchById($id)
    {
        $post = Post::with('user', 'tags')->findOrFail($id);
        return new PostResource($post);
    }
    
    /**
     * @OA\Post(
     *     path="api/posts",
     *     summary="Create a new post",
     *     description="Create a new post with the provided details",
     *     operationId="createPost",
     *     tags={"Posts"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="My Post Title"),
     *             @OA\Property(property="content", type="string", example="Content of the post"),
     *             @OA\Property(property="tags", type="array", @OA\Items(type="integer", example=1))
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Post created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error"
     *     )
     * )
    */
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

    /**
     * @OA\Put(
     *     path="api/posts/{id}",
     *     summary="Update a post",
     *     description="Update the details of an existing post",
     *     operationId="updatePost",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the post to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Updated Post Title"),
     *             @OA\Property(property="content", type="string", example="Updated content of the post"),
     *             @OA\Property(property="tags", type="array", @OA\Items(type="integer", example=1)),
     *             @OA\Property(property="author", type="string", example="Author Name")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post not found"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error"
     *     )
     * )
    */
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

    /**
     * @OA\Delete(
     *     path="api/posts/{id}",
     *     summary="Delete a post",
     *     description="Delete an existing post by its ID",
     *     operationId="deletePost",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the post to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Post deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post not found"
     *     )
     * )
    */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 204);
    }
}