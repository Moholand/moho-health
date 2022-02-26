<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class role extends Model
{
    use HasFactory;

    const ADMIN = 1;
    const DOCTOR = 2;
    const USER = 3;

    protected $fillable = ['name', 'user_id'];

    public function users() 
    {
        return $this->hasMany(User::class);
    }
}
