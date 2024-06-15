<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArticleTag extends Model
{
    use HasFactory;

    protected $table = 'article_tag';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'article_id',
    ];

    public function Tag(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

    public function Article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
