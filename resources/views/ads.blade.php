@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($adses as $ads)
    <div class="panel panel-default col-md-9">
        <div class="panel-heading"><h4>{{$ads->title}}</h4><h4 class="small">{{$ads->date}}</h4></div>

        <div class="panel-body">{{$ads->text}}</div>
    </div>
    @endforeach
</div>
@endsection
