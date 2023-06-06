<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\Service;
use App\Models\Cat;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\UploadedFile;

class MasterController extends Controller
{
    
    public function index()
    {
        $masters = Master::all();

        return view('back.masters.index', [
            'masters' => $masters
        ]);
    }

   
    public function create()
    {      
        $cats = Cat::all();
        $masters= Master::all();

        return view('back.masters.create', [  
            'masters' => $masters,
            'cats' => $cats,
        ]);
    }

  
    public function store(Request $request, Master $master)
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
            $name = $master->savePhoto($photo);
        }
        $id = Master::create([
            'cat_id' => $request->cat_id,
            'name' => $request->name,
            'surname' => $request->surname,
            'photo' => $name ?? null
        ])->id;

      
        return redirect()
        ->route('masters-index')
        ->with('ok', 'New Master was created');
    }

   
    public function show(Master $master)
    {
        //
    }

   
    public function edit(Master $master)
    {
        $services = Service::all();
        $cats = Cat::all();
        
        return view('back.masters.edit', [
            'master' => $master,
            'services' => $services,
            'cats' => $cats,
        ]);
    }

    
    public function update(Request $request, Master $master)
    {
        if ($request->delete == 1) {
            $master->deletePhoto();
            return redirect()->back();
        }

        $photo = $request->photo;

        if ($photo) {
            $name = $master->savePhoto($photo);
            $master->deletePhoto();
            $master->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'photo' => $request->photo,
                'cat_id' =>$request->cat_id,
            ]);
        } else {
            $master->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'cat_id' =>$request->cat_id,
            ]);
        }

        foreach ($request->gallery ?? [] as $gallery) {
            Photo::add($gallery, $master->id);
        }
        return redirect()
        ->route('masters-index')
        ->with('ok', 'Master was updated');
    }

   
    public function destroy(Master $master)
    {
        // if ($master->gallery->count()) {
        //     foreach ($master->gallery as $gal) {
        //         $gal->deletePhoto();
        //     }
        // }
        
        if ($master->photo) {
            $master->deletePhoto();
        }
        
        $master->delete();
        return redirect()
        ->route('masters-index')
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