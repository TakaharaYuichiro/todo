@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}"/>
@endsection

@section('content')
<div class="todo__alert">
    @if(session('message'))
    <div class="todo__alert--success">{{session('message')}}</div>
    @endif

    @if($errors->any())
    <div class="todo__alert--danger">
        <ul >
            @foreach ($errors->all() as $error)
            <li >{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="todo__content">
    <div class="section__title">
        <h2>新規作成</h2>
    </div>
    <form action="/todos" method="post" class="create-form">
        @csrf
        <div class="create-form__item">
            <input type="text" name="content" class="create-form__item-input" value="{{old('content')}}">
            <select class="create-form__item-select" name="category_id">
                @foreach($categories as $category)
                    <option value="{{$category['id']}}">{{$category['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="create-form__button">
            <button class="create-form__button-submit" type="submit">作成</button>
        </div>
    </form>



    <div class="todo-llst">
        
        <div class="search-section">
            <div class="search-section__title">
                <h2>Todoリスト</h2>
            </div>


            
            <div class="search-section__child">
                <form  class="search-form" action="/todos/search" method="get">
                    @csrf
                    <div class="search-form__item">
                        <p>キーワード</p>
                        <input type="text" name="keyword" class="search-form__item-input" value="{{old('keyword')}}">
                    </div>
                    <div class="search-form__select">
                        <p>カテゴリ</p>
                        <select class="search-form__item-select" name="category_id" >
                            <option value="" selected>全て</option>
                            @foreach($categories as $category)
                                <option value="{{$category['id']}}">{{$category['name']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="search-form__button">
                        <button class="search-form__button-submit" type="submit">検索</button>
                    </div>
                </form>
            </div>

            <!-- <div class="search-section__child">
                <h3 class="serach__title">キーワードで絞り込み</h3>
                <form  class="search-form" action="/todos/search/keyword" method="get">
                    @csrf
                    <div class="search-form__item">
                        <input type="text" name="keyword" class="search-form__item-input" value="{{old('keyword')}}">
                    </div>
                    <div class="search-form__button">
                        <button class="search-form__button-submit" type="submit">検索</button>
                    </div>
                </form>
            </div>

            <div class="search-section__child">
                <h3 class="serach__title">カテゴリで絞り込み</h3>
                <form  class="search-form" action="/todos/search/category" method="get">
                    @csrf
                    <div class="search-form__item">
                        <select class="search-form__item-select" name="category_id"  value="{{old('category')}}">
                            <option value="">全て</option>
                            @foreach($categories as $category)
                                <option value="{{$category['id']}}">{{$category['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="search-form__button">
                        <button class="search-form__button-submit" type="submit">検索</button>
                    </div>
                </form>
            </div>        -->
        </div>


        <div class="todo-table">
            <table class="todo-table__inner">
                <th class="todo-table__header todo-table__item--col1">Todo</th>
                <th class="todo-table__header todo-table__item--col1-2">カテゴリ</th>

                
                @foreach($todos as $todo)
                <tr class="todo-table__row">
                    <form action="/todos/update" method="post" class="update-form">
                        @method('PATCH')
                        @csrf
                        <td class="todo-table__item--col1">
                            <input type="text" name="content" value="{{ $todo['content']}}" class="update-form__item-input">
                            <input type="hidden" name="id" value="{{ $todo['id'] }}">
                        </td> 
                        <td class="todo-table__item--col1-2">
                            <div class="update-form__item-p">
                                {{$todo['category']['name']}}
                            </div>
                        </td> 
                        <td class="todo-table__item--col2">
                            <div class="todo-table__button">
                                <button class="update-form__button-submit" type="submit">更新</button>
                            </div>
                        </td>
                    </form>
                    
                    <td class="todo-table__item--col3">
                        <form action="/todos/delete" method="post" class="delete-form">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="id" value="{{ $todo['id'] }}">
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

   


</div>
@endsection