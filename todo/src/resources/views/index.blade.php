@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
@if (session('message'))
<div class="alert-message--alert">
    <ul class="alert-message__success">
        <li class="alert-message__text">{{ session('message') }}</li>
    </ul>
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

<div class="todo-page">
    <div class="todo-top">
        <div class="card todo-panel">
            <div class="card__header">
                <h2 class="card__title">新規Todo</h2>
                <p class="card__subtitle">タスク内容とカテゴリーを入力</p>
            </div>
            <form class="todo-form" action="/todos" method="POST">
                @csrf
                <input class="todo-input" type="text" name="to_be_done" placeholder="新しいTodoを追加" value="{{ old('to_be_done') }}">
                <select class="todo-select" name="category_id" required>
                    <option value="" disabled {{ old('category_id') === null ? 'selected' : '' }}>カテゴリーを選択</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <button class="todo-button todo-button--primary" type="submit">新規作成</button>
            </form>
        </div>

        <div class="card todo-panel">
            <div class="card__header">
                <h2 class="card__title">検索</h2>
                <p class="card__subtitle">キーワードやカテゴリーで絞り込み</p>
            </div>
            <form class="todo-form" action="/todos/search" method="GET">
                @csrf
                <input class="todo-input" type="text" name="search" placeholder="検索ワードを入力">
                <select class="todo-select" name="search_category">
                    <option value="" selected>すべて</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <button class="todo-button" type="submit">検索</button>
            </form>
        </div>
    </div>

    <div class="card todo-list">
        <div class="todo-list__header">
            <div>
                <h2 class="todo-list__title">Todo一覧</h2>
                <p class="todo-list__small-title">合計 {{ $todos->total() }} 件</p>
            </div>
        </div>
        <ul class="todo-list__items">
            @forelse ($todos as $todo)
            <li class="todo-list__item">
                <form class="todo-list__form todo-list__form--update" action="/todos/{{ $todo['id'] }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="is_complete" value="0">
                    <label class="todo-list__check">
                        <input class="todo-list__checkbox" type="checkbox" name="is_complete" value="1" {{ $todo['is_complete'] ? 'checked' : '' }}>
                        <span>完了</span>
                    </label>
                    <input class="todo-list__line" type="text" name="to_be_done" value="{{ $todo ['to_be_done'] }}">
                    <select class="todo-list__category-options" name="category_id" required>
                        <option value="" disabled>カテゴリー</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $todo['category_id'] == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <button class="todo-list__update-button" type="submit">更新</button>
                </form>
                <form class="todo-list__form todo-list__form--delete" action="/todos/{{ $todo['id'] }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="todo-list__delete-button" type="submit">削除</button>
                </form>
            </li>
            @empty
            <li class="todo-list__item todo-list__item--empty">Todoがまだありません</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
