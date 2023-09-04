<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Cart;
use App\Models\ShippingCharge;
use App\Models\Order;
use Session;

class SiteController extends Controller
{
    public function getHome(){
        $data=[
            'products'=> Product::where('status', 'show')->get()
        ];
        return view('site.home', $data);
    }
    public function getCart(){
        if(Session::get('cartcode'))
        {
            $carcode = Session::get('cartcode');
            $data =[
                'carts' => Cart::where('code', $carcode)->get()
            ];
            return view('site.carts', $data);
        }
        else{
            abort(404);
        }
    }
    public function getAddCart(Product $product){
        $code = Str::random(6);
        $qty = 1;
        if(Session::get('cartcode')){
        $cart = New Cart;
        $cart->product_id = $product->id;
        $cart->qty = $qty;
        $cart->cost = $product->cost;
        $cart->totalcost = $product->cost*$qty;
        $cart->code = Session::get('cartcode');
        $cart->save();

        }
        else{

            $cart = New Cart;
            $cart->product_id = $product->id;
            $cart->qty = $qty;
            $cart->cost = $product->cost;
            $cart->totalcost = $product->cost*$qty;
            $cart->code = $code;
            $cart->save();
            Session::put('cartcode', $code);
        }
        return redirect()->route('getCart');
        
    }


    public function getCheckOut()
    {
        $data =[
            'shippings' => ShippingCharge::where('Status', 'show')->get(),
            'carts' => Cart::where('code', Session::get('cartcode'))->get(),
            'subtotal' => Cart::where('code', Session::get('cartcode'))->sum('totalcost')
        ];
        return view ('site.checkout', $data);
    }
    public function postAjax(Request $request){
        $shppingkoid = $request->get('shipping');
        //$shippinginfo = ShippingCharge::where('id', $shippingkoid)->limit(1)->first();
        $shippinginfo = ShippingCharge::find($shppingkoid);
        
        $code = Session::get('cartcode');
        //dd($code);
        $totalamount = Cart::where('code', $code)->sum('totalcost');
        $grandtotal = $shippinginfo->Charge+$totalamount;
        return response(['totalamount' => $totalamount, 'grandtotal' => $grandtotal, 'shippingcost'=> $shippinginfo->Charge]);

    }

    public function postAddOrder(Request $request)
    {
        $cartcode= Session::get('cartcode');
        $name=$request->name;
        $address=$request->address;
        $email=$request->email;
        $number=$request->phone;
        $area_id=$request->shipping;
        $payment_type=$request->paymentmethod;
        $product_cost = Cart::where('code', $cartcode)->sum('totalcost');
        
        $shippinginfo = ShippingCharge::find($area_id);
       
        $shipping_cost= $shippinginfo->Charge;
        $grand_total= $product_cost+$shipping_cost;
       

        $details= new order;

        $details->cartcode=$cartcode;
        $details->name=$name;
        $details->address=$address;
        $details->email=$email;
        $details->number=$number;
        $details->area_id=$area_id;
        $details->paymenttype=$payment_type;
        $details->productcost=$shippinginfo;
        $details->shippingcost=$shipping_cost;
        $details->grandtotal=$grand_total;
        $details->save();

        return view('getCart');
}
}
