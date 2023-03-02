<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Articles extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'image',
        'user_id',
        'categories_id'
    ];
    protected $table = 'articles';
    public function category()
    {
        return $this->belongsTo(Category::class,'categories_id', 'id');
    }
}
