<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addtocart(Request $request){
        if($request->session()->has('user'))
        {
            $cart = new Cart();
            $cart->product_id = $request->input('product_id');
            $cart->user_id = $request->session()->get('user')['id'];
            $cart->save();
            return back();
        
        }
        else
        {
            print('haiiiii');
        }
    }
    public function CartList()
    {
        $userId=Session::get('user')['id'];
        $products= DB::table('carts')
        ->join('products','carts.product_id','=','products.id')
        ->where('carts.user_id',$userId)
        ->select('products.*','carts.id as cart_id')
        ->get();

        return view('Home.cart',['products'=>$products]);
    }
    public function removeCart($id)
    {
        Cart::destroy($id);
        return back();
    }
    public function Buynow()
    {
        $userId=Session::get('user')['id'];
        $products= DB::table('carts')
        ->join('products','carts.product_id','=','products.id')
        ->where('carts.user_id',$userId)
        ->select('products.*','carts.id as cart_id')
        ->get();

        return view('Home.buynow',['products'=>$products]);
    }
}
