<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class ShowCategoryController extends Controller
{
    public function showCategory()
    {
        $data=Category::all();
        return view('showcategory',['categories'=>$data]);
    }
}

