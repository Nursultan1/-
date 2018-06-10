@extends('layouts.app-admin')
@section('title', 'AdminPanel')
@section('link')
    @parent
@endsection
@section('content')
    <div class="col-md-7">
        <h3>Объявления</h3>
        
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Дата</th>
                    <th style="width:150px; overflow: hidden;">Текс</th>
                    <th>Изменить</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
                @foreach($adses as $ads)
                <tr>
                    <td>{{$ads->id_ads}}</td>
                    <td>{{$ads->title}}</td>
                    <td>{{$ads->date}}</td>
                    <td >{{$ads->text}}</td>
                    <td><a href="ads/update/{{$ads->id_ads}}">Изменить</a></td>
                    <td><a href="ads/delete/{{$ads->id_ads}}">Удалить</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button class="btn btn-default"> <a href="ads/create">Создать</a> </button>
    </div>
@endsection
@section('link_js')
@endsection