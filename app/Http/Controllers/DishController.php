<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Menu;
use App\Models\Photo;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class DishController extends Controller
{

    public function index(Request $request)
    {
        $dishes = Dish::all();
        $photos = Photo::all();

        return view('back.dishes.index', [
            'dishes' => $dishes,
            'photos' => $photos,
          
        ]);
    }

    public function create()
    {
        $menus = Menu::all();
        $dishes = Dish::all();
        
        return view('back.dishes.create', [
            'dishes' => $dishes,
            'menus' => $menus,
        ]);


    }

    

    public function store(Request $request, Dish $dish)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:100',
            'description' => 'required',
            'photo' => 'sometimes|required|image|max:512',
            'gallery.*' => 'sometimes|required|image|max:512'
        ]);

        if ($validator->fails()) {
            $request->flash();
            return redirect()
                ->back()
                ->withErrors($validator);
        }
        
        $photo = $request->photo;
        if ($photo) {
            $name = $dish->savePhoto($photo);
        }
        $id = Dish::create([
            'menu_id' => $request->menu_id,
            'title' => $request->title,
            'description' => $request->description,   
            'photo' => $name ?? null
        ])->id;

        foreach ($request->gallery ?? [] as $gallery) {
            Photo::add($gallery, $id);
        }

        return redirect()
        ->route('dishes-index');
       
    }

    public function show(Dish $dish)
    {
        $dishes = Dish::all();

        return view('back.dishes.show', [
            'menus' => $menus,
            'dishes' => $dishes
        ]);
    }


    public function edit(Dish $dish)
    {
        $menus = Menu::all();
        
        return view('back.dishes.edit', [
            'dish' => $dish,
            'menus' => $menus
        ]);
    }


    public function update(Request $request, Dish $dish)
    {
        if ($request->delete == 1) {
            $dish->deletePhoto();
            return redirect()->back();
        }

        $photo = $request->photo;

        if ($photo) {
            $name = $dish->savePhoto($photo);
            $dish->deletePhoto();
            $dish->update([
                'title' => $request->title,
                'description' => $request->description,
                 'photo' => $request->photo,
                'menu_id' =>$request->menu_id,
            ]);
        } else {
            $dish->update([
                'title' => $request->title,
                'description' => $request->description,
                'menu_id' =>$request->menu_id,
                
            ]);
        }

        foreach ($request->gallery ?? [] as $gallery) {
            Photo::add($gallery, $dish->id);
        }
        return redirect()->route('dishes-index')
        ->with('ok', 'Patiekalas papildytas');
    }


    public function destroy(Dish $dish)
    {
        // if ($dish->gallery->count()) {
        //     foreach ($dish->gallery as $gal) {
        //         $gal->deletePhoto();
        //     }
        // }
        
        if ($dish->photo) {
            $dish->deletePhoto();
        }
        
        $dish->delete();
        return redirect()
        ->route('dishes-index');
        
    }

    public function destroyPhoto(Photo $photo)
    {
        $photo->deletePhoto();
        
        return redirect() -> back()
        ->with('warn', 'Patiekalas i6trintas');
        
    }
}