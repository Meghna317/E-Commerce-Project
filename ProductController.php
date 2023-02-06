<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Thumbnail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class ProductController extends Controller
{
    public function products()
    {
        $categories=Category::all();
        $products=Product::all();
        return view('layouts.products')->with('products',$products)->with('categories',$categories);
    }

    public function createProduct()
    {
        $categories=Category::all();
        return view('layouts.createproduct')->with('categories',$categories);
    }

    public function storeProduct(Request $request)
    {
         $validated = $request->validate([
             'name' => 'required|unique:products|max:255',
             'price' => 'required|numeric',
             'sku' => 'required|unique:products,sku|max:255',
             'category_id' => 'required',
             'description' => 'required',
         ]);

         $product = new Product([
            "name" =>$request->name,
            "price" =>$request->price,
            "sku" =>$request->sku,
            "category_id" =>$request->category_id,
            "description" =>$request->description,
        ]);
        $product->save();

         if($request->hasFile("thumbnails")){
            $files=$request->file("thumbnails");
            foreach($files as $file){
                $imageName=time().'_'.$file->getClientOriginalName();
                $request['product_id']=$product->id;
                $request['thumbnail']=$imageName;
                $file->move(\public_path("thumbnails/"),$imageName);
                Thumbnail::create($request->all());
            }
        }
            return redirect("/admin/products");
    }

    public function editProduct($id)
    {
        $categories = Category::all();
        $products=Product::findOrFail($id);
        return view('layouts.editproduct')->with('products', $products)->with('categories',$categories);
    }

    public function deleteProduct($id)
    {
        $products=Product::findOrFail($id);
        $thumbnails=Thumbnail::where("product_id",$products->id)->get();
        foreach($thumbnails as $thumbnail){
            if(File::exists("thumbnails/".$thumbnail->thumbnail)){
                File::delete("thumbnails/".$thumbnail->thumbnail);
            }
        }
        $products->thumbnails()->delete();
        $products->delete();
        return back();
    }

    public function updateProduct(Request $request, $id)
    {
        $product=Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'sku' => 'required|max:255',
            'category_id' => 'required',
            'description' => 'required',

        ]);


        $product->update([
            "name" =>$request->name,
            "price" =>$request->price,
            "sku" =>$request->sku,
            "category_id" =>$request->category_id,
            "description" =>$request->description,
        ]);

        $imageName=Thumbnail::where('product_id', $id)->get();
        if($request->hasFile("thumbnails")){
           foreach($imageName as $thumbnail){
            Thumbnail::where("id",$thumbnail->id)->delete();
            if(File::exists("thumbnails/".$thumbnail->thumbnail)){
                File::delete("thumbnails/".$thumbnail->thumbnail);
            }
           }
            $files=$request->file("thumbnails");
            foreach($files as $file){
                $imageName->thumbnail=time().'_'.$file->getClientOriginalName();
                $file->move(\public_path("/thumbnails"),$imageName->thumbnail);
                $request["product_id"]=$id;
                $request["thumbnail"]=$imageName->thumbnail;
                Thumbnail::create($request->all());
            }
        }
        return redirect("/admin/products");
    }

    public function statusUpdate($id)
    {
        $product = Product::where('id',$id)->select('status')->first();
        if($product->status == '1'){
            $status = '0';
        }else{
            $status = '1';
        }

        $values = array('status'=>$status);
        Product::where('id',$id)->update($values);
        return redirect("/admin/products");
    }

    public function changeStatus(Request $request)
    {
        $product = Product::find($request->id);
        $product->status = $request->status;
        $product->save();
        return response()->json(['success'=>'Status change successfully.']);
    }

    public function search(Request $request)
    {
        $query = Product::query();

        if($request->ajax()){
            $products = $query->where('name','LIKE','%'.$request->search.'%')
            ->get();

            return view('layouts.searchproducts',compact('products'));
        }
        else{
            $products = $query->get();
            return View('layouts.products',compact('products'));
        }
    }

    public function filter(Request $request)
    {
        $query = Product::query();
        $categories = Category::all();

        if($request->ajax()){
            $products = $query->where(['category_id'=>$request->category])->get();
            return view('layouts.searchproducts',compact('products'));
        }
            $products = $query->get();
            return View('layouts.products',compact('categories','products'));
    }


    public function sort(Request $request)
    {
        if($request->ajax()){

            if($request->product=='name')
            {
                $products = Product::orderBy('name','DESC')->get();
            }
            else if($request->product=='price')
            {
                $products = Product::orderBy('price','ASC')->get();
            }
            else if($request->product=='price-desc')
            {
                $products = Product::orderBy('price','DESC')->get();
            }
            else if($request->product=='sku')
            {
                $products = Product::orderBy('sku','DESC')->get();
            }
            else{
                $products = Product::all();
            }
            return view('layouts.searchproducts',compact('products'));
        }
            return View('layouts.products',compact('products'));
    }
}

