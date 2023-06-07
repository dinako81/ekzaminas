<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\Cat;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class FrontController extends Controller
{
    public function index(Request $request, Cat $cat)
    {
        $menus = Menu::all();
        
        $sort = $request->sort ?? '';
        $filter = $request->filter ?? '';

        $menus = match($filter) {
            'cat' => function ($cat) {
                return Menu::whereHas('cat', function ($query) use ($cat) {
                    $query->where('name', $cat);
                })->get();
            },
            default => Menu::all(),
        };

        $menus = match($sort) {
            'price_0-50' => $menus->orderBy('price'),
            'price_51-100' => $menus->orderBy('price'),
            'price_101-500' => $menus->orderBy('price'),
            'price_501-...' => $menus->orderBy('price'),
            default => $menus
        };

        $request->session()->put('last-hotelt-view', [
            'sort' => $sort,
            'filter' => $filter
        ]);

        return view('front.index', [
            'cat' => $cat,
            'menus' => $menus,
            'sortSelect' => Menu::SORT,
            'sort' => $sort,
            'filterSelect' => Menu::FILTER,
            'filter' => $filter,
        ]);
    }

    // public function catColors(Cat $cat)
    // {
    //     $menus = $cat->service;

    //     return view('front.cat-index', [
    //         'menus' => $menus,
    //         'cat' => $cat
    //     ]);
    // }

    public function showService(Menu $service)
    {
        return view('front.service', [
            'service' => $service,
        ]);
    }

    public function orders(Request $request)
    {
        $orders = $request->user()->order;

        return view('front.orders', [
            'orders' => $orders,
            'status' => Order::STATUS
        ]);
    }
    public function download(Order $order)
    {


        $serviceNames = array_map(fn($p) => $p['title'], $order->menus);

        // mapinam $order->servicies, ir grazninam service is vardu

        $servicies = Menu::whereIn('title', $serviceNames)->get();
        // reikia susirasti produktus pagl spalvas

        // return view('front.pdf',[
        //         'order' => $order,
        //         'servicies' => $servicies,
        // ]);

        $pdf = Pdf::loadView('front.pdf',[
            'order' => $order,
            'servicies' => $servicies,
        ]);

        return $pdf->download('order-'.$order->id.'.pdf');
    }


}