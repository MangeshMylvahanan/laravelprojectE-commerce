<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        return view('Admin.productsadd');
    }
    public function home(){
        $product = Product::all();
        return view('Home.home',['product'=>$product]);
    }
    //for productsadd
    /**
     * Summary of productsadd
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function productsadd(Request $request){
        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_discount = $request->input('product_discount');
        $product->product_discountprice = $request->input('product_discountprice');
        $product->product_description = $request->input('product_description');
        $product->catagory = $request->input('catagory');
        $product->sub_catagory = $request->input('sub_catagory');
        if($request->hasFile('product_image'))
        {
            $image = $request->file('product_image');
            $request->validate(['product_image'=>'required|image']);
            $extension = $image->getClientOriginalExtension();
            $imagename = time().'.'.$extension;
            $image->move('uploads',$imagename);
            $product->product_image = $imagename;
            $product->save();
            return back()
            ->withSuccess('you have successfully added the product details! ');
        }
    }
    public function shop(){
        $products = Product::all();
        return view('Home.shop',['products'=>$products]);
    }
    public function detail($id){
        $data = Product::find($id);
        return view('Home.detail',['products'=>$data]);
    }
    public function BuyNow()
    {
        return view('Home.buynow');
    }

}
