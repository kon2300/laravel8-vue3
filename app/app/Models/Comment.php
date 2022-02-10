<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'article_id',
        'content'
    ];

    /**
     * Get all of the commentLikes for the Comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commentLikes()
    {
        return $this->hasMany(CommentLike::class);
    }
}
