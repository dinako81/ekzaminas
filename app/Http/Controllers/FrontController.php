<?php

namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\Cat;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class FrontController extends Controller
{
    public function index(Request $request, Cat $cat)
    {
        $services = Service::all();
        
        $sort = $request->sort ?? '';
        $filter = $request->filter ?? '';

        $services = match($filter) {
            'cat' => function ($cat) {
                return Service::whereHas('cat', function ($query) use ($cat) {
                    $query->where('name', $cat);
                })->get();
            },
            default => Service::all(),
        };

        $services = match($sort) {
            'price_0-50' => $services->orderBy('price'),
            'price_51-100' => $services->orderBy('price'),
            'price_101-500' => $services->orderBy('price'),
            'price_501-...' => $services->orderBy('price'),
            default => $services
        };

        $request->session()->put('last-hotelt-view', [
            'sort' => $sort,
            'filter' => $filter
        ]);

        return view('front.index', [
            'cat' => $cat,
            'services' => $services,
            'sortSelect' => Service::SORT,
            'sort' => $sort,
            'filterSelect' => Service::FILTER,
            'filter' => $filter,
        ]);
    }

    public function catColors(Cat $cat)
    {
        $services = $cat->service;

        return view('front.cat-index', [
            'services' => $services,
            'cat' => $cat
        ]);
    }

    public function showService(Service $service)
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


        $serviceNames = array_map(fn($p) => $p['title'], $order->services);

        // mapinam $order->servicies, ir grazninam service is vardu

        $servicies = Service::whereIn('title', $serviceNames)->get();
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