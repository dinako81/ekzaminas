<?php

namespace App\Http\Controllers;

use App\Models\Master;
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
        
        return view('back.masters.edit', [
            'master' => $master,
            'services' => $services
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMasterRequest $request, Master $master)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Master $master)
    {
        //
    }
}