@extends('layouts.app')
@section('title', 'Журнал')
@section('link')
    @parent
    <!-- Здесь можно подключить css -->
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/journal.css')}}">
@endsection
@section('content')
    <div class="col-md-12 wrappers-journal">
    <?php
    //dd($data);
    ?>
        <div class="pupil-list journal-section">
            <table class="table table-bordered">
                <thead>
                    <th>ID</th>
                    <th>ФИО</th>
                </thead>
                <tbody>
                    <tr>
                        <td colspan=2>{{$data['className']}}</td>
                    </tr>
                    <tr>
                        <td></td><td ></td>
                    </tr>
                    @foreach($data['pupilList'] as $pupil)
                    <tr>
                        <td>{{$pupil->id_pupil}}</td><td  nowrap >{{$pupil->fio_pupil}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="assesments journal-section">
            <table class="table table-bordered">
                <thead>
                    <th colspan=20 >Оценки</th>
                </thead>
                <tbody>
                    <tr>
                        <td colspan=10>Апрель</td><td colspan=10>Апрель</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>2</td>
                        <td>1</td>
                        <td>2</td>
                        <td>2</td>
                        <td>1</td>
                        <td>2</td>
                        <td>2</td>
                        <td>1</td>
                        <td>2</td>
                        <td>2</td>
                        <td>1</td>
                        <td>2</td>
                        <td>2</td>
                        <td>1</td>
                        <td>2</td>
                        <td>2</td>
                        <td>2</td>
                        <td>2</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="plan journal-section">
            <table class="table table-bordered">
                <thead>
                    <th colspan=20 >План</th>
                </thead>
                <tbody>
                    <tr>
                        <td width=35px>ID</td><td >Описание</td>
                    </tr>
                    <tr>
                        <td>25</td><td>fvfv</td>
                    </tr>
                </tbody>
            </table>
        </div>
            <!-- <table class="table table-bordered table-pupil-list">
                <thead>
                    <th width=35 >ID</th>
                    <th width=350  >ФИО</th>
                    <th  rowspan=15 >Оценки</th>
                </thead>
                <tbody>
                    <tr>
                        <td>01</td><td >фddddddddиввввввввввfffffffffffffffffffffffffffffffffffffffffffввввввввввввввввввввввя отчество</td>
                    </tr>
                    <tr>
                        <td>01</td><td >фddddddddиввввввввввfffffffffffffffffffffffffffffffffffffffffffввввввввввввввввввввввя отчество</td>
                    </tr>
                </tbody>
            </table>
        <table class="table table-bordered table-plan">
            <thead>
                <th>Дата</th>
                <th>Описание</th>
            </thead>
            <tbody>
                <tr>
                    <td>01</td><td>фамилия отчество</td>
                </tr>
            </tbody>
        </table> -->
    </div>
   
@endsection
@section('link_js')
    @parent
    <!-- Здесь можно подключить js -->
    <script src="js/journal.js"></script>
@endsection