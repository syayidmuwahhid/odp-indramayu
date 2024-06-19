<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    use HasFactory;

    protected $table = 'article';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'thubnail'
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function ArticleTag(): HasMany
    {
        return $this->hasMany(ArticleTag::class);
    }

}
