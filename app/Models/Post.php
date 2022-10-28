<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = ['title', 'content', 'slug', 'published', 'image', 'author_id'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_to_categories', 'post_id', 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function getPublishedAttribute($value)
    {
        return $value ? 'Yes' : 'No';
    }


    // FUNCTION
    
    public static function boot()
    {
        parent::boot();
        static::deleting(function($obj) {
            Storage::delete(Str::replaceFirst('storage/','public/', $obj->image));
        });
    }


    public function setImageAttribute($value)
    {
        $destination_path = "public/uploads/images";     
        $attribute_name = "image";
        
        if(request()->{$attribute_name . '_change'}){
            // if the image was erased
            if ($value==null) {
                // delete the image from disk
                Storage::delete(Str::replaceFirst('storage/','public/', $this->{$attribute_name}));

                $this->attributes[$attribute_name] = null;
            }
        }

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image'))
        {
            // 0. Make the image
            $image = Image::make($value)->encode('jpg', 75);

            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';

            // 2. Store the image on disk.
            Storage::put($destination_path.'/'.$filename, $image->stream());

            // 3. Save the path to the database
            $this->attributes['image'] = $destination_path.'/'.$filename;

            return $this;
        }

        return null;
    }

    public function getImageAttribute($value)
    {
        $url = Str::replaceFirst('public/','', $value);
        $value = $url;
        return $value ? $value : null;
    }
}
