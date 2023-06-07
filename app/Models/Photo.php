<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = ['photo', 'dish_id'];
    public $timestamps = false;

    public static function add(UploadedFile $gallery, int $dish_id)
    {
        $name = $gallery->getClientOriginalName();
        $name = rand(1000000, 9999999) . '-' . $name;
        $path = public_path() . '/dishes-photo/';
        $gallery->move($path, $name);
        self::create([
            'dish_id' => $dish_id,
            'photo' => $name
        ]);
    }

    public function deletePhoto()
    {
        $photo = public_path() . '/dishes-photo/' . $this->photo;
        unlink($photo);
        $this->delete();
    }
}