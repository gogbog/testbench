<?php

namespace App\Modules\Blog\Models;


use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Blog extends Model implements HasMedia
{
    use Translatable, HasMediaTrait, NodeTrait, SoftDeletes;

    protected $table = 'blog';

    public $translatedAttributes = ['title', 'description'];
    protected $fillable = ['active'];

    protected $with = ['translations'];


    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(240)
            ->height(240)
            ->sharpen(0)
            ->nonOptimized();
    }


}
