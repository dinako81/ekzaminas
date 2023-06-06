<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'address', 'phoneNumber'];
    public $timestamps = false;

    public function catService()
    {
        return $this->hasMany(Service::class);
    }
    
    public function master()
    {
        return $this->hasMany(Master::class);
    }
    
}