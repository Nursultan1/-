@extends('layouts.app')

@section('content')
<div class="container">

    <div class="panel panel-default col-md-9">
        <div class="panel-heading"><h3>Мои предметы</h3></div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Класс</th>
                        <th>Предмет</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>{{$item['class']}}</td>
                        <td>{{$item['itemName']}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        
        
        
    </div>
@endsection
