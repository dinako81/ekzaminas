<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'duration', 'price', 'cat_id'];
    public $timestamps = false;

    public function cat()
    {
        return $this->belongsTo(Cat::class);
    }

    public function master()
    {
        return $this->hasMany(Master::class);
    }
}