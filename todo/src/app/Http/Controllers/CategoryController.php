<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'asc')->get();
        return view('category', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:10|unique:categories,name',
        ], [
            'name.required' => 'カテゴリー名は必須です。',
            'name.max' => 'カテゴリー名は10文字以内で入力してください。',
            'name.unique' => '同じカテゴリー名が既に存在します。',
        ]);

        Category::create($data);
        return redirect('/categories')->with('message', 'カテゴリーを作成しました');
    }


    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:10|unique:categories,name,' . $id,
        ], [
            'name.required' => 'カテゴリー名は必須です。',
            'name.max' => 'カテゴリー名は10文字以内で入力してください。',
            'name.unique' => '同じカテゴリー名が既に存在します。',
        ]);

        Category::findOrFail($id)->update($data);
        return redirect('/categories')->with('message', 'カテゴリーを更新しました');
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return redirect('/categories')->with('message', 'カテゴリーを削除しました');
    }
}
