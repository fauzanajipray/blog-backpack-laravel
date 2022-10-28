<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'comment',
        'post_id',
        'status'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
