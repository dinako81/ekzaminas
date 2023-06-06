<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Cart;
use App\Models\Order;

class CartController extends Controller
{
    public function add(Request $request)
    {

        $id = (int) $request->id;
        $count = (int) $request->count;
        $cart = $request->session()->get('cart', []);
        // jeigu preke neekzistuoja tada kuriama nauja
        if (!isset($cart[$id])) {
            $cart[$id] = $count;
        } else {
            $cart[$id] += $count;
        }
        // else prie ekzistuojancios pridedam dar tokia pat. Isesija nedadam kainos, nes ji gali kisti. Kai reikes skaiciupti kaina, eisin i DB pasiimsim visas prekes ir suskaiciuosim kaina 
        $request->session()->put('cart', $cart);

        $Cart = new Cart($cart);
        // nauja entities, kuriame nurodem skaiciavima
        
        return response()->json([
            'count' => count($cart),
            'total' => $Cart->total()
        ]);
        // grazinimas JSinis
    }

    public function miniCart(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $Cart = new Cart($cart);
        return response()->json([
            'count' => count($cart),
            'total' => $Cart->total()
        ]);
         // grazinimas JSinis
    }

    public function showCart(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $Cart = new Cart($cart);

        return view('front.cart', [
            'count' => count($cart),
            'total' => $Cart->total(),
            'services' => $Cart->services()
            // $Cart->services() is entities Cart
        ]);
    }

    public function rem(Request $request)
    {

        $id = (int) $request->id;
        $cart = $request->session()->get('cart', []);
        unset($cart[$id]);
        // istrina
        $request->session()->put('cart', $cart);

        return redirect()->back();
        
    }

    public function update(Request $request)
    {

        $id = (int) $request->id;
        // ka update
        $count = (int) $request->count;
        // i ka update
        $cart = $request->session()->get('cart', []);
        $cart[$id] = $count;
        // updatinam nauja kieki
        $request->session()->put('cart', $cart);
        // idedam

        return redirect()->back();

    }


    public function buy(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $Cart = new Cart($cart);

        $services = [];
        $total = 0;

        $Cart->services()->each(function($p, $key) use (&$total, &$services) {

            $services[$key]['title'] = $p->title;
            $services[$key]['count'] = $p->count;
            $services[$key]['price'] = $p->price;
            $services[$key]['total'] = $p->count * $p->price;
            $total += $services[$key]['total'];

        });

        // $services = json_encode($services);
        $userId = $request->user()->id;

        Order::create([
            'services' => $services,
            'user_id' => $userId,
            'price' => $total
        ]);

        $request->session()->put('cart', []);

        // kai viska upirkom reikia is sesijos istrinti krepseli

        return redirect()->route('front-index');

    }
    
}