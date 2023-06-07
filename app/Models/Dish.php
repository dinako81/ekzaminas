<?php

namespace App\Models;

use App\Models\Cat;
use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\UploadedFile;

class Dish extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'photo', 'menu_id'];
    public $timestamps = false;

    public function deletePhoto()
    {
        if ($this->photo) {
            $photo = public_path() . '/dishes-photo/' . $this->photo;
            unlink($photo);
            $photo = public_path() . '/dishes-photo/t_' . $this->photo;
            unlink($photo);
        }
        $this->update([
            'photo' => null,
        ]);
    }

    public function savePhoto(UploadedFile $photo) : string
    {
        $name = $photo->getClientOriginalName();
        $name = rand(1000000, 9999999) . '-' . $name;
        $path = public_path() . '/dishes-photo/';
        $photo->move($path, $name);
        $img = Image::make($path . $name);
        $img->resize(200, 200);
        $img->save($path . 't_' . $name, 90);
        return $name;
    }

    public function photo()
    {
        return $this->hasMany(Photo::class);
    }

    // public function gallery()
    // {
    //     return $this->hasMany(Photo::class, 'hotel_id', 'id');
    // }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    
}