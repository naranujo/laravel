<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model {
    
    use HasFactory;

    public $incrementing = false;  // 🔹 Evita que Laravel trate `id` como autoincremental
    protected $keyType = 'string'; // 🔹 Indica que `id` es un string (UUID)

    protected $fillable = [
        'id', // 🔹 Asegura que se pueda asignar el UUID manualmente
        'title',
        'resume',
        'author',
        'status',
        'category_id'
    ];

    protected static function boot() {
        parent::boot();
        static::creating(function ($post) {
            $post->id = $post->id ?? Str::uuid()->toString(); // 🔹 Genera un UUID si no tiene uno
        });
    }

    public function author() {
        return $this->belongsTo(User::class, 'author', 'email');
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function sections() {
        return $this->hasMany(Section::class, 'post_id')->orderBy('order');
    }

    public function logs() {
        return $this->morphMany(Log::class, 'loggable');
    }
}
