<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\UploadedFile;

class Master extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'surname', 'photo', 'cat_id'];
    public $timestamps = false;

    public function deletePhoto()
    {
        if ($this->photo) {
            $photo = public_path() . '/masters-photo/' . $this->photo;
            unlink($photo);
            $photo = public_path() . '/masters-photo/t_' . $this->photo;
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
        $path = public_path() . '/masters-photo/';
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

    public function cat()
    {
        return $this->belongsTo(Cat::class);
    }
    
}