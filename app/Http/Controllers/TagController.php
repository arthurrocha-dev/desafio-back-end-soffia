<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{

    /**
     * @OA\Get(
     *     path="/tags",
     *     summary="Get list of tags",
     *     description="Get a list of all tags",
     *     operationId="getTags",
     *     tags={"Tags"},
     *     @OA\Response(
     *         response=200,
     *         description="List of tags",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Tag")
     *         )
     *     )
     * )
    */
    public function index()
    {
        $tags = Tag::all();
        return response()->json($tags, 200);
    }

    /**
     * @OA\Post(
     *     path="/tags",
     *     summary="Create a new tag",
     *     description="Create a new tag with the provided details",
     *     operationId="createTag",
     *     tags={"Tags"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="New Tag")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Tag created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Tag")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error"
     *     )
     * )
    */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:tags',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $tag = Tag::create([
            'name' => $request->name,
        ]);

        return response()->json($tag, 201);
    }

    /**
     * @OA\Get(
     *     path="/tags/{id}",
     *     summary="Get tag by ID",
     *     description="Get a single tag by its ID",
     *     operationId="getTagById",
     *     tags={"Tags"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the tag to retrieve",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tag details",
     *         @OA\JsonContent(ref="#/components/schemas/Tag")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tag not found"
     *     )
     * )
    */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return response()->json($tag, 200);
    }
/**
     * @OA\Put(
     *     path="/tags/{id}",
     *     summary="Update a tag",
     *     description="Update the details of an existing tag",
     *     operationId="updateTag",
     *     tags={"Tags"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the tag to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Updated Tag Name")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tag updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Tag")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tag not found"
     *     )
     * )
    */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:tags,name,'.$id,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $tag = Tag::findOrFail($id);
        $tag->update([
            'name' => $request->name,
        ]);

        return response()->json($tag, 200);
    }
    
    /**
     * @OA\Delete(
     *     path="/tags/{id}",
     *     summary="Delete a tag",
     *     description="Delete an existing tag by its ID",
     *     operationId="deleteTag",
     *     tags={"Tags"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the tag to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Tag deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tag not found"
     *     )
     * )
    */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return response()->json(null, 204);
    }
}
