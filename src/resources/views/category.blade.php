@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}"/>
@endsection

@section('content')
<div class="category__alert">
    @if(session('message'))
    <div class="category__alert--success">{{session('message')}}</div>
    @endif

    @if($errors->any())
    <div class="category__alert--danger">
        <ul >
            @foreach ($errors->all() as $error)
            <li >{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="category__content">
    <form action="/categories" method="post" class="create-form">
        @csrf
        <div class="create-form__item">
            <input type="text" name="name" class="create-form__item-input" value="{{old('name')}}">
        </div>
        <div class="create-form__button">
            <button class="create-form__button-submit" type="submit">作成</button>
        </div>
    </form>



    <div class="category-table">
        <table class="category-table__inner">
            <th class="category-table__header category-table__item--col1">カテゴリ</th>

            @foreach($categories as $category)
            <tr class="category-table__row">
                <form action="/categories/update" method="post" class="update-form">
                    @method('PATCH')
                    @csrf
                    <td class="category-table__item--col1">
                        <input type="text" name="name" value="{{ $category['name']}}" class="update-form__item-input">
                        <input type="hidden" name="id" value="{{ $category['id'] }}">
                    </td> 

                    <td class="category-table__item--col2">
                        <div class="category-table__button">
                            <button class="update-form__button-submit" type="submit">更新</button>
                        </div>
                    </td>
                </form>
                
                <td class="category-table__item--col3">
                    <form action="/categories/delete" method="post" class="delete-form">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="id" value="{{ $category['id'] }}">
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