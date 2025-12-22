<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    public $fillable = ['is_complete', 'to_be_done', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
