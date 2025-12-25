<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'asc')->get();
        return view('category', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        Category::create($data);
        return redirect('/categories')->with('message', 'カテゴリーを作成しました');
    }


    public function update(CategoryRequest $request, $id)
    {
        $data = $request->validated();

        Category::findOrFail($id)->update($data);
        return redirect('/categories')->with('message', 'カテゴリーを更新しました');
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return redirect('/categories')->with('message', 'カテゴリーを削除しました');
    }
}
