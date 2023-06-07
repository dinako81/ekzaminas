<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Menu;
use App\Models\Cat;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\UploadedFile;

class DishController extends Controller
{
    
    public function index()
    {
        $dishes= Dish::all();

        return view('back.dishes.index', [
            'dishes' => $dishes
        ]);
    }

   
    public function create()
    {      
        $cats = Cat::all();
        $dishes= Dish::all();

        return view('back.dishes.create', [  
            'dishes' => $dishes,
            'cats' => $cats,
        ]);
    }

  
    public function store(Request $request, Food $food)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:100',
            'surname' => 'required|min:3|max:100',
            'photo' => 'sometimes|required|image|max:512',
             ]);

        if ($validator->fails()) {
            $request->flash();
            return redirect()
                ->back()
                ->withErrors($validator);
        }
        
        $photo = $request->photo;
        if ($photo) {
            $name = $food->savePhoto($photo);
        }
        $id = Master::create([
            'cat_id' => $request->cat_id,
            'name' => $request->name,
            'surname' => $request->surname,
            'photo' => $name ?? null
        ])->id;

      
        return redirect()
        ->route('dishes-index')
        ->with('ok', 'New Master was created');
    }

   
    public function show(Master $food)
    {
        //
    }

   
    public function edit(Master $food)
    {
        $services = Menu::all();
        $cats = Cat::all();
        
        return view('back.dishes.edit', [
            'food' => $food,
            'services' => $services,
            'cats' => $cats,
        ]);
    }

    
    public function update(Request $request, Master $food)
    {
        if ($request->delete == 1) {
            $food->deletePhoto();
            return redirect()->back();
        }

        $photo = $request->photo;

        if ($photo) {
            $name = $food->savePhoto($photo);
            $food->deletePhoto();
            $food->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'photo' => $request->photo,
                'cat_id' =>$request->cat_id,
            ]);
        } else {
            $food->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'cat_id' =>$request->cat_id,
            ]);
        }

        foreach ($request->gallery ?? [] as $gallery) {
            Photo::add($gallery, $food->id);
        }
        return redirect()
        ->route('dishes-index')
        ->with('ok', 'Master was updated');
    }

   
    public function destroy(Master $food)
    {
        // if ($food->gallery->count()) {
        //     foreach ($food->gallery as $gal) {
        //         $gal->deletePhoto();
        //     }
        // }
        
        if ($food->photo) {
            $food->deletePhoto();
        }
        
        $food->delete();
        return redirect()
        ->route('dishes-index')
        ->with('warn', 'Master was deleted');
        
    }

    public function destroyPhoto(Photo $photo)
    {
        $photo->deletePhoto();
        
        return redirect() 
        -> back()
        ->with('warn', 'Photo was deleted');
        
    }
}