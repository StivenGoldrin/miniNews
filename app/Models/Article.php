<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'title',
        'description',
        'snippet',
        'url',
        'image_url',
        'language',
        'source',
        'locale',
        'categories',
        'published_at',
        'category_id',
    ];

    protected $casts = [
        'categories' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
