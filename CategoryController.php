<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function categories()
    {
        $categories=Category::all();
        return view('layouts.categories')->with('categories',$categories);
    }

    public function createCategory()
    {
        return view('layouts.createcategory');
    }

    public function store(Request $request)
    {
         $validated = $request->validate([
             'name' => 'required|regex:/^[a-zA-Z]+$/u|unique:categories|max:255',
             'thumbnail' => 'required|mimes:jpeg,jpg,png,gif|max:2048',
         ]);

        if($request->hasFile("thumbnail")){
            $file=$request->file("thumbnail");
            $imageName=time().'_'.$file->getClientOriginalName();
            $file->move(\public_path("category/"),$imageName);

            $category = new Category([
                "name" =>$request->name,
                "thumbnail"=>$imageName,
            ]);
            $category->save();

            return redirect("/admin/categories");
        }
    }

    public function delete($id)
    {
        $categories=Category::findOrFail($id);

        if(File::exists("category/".$categories->thumbnail)){
            File::delete("category/".$categories->thumbnail);
        }
        $categories->delete();
        return back();
    }

    public function edit($id)
    {
        $categories=Category::findOrFail($id);
        return view('layouts.editcategory')->with('categories',$categories);
    }

    public function update(Request $request, $id)
    {
        $category=Category::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|regex:/^[a-zA-Z]+$/u|max:255',
            'thumbnail' => 'mimes:jpeg,jpg,png,gif|max:2048',
        ]);

     
        if($request->hasFile("thumbnail")){
            if(File::exists("category/",$category->thumbnail)){
                File::delete("category/",$category->thumbnail);
            }
            $file=$request->file("thumbnail");
            $category->thumbnail=time()."_".$file->getClientOriginalName();
            $file->move(\public_path("/category"),$category->thumbnail);
            $request['thumbnail']=$category->thumbnail;
        }

        $category->update([
            "name" =>$request->name,
            "thumbnail" =>$category->thumbnail,
        ]);
        return redirect("/admin/categories");
    }

    public function viewCategory($id)
    {
        $categories=Category::find($id);
        $products= Product::where("category_id",$categories->id)->get();
        return view('layouts.viewcategory')->with('categories',$categories)->with('products', $products);
    }
  
}
