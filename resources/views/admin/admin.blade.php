@extends('layouts.app-admin')
@section('title', 'AdminPanel')
@section('link')
    @parent
@endsection
@section('content')
    <div class="col-md-7">
        <table class="table table-bordered table-striped">
            <tr>
                <th>ID</th>
                <th>Класс</th>
                <th>Классный руководитель</th>
                <th>Список учеников</th>
                <th>Список предметов</th>
                <th>Изменить</th>
                <th>Удалить</th>
            </tr>
            @foreach ($classList as $classes)
                <tr>
                    <td>{{$classes['id']}}</td>
                    <td>{{$classes['name']}}</td>
                    <td>{{$classes['teache']}}</td>
                    <td><a href="{{route('pupils',['id'=>$classes['id']])}}">Посмотреть</a></td>
                    <td><a href="{{route('items',['id'=>$classes['id']])}}">Посмотреть</a></td>
                    <td><a href="{{route('update-class',['id'=>$classes['id']])}}">Изменить</a></td>
                    <td><a href="{{route('delete-class',['id'=>$classes['id']])}}">Удалить</a></td>
                </tr>
            @endforeach
        </table>
        <button class="btn"><a href="{{route('add-class')}}">Добавить новый класс</a></button>
    </div>
@endsection
@section('link_js')
@endsection
