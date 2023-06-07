<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\UploadedFile;


class CatController extends Controller
{
    
    public function index()
    {
        $cats = Cat::all();

        return view('back.cats.index', [
            'cats' => $cats
        ]);
    }

   
    public function create()
    {
        return view('back.cats.create', [  
        ]);
    }

   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:100',
            'code' => 'required',
            'address' => 'required|min:3|max:100',
        ]);

        if ($validator->fails()) {
            $request->flash();
            return redirect()
                ->back()
                ->withErrors($validator);
        }
                
        $id = Cat::create([
            'title' => $request->title,
            'address' => $request->address,
            'code' => $request->code,
        ])->id;

        return redirect()
        ->route('cats-index')
        ->with('ok', 'Naujas restoranas sukurtas');
    }

    public function show (Service $service, Cat $cat)
    {
        // $cats = Cat::all();
        $services = Service::all();

        // dump($cat->catService()->title);
        // die;

        return view('back.cats.show', [
            // 'cats' => $cats,
            // 'catService'=> $cat->catService(),
            // 'services' => $services,
            // 'service' => $service,
            'cat' => $cat,
        ]);
    }

    public function edit(Cat $cat)
    {
        return view('back.cats.edit', [ 
            'cat' => $cat,
        ]);
    }

    
    public function update(Request $request, Cat $cat)
    {
        $cat->update([
            'title' => $request->title,
            'address' => $request->address,
            'code' => $request->code,
            
        ]);
        return redirect()->route('cats-index')
        ->with('ok', 'Naujas restoranas papildytas');
    }

   
    public function destroy(Cat $cat)
    {
              
        $cat->delete();
        return redirect()->route('cats-index')
        ->with('warn', 'Restoranas ištrintas');

    }


   
}