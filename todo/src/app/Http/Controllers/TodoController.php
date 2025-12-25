<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::with('category')->orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::orderBy('created_at', 'asc')->get();

        return view('index', ['todos' => $todos, 'categories' => $categories]);
    }

    public function store(TodoRequest $request)
    {
        Todo::create($request->validated());
        return redirect('/')->with('message', 'Todoを作成しました');
    }

    public function update(TodoRequest $request, $id)
    {

        $todo = Todo::findOrFail($id);
        $todo->is_complete = $request->is_complete ?? false;
        $todo->to_be_done = $request->to_be_done;
        $todo->category_id = $request->category_id;
        $todo->save();

        return redirect('/')->with('message', 'Todoを更新しました');
    }

    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return redirect('/')->with('message', 'Todoを削除しました');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $search_category = $request->input('search_category');

        $query = Todo::query();

        if ($search) {
            $query->where('to_be_done', 'like', "%{$search}%");
        }

        if ($search_category !== null && $search_category !== '') {
            $query->where('category_id', $search_category);
        }

        $todos = $query->with('category')->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        $categories = Category::orderBy('created_at', 'asc')->get();

        return view('index', ['todos' => $todos, 'categories' => $categories]);
    }
}
