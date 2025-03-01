<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model {
    
    use hasFactory;

    protected $fillable = [
        'user_email',
        'action',
        'description',
        'ip'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_email', 'email');
    }
    
}
