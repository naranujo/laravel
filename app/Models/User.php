<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model {
    
    use HasFactory;

    protected $primaryKey = 'email';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'first_name',
        'last_name',
        'password',
        'role',
        'status',
        'last_login'
    ];

    public function posts() {
        return $this->hasMany(Post::class, 'author', 'email');
    }

    public function logs() {
        return $this->hasMany(Log::class, 'user_email', 'email');
    }


}
