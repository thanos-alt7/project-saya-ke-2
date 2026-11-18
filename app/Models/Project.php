<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\ProjectImage;
use App\Models\Skill;

class Project extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'short_description',
        'description',
        'status',
        'project_date',
        'is_featured',
        'project_url',
        'repository_url',
        'thumbnail',
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

    public function skills()
    {
        return $this->belongsToMany(Skill::class)
            ->withTimestamps();
    }
}
