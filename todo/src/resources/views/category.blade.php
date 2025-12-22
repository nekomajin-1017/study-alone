@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
@if (session('message'))
<div class="alert-message--alert">
    <div class="alert-message__success">
        <p class="alert-message__text">{{ session('message') }}</p>
    </div>
</div>
@endif

@if ($errors->any())
<div class="alert-message--failure">
    <ul class="alert-message__errors">
        @foreach ($errors->all() as $error)
        <li class="alert-message__error">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="category-content">
    <div class="category-header">
        <h2 class="category-title">カテゴリー管理</h2>
        <p class="category-subtitle">追加・編集・削除ができます</p>
    </div>

    <div class="category-create card">
        <h3 class="card__title">新しいカテゴリーを追加</h3>
        <form class="category-form" action="/categories" method="POST">
            @csrf
            <input class="category-input" type="text" name="name" placeholder="カテゴリー名" value="{{ old('name') }}">
            <button class="category-button category-button--primary" type="submit">作成</button>
        </form>
    </div>

    <div class="category-list card">
        <h3 class="card__title">既存のカテゴリー</h3>
        @forelse ($categories as $category)
            <div class="category-row">
                <form class="category-form category-form--update" action="/categories/{{ $category->id }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <input type="hidden" name="id" value="{{ $category->id }}">
                    <input class="category-input" type="text" name="name" value="{{ $category->name }}">
                    <button class="category-button category-button--primary" type="submit">更新</button>
                </form>
                <form class="category-form category-form--delete" action="/categories/{{ $category->id }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="category-button category-button--danger" type="submit">削除</button>
                </form>
            </div>
        @empty
            <p class="category-empty">カテゴリーがまだありません</p>
        @endforelse
    </div>
</div>
@endsection
