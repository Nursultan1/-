@extends('layouts.app')
@section('titel', 'AdminPanel')
@section('link')
    @parent
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/modal.css">
@endsection
@section('content')
    <header>
        <a href="index.html"><h1>На главная</h1></a>
        <a href="#"><h1>Классы</h1></a>
        <a href="#"><h1>Преподователи</h1></a>
        <a href="#"><h1>Запросы на регистрацию</h1></a>
    </header>
    <div class="content">
        <div class="edit">
            <h2>Редактирования</h2>
            <form action="{{url('save',[$inf['id']])}}" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="id" value="{{$inf['id']}}">
                <table>
                    <tr>
                        <td width="100px" >ID</td><td width="250px">Номер</td><td width="250px">Буква</td><td width="250px">Классный руководитель</td>
                    </tr>
                    <tr>
                        <td>{{$inf['id']}}</td><td><input type="text" value="{{$inf['nomer']}}" name="nomer" id=""></td><td><input type="text" value="{{$inf['bukva']}}" name="bukva" id=""></td><td><input value="{{$inf['nameTeache']}}" type="text" name="teache" id=""></td>
                    </tr>
                </table>
            
                <div>
                    <input type="submit" value="Сохранить">
                </div>
            </form>
            <a href="{{url('admin')}}"><button>Отмена</button></a>
        </div>
    </div>
@endsection
@section('link_js')
@endsection
