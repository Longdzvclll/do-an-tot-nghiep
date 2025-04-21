<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Quan trọng: Kế thừa từ lớp này
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];
}
