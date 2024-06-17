<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['user_id', 'task_id', 'quantity'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
