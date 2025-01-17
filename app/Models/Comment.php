<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Overtrue\LaravelLike\Traits\Likeable;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;
    use SoftDeletes;
    use Likeable;
    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function commentable() : MorphTo
    {
        return $this->morphTo();
    }

    public function parent() : BelongsTo {
        return $this->belongsTo(Self::class, 'parent_id');
    }

    public function replies() : HasMany {
        return $this->hasMany(Self::class, 'parent_id', 'id')->with('replies');
    }

    public function user() :BelongsTo {
        return $this->belongsTo(User::class);
    }
}
