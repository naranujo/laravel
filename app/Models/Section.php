<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Section extends Model {
    
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'post_id', 'title', 'content', 'order'];

    protected static function boot() {
        parent::boot();
        static::creating(function ($section) {
            $section->id = $section->id ?? Str::uuid()->toString();
        });
    }

    public function post() {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
