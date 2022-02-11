<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'about'];

    public function getUpdatedAtAttribute($value)
    {
        return Verta($value)->format('H:i Y-n-j');
    }

    public function getLogoAttribute($value)
    {
        return $value ?? 'far fa-building';
    }

    public function doctors() {
        return $this->hasMany(User::class, 'department_id');
    }
}
