<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bean()
    {
        return $this->hasOne(Bean::class);
    }

    public function pod()
    {
        return $this->hasOne(Pod::class);
    }

    public function machine()
    {
        return $this->hasOne(Machine::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
