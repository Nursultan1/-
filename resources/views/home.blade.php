@extends('layouts.app')

@section('content')
<div class="container">
    <Home id="{{Auth::user()->id_teache }}" fio="{{Auth::user()->fio_teache }}" email="{{Auth::user()->email }}"></Home>
</div>
@endsection
