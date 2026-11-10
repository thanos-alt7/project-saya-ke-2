<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\ProjectImage;

class Project extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'thumbnail'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class)
            ->orderBy('sort_order');
    }
}
