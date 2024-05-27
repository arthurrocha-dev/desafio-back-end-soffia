<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *     schema="Tag",
 *     type="object",
 *     title="Tag",
 *     description="Tag model",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Tag ID"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Tag name"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Tag creation timestamp"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Tag update timestamp"
 *     )
 * )
*/

class Tag extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

}
