<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'token',
        'expired_at',
    ];

    public $timestamps = false;

    protected $table = 'password_resets';
}
