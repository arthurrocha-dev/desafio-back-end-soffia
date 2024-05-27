<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *     schema="Post",
 *     type="object",
 *     title="Post",
 *     description="Post model",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Post ID"
 *     ),
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         description="Post title"
 *     ),
 *     @OA\Property(
 *         property="content",
 *         type="string",
 *         description="Post content"
 *     ),
 *     @OA\Property(
 *         property="author",
 *         type="string",
 *         description="Post author"
 *     ),
 *     @OA\Property(
 *         property="tags",
 *         type="string",
 *         description="Post tags"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Post creation timestamp"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Post update timestamp"
 *     )
 * )
*/

class Post extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

}
