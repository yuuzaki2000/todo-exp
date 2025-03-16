<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function index(){
        $categories = Category::all();
        return view('category', compact('categories'));
    }

    public function store(Request $request){
        $form = $request->all();
        Category::create($form);
        return redirect('/categories');
    }
}
