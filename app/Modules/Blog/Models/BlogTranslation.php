<?php

namespace App\Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class BlogTranslation extends Model
{

    use HasSlug;

    protected $table = 'blog_translations';
    public $timestamps = false;
    protected $fillable = ['title', 'description'];


    public function getSlugOptions(): SlugOptions {
       return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }
}
