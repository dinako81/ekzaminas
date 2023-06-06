<?php

namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\Cat;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class FrontController extends Controller
{
    public function index()
    {
        $services = Service::all();

        return view('front.index', [
            'services' => $services
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