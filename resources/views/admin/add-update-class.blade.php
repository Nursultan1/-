@extends('layouts.app-admin')
@section('title', 'AdminPanel')
@section('link')
    @parent
@endsection
@section('content')
    <?php
    // var_dump($class);
    ?>
    <div class="col-md-6 col-md-offset-1">
        <form class="form-horizontal" method="post" action="{{route('save-class')}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">    
            @if(isset($class))
                <input type="hidden" name="id" value="{{$class['id']}}">
                <div class="form-group">
                    <label for="sel1">Классный руководитель:</label>
                    <select class="form-control" id="sel1" name="teache">
                        <option value="{{$class['teacheCurrentID']}}" selected>{{$class['teacheCurrent']}}</option>
                        @foreach($class['teaches'] as $teache )
                        <option value="{{$teache->id_teache}}">{{$teache->fio_teache}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="numbe">Какой класс</label>
                    <input class="form-control" name="numbe" type="text" id="numbe" value="{{$class['numbe']}}">
                </div>
                <div class="form-group">
                    <label for="">Категории класса</label>
                    <input class="form-control" name="category" type="text" value="{{$class['category']}}">
                </div>
                <input type="submit" value="Сохранить" class="btn btn-primary btn-block">
            @elseif(isset($teaches))
                <div class="form-group">
                    <label for="sel1">Классный руководитель:</label>
                    <select class="form-control" id="sel1" name="teache">
                        @foreach($teaches as $teache )
                        <option value="{{$teache->id_teache}}">{{$teache->fio_teache}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="numbe">Какой класс</label>
                    <select class="form-control" name="numbe" id="numbe">
                        @for($i = 1; $i < 12; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label for="category">Категории класса</label>
                    <select class="form-control" name="category" id="category">
                        <option value="a">a</option>
                        <option value="b">b</option>
                        <option value="c">c</option>
                        <option value="d">d</option>
                    </select>
                </div>
                <input type="submit" value="Сохранить" class="btn btn-primary btn-block"> 
            @endif
        </form>
    </div>
@endsection
@section('link_js')
@endsection