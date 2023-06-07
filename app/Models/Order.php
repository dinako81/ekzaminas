<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['dishes', 'user_id', 'status'];
    public $timestamps = false;
    protected $casts = [
        'dishes' => 'array',
    ];
    // is stringo gabala sucastina imasyva, array bus automatiskai paverstas i jason stringa kuris tiks DB

    const STATUS = [
        1 => 'Proccesing',
        2 => 'Confirmed'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function dish()
    // {
    //     return $this->hasMany(Dish::class);
    // }
   
}