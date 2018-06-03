@extends('layouts.app-admin')
@section('title', 'AdminPanel')
@section('link')
    @parent
@endsection
@section('content')
    <div class="col-md-7">
        <admin-pupil class-name={{$className}}>
            
        </admin-pupil>
    </div>
@endsection
@section('link_js')
@endsection