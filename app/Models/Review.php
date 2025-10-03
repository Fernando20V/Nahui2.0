<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Review
 *
 * @property $id
 * @property $user_id
 * @property $reviewable_type
 * @property $reviewable_id
 * @property $rating
 * @property $title
 * @property $comment
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property User $user
 * @property ReviewAnswer[] $reviewAnswers
 * @property ReviewLike[] $reviewLikes
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Review extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'reviewable_type', 'reviewable_id', 'rating', 'title', 'comment'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviewAnswers()
    {
        return $this->hasMany(\App\Models\ReviewAnswer::class, 'id', 'review_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviewLikes()
    {
        return $this->hasMany(\App\Models\ReviewLike::class, 'id', 'review_id');
    }
    
}
