<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model {
    
    use HasFactory;

    protected $table = 'password_reset'; // Nombre de la tabla
    protected $primaryKey = 'email';
    public $incrementing = false;

    protected $fillable = ['email', 'token', 'created_at'];

}
