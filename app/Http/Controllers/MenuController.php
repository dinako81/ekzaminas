<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Cat;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
// use Intervention\Image\ImageManagerStatic as Image;
// use Illuminate\Http\UploadedFile;

class MenuController extends Controller
{
    
    public function index()
    {
        $menus = Menu::all();
        return view('back.menus.index', [  
            'menus' => $menus
        ]);
    }

    
    public function create()
    {
        $menus = Menu::all();
        return view('back.menus.create', [  
            'menus' => $menus
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
        ]);

        if ($validator->fails()) {
            $request->flash();
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $id = Menu::create([
            'title' => $request->title,
            'cat_id' => $request->cat_id,
        ])->id;

       
        return redirect()
        ->route('menus-index')
        ->with('ok', 'Naujas menu sukurtas');
    }
    
    public function show(Menu $menu)
    {
        //
    }

   
    public function edit(Menu $menu)
    {
        $cats = Cat::all();
        
        return view('back.menus.edit', [
            'menu' => $menu,
            'cats' => $cats,
        ]);
    }

  
    public function update(Request $request, Menu $menu)
    {
        $cats = Cat::all();
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:100',
           
        ]);

        if ($validator->fails()) {
            $request->flash();
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $menu->update([
            'title' => $request->title,
            'cat_id' => $request->cat_id,
        ]);

        return redirect()
        ->route('menus-index')
        ->with('ok', 'Menu papildytas');
    }

   
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()
        ->route('menus-index')
        ->with('warn', 'Menu pašalintas');
    }
}