<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'following_user_id'
    ];

    protected $table = 'follow_users';

    /**
     * Get the followings that owns the FollowUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function followings()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the followers that owns the FollowUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function followers()
    {
        return $this->belongsTo(User::class, 'following_user_id');
    }
}
