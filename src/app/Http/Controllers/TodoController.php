<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;
use App\Models\Category;


class TodoController extends Controller
{
    //
    public function index(){
        $todos = Todo::with('Category')->get();
        $categories = Category::all();
        return view('index',['todos' => $todos, 'categories' => $categories]);
    }

    public function store(Request $request){
        $form = $request->only(['category_id', 'content']);
        Todo::create($form);
        return redirect('/')->with('message','Todoを作成しました');
    }

    public function destroy(Request $request){
        Todo::find($request->id)->delete();
        return redirect('/')->with('message','Todoを削除しました。');
    }
}
