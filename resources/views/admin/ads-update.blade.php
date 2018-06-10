@extends('layouts.app-admin')
@section('title', 'AdminPanel')
@section('link')
    @parent
@endsection
@section('content')
    <div class="col-md-7">
        <h3>Изменить</h3>
        
        @foreach($adses as $ads)
        <form action="../save/{{$ads->id_ads}}" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">  
            <div class="form-group">
                <label for="title">Заголовок</label>
                <input type="text" name="title" class="form-control" value="{{$ads->title}}" id="title">
            </div>
            <div class="form-group">
                <label for="text">Текс</label>
                <textarea name="text"  class="form-control" id="text" cols="30" rows="10">{{$ads->text}}
                </textarea>
            </div>
            <button type="submit" class="btn btn-default">Изменить</button>
        </form>
        @endforeach
    </div>
@endsection
@section('link_js')
@endsection