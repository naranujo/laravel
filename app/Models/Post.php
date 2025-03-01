<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    
    use HasFactory;

    protected $fillable = [
        'title',
        'resume',
        'author',
        'status',
        'category_id'
    ];

    public function author() {
        return $this->belongsTo(User::class, 'author', 'email');
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function sections() {
        return $this->hasMany(Section::class);
    }

    public function logs() {
        return $this->morphMany(Log::class, 'loggable');
    }
}
