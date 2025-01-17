<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Overtrue\LaravelFavorite\Traits\Favoriteable;
use Overtrue\LaravelLike\Traits\Likeable;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory, Likeable, Favoriteable;

    protected $fillable = [
        'user_id',
        'description',
        'location',
        'hide_like_view',
        'allow_commenting',
        'type',
    ];

    protected $casts = [
        'hide_like_view' => 'boolean',
        'allow_commenting' => 'boolean',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function media() : MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function comments() : MorphMany {
        return $this->morphMany(Comment::class, 'commentable')->with('replies');
    }
}
