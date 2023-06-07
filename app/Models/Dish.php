<?php

namespace App\Models;

use App\Models\Menu;
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
    
    // protected $casts = [
    //     'donations', 'rates' => 'array'
        
    // ];

    // const SORT = [
    //     'default' => 'Be rūšiavimo',
    //     'rates 0' => 'Hearts 0-0',
    //     'rates 1-3' => 'Hearts 1-3',
    //     'rates 4-50' => 'Hearts 4-50',
    // ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

   
    public function photo()
    {
        return $this->hasMany(Photo::class);
    }

    public function gallery()
    {
        return $this->hasMany(Photo::class, 'dish_id', 'id');
    }

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
    // uploaded file butinai, kitaip nezinos koks metodas
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
}