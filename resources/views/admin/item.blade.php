@extends('layouts.app-admin')
@section('title', 'AdminPanel')
@section('link')
    @parent
@endsection
@section('content')
    <div class="col-md-7">
        <admin-items class-name="{{$className}}">
            
        </admin-items>
    </div>
@endsection
@section('link_js')
@endsection