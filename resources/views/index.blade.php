@extends('layouts.app')
@section('title', 'Журнал')
@section('link')
    @parent
    <!-- Здесь можно подключить css -->
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/modal.css">
@endsection
@section('content')
    @for($i=1; $i<=11; $i++)
    <classes number={{$i}}>

    </classes>
    @endfor
@endsection
@section('link_js')
    @parent
    <!-- Здесь можно подключить js -->
@endsection
