<?php

namespace App\Http\Controllers;

use App\Product;
use App\Thumbnail;
use Illuminate\Http\Request;

class ViewProductController extends Controller
{
    public function showProduct()
    {
        // $data=Thumbnail::all();
        // return view('viewproduct',['thumbnails'=>$data]);
        $products = Product::with('thumbnails')->where('status','1')->get();
        return view('viewproduct')->with('products',$products);
    }

    public function productDetail($id)
    {
        $products = Product::find($id);
        return view('productdetail')->with('product',$products);
    }
}



