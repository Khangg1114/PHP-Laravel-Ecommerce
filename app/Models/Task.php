<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['description', 'image', 'category_id', 'name', 'price'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
