<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Cat;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
// use Intervention\Image\ImageManagerStatic as Image;
// use Illuminate\Http\UploadedFile;

class ServiceController extends Controller
{
    
    public function index()
    {
        $services = Service::all();
        return view('back.autoServices.index', [  
            'services' => $services
        ]);
    }

    
    public function create()
    {
        $cats = Cat::all();
        return view('back.autoServices.create', [  
            'cats' => $cats
        ]);
    }

    // public function colors(Request $request)
    // {

    //     $colorsCount = Cat::where('id', $request->cat)->first()->colors_count;

    //     $html = view('back.autoServices.colors')
    //     ->with(['colorsCount' => $colorsCount])
    //     ->render();

    //     return response()->json([
    //         'html' => $html,
    //         'message' => 'OK',
    //     ]);
    // }

    // public function colorName(Request $request, ColorNamingService $cns)
    // {
    //     return response()->json([
    //         'name' => $cns->nameIt($request->color),
    //         'message' => 'OK',
    //     ]);
    // }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:100',
            'duration' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $request->flash();
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $id = Service::create([
            'title' => $request->title,
            'duration' => $request->duration,
            'price' => $request->price,
            'cat_id' => $request->cat_id,
        ])->id;

       
        return redirect()
        ->route('services-index')
        ->with('ok', 'New provided service was created');
    }
    
    public function show(Service $service)
    {
        //
    }

   
    public function edit(Service $service)
    {
        $cats = Cat::all();
        
        return view('back.autoServices.edit', [
            'service' => $service,
            'cats' => $cats,
        ]);
    }

  
    public function update(Request $request, Service $service)
    {
        $cats = Cat::all();
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:100',
            'duration' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $request->flash();
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $service->update([
            'title' => $request->title,
            'duration' => $request->duration,
            'price' => $request->price,
           'cat_id' => $request->cat_id,
        ]);

        return redirect()
        ->route('services-index')
        ->with('ok', 'Provided service was updated');
    }

   
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services-index');
    }
}