@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="todo__alert">
  @if (session('message'))
    <div>
      {{session('message')}}
    </div>
  @endif
  @if(count($errors)>0)
  <ul style="padding-left:0;">
    @foreach ($errors->all() as $error)
      <li style="list-style: none;">
        {{$error}}
      </li>
    @endforeach
  </ul>
  @endif
</div>

<div class="todo__content">
  <div class="section__title">
     <h2>新規作成</h2>
  </div>
  <form class="create-form" action="/todos" method="post">
    @csrf
    <div class="create-form__item">
    <input class="create-form__item-input" type="text" name="content" value="{{ old('content') }}">
    <select class="create-form__item-select" name="category_id">
      <option value="">カテゴリ</option>
      @foreach ($categories as $category)
      <option value="{{$category['id']}}">{{$category['name']}}</option>
      @endforeach
    </select>
  </div>
    <div class="create-form__button">
      <button class="create-form__button-submit" type="submit">作成</button>
    </div>
  </form>
   <div class="section__title">
   <h2>Todo検索</h2>
 </div>
 <form class="search-form" action="/todos/search" method="post">
  @csrf
   <div class="search-form__item">
     <input class="search-form__item-input" type="text" name="keyword"/> {{-- nameとvalueに注意--}}
     <select class="create-form__item-select" name="category_id">
      <option value="">カテゴリ</option>
      @foreach ($categories as $category)
      <option value="{{$category['id']}}">{{$category['name']}}</option>
      @endforeach
    </select>
   </div>
   <div class="search-form__button">
     <button class="search-form__button-submit" type="submit">検索</button>
   </div>
 </form>
  <div class="todo-table">
    <table class="todo-table__inner">
      <tr class="todo-table__row">
        <th class="todo-table__header">Todo</th>
      </tr>
       @foreach ($todos as $todo)
      <tr class="todo-table__row">
        <td class="todo-table__item">
          <form class="update-form">
          @csrf
            <div class="update-form__item">
              <input class="update-form__item-input" type="text" name="content" value="{{$todo['content']}}">
            </div>
            <div>
              <input class="update-form__item-input" type="text" name="category_id" value="{{$todo['category']['name']}}">
            </div>
        {{--<div class="update-form__button">
              <button class="update-form__button-submit" type="submit">更新</button>
            </div>   --}}
          </form>
        </td>
        <td class="todo-table__item">
          <form class="delete-form" action="/todos/delete" method="post">
          @csrf
            <div>
              <input type="hidden" name="id" value={{$todo['id']}}>
              <input type="hidden" name="content" value={{$todo['content']}}>
            </div>
            <div class="delete-form__button">
              <button class="delete-form__button-submit" type="submit">削除</button>
            </div>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection
