@extends('layouts.app')
@section('title', 'Журнал')
@section('link')
    @parent
    <!-- Здесь можно подключить css -->
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/journal.css')}}">
@endsection
@section('content')
<journal class-name={{$data['className']}} id-item={{$data['id_item']}}>
    
</journal>  
<!-- <div class="col-md-12">
    <div class="header-less">
        <h3 class="col-md-offset-5 col-md-2 ">Русский язык</h3>
        <div class="wrap-time col-md-offset-4  col-md-2">
            <h4>Время до конца урока: 25:25</h4>
        </div>
    </div>
    <div class="wrappers-journal">
        <div class="pupil-list journal-section">
            <div class="item"></div>
            <div class="item"></div>
            <div class="item">
                <div class="id">1</div>
                <div class="fio">Абдазов Нурсултан</div>
            </div>
            <div class="item">
                <div class="id">1</div>
                <div class="fio">Абдазов Нурсултан</div>
            </div>
            <div class="item">
                <div class="id">1</div>
                <div class="fio">Абдазов Нурсултан</div>
            </div>
            <div class="item">
                <div class="id">1</div>
                <div class="fio">Абдазов Нурсултан</div>
            </div>
            <div class="item">
                <div class="id">1</div>
                <div class="fio">Абдазов Нурсултан</div>
            </div>
            <div class="item">
                <div class="id">1</div>
                <div class="fio">Абдазов Нурсултан</div>
            </div>
            <div class="item">
                <div class="id">1</div>
                <div class="fio">Абдазов Нурсултан</div>
            </div>
            <div class="item">
                <div class="id">1</div>
                <div class="fio">Абдазов Нурсултан</div>
            </div>
            <div class="item">
                <div class="id">12</div>
                <div class="fio">Абдазов Нурсултан</div>
            </div>
        </div>
        <div class="assesments journal-section">
            <div class="month">
                <div class=" item month-header">
                    Май
                </div>
                <div class="lessons">
                    <div class="lesson">
                        <div class="item lesson-day">5</div>
                        <div class="item osenka">5</div>
                        <div class="item osenka"></div>
                        <div class="item osenka">5</div>
                        <div class="item osenka">5</div>
                        <div class="item osenka"></div>
                    </div>
                    <div class="lesson">
                        <div class="item lesson-day">5</div>

                        <div class="item osenka">5</div>
                        <div class="item osenka"></div>
                        <div class="item osenka">5</div>
                        <div class="item osenka">5</div>
                        <div class="item osenka"></div>
                    </div>
                    <div class="lesson">
                        <div class="item lesson-day">5</div>
                        <div class="item osenka">5</div>
                        <div class="item osenka"></div>
                        <div class="item osenka">5</div>
                        <div class="item osenka">5</div>
                        <div class="item osenka"></div>
                    </div>
                </div>
            </div>
            <div class="month">
                <div class=" item month-header">
                    Май
                </div>
                <div class="lessons">
                    <div class="lesson">
                        <div class="item lesson-day">5</div>
                        <div class="item osenka">5</div>
                        <div class="item osenka"></div>
                        <div class="item osenka">5</div>
                        <div class="item osenka">5</div>
                        <div class="item osenka"></div>
                    </div>
                    <div class="lesson">
                        <div class="item lesson-day">5</div>
                        
                        <div class="item osenka">5</div>
                        <div class="item osenka"></div>
                        <div class="item osenka">5</div>
                        <div class="item osenka">5</div>
                        <div class="item osenka"></div>
                    </div>
                    <div class="lesson">
                        <div class="item lesson-day">5</div>

                        <div class="item osenka">5</div>
                        <div class="item osenka"></div>
                        <div class="item osenka">5</div>
                        <div class="item osenka">5</div>
                        <div class="item osenka"></div>
                    </div>
                </div>
            </div>
            <div class="month">
                <div class=" item month-header">
                    Май
                </div>
                <div class="lessons">
                    <div class="lesson">
                        <div class="item lesson-day">5</div>
                        <div class="item osenka">5</div>
                        <div class="item osenka"></div>
                        <div class="item osenka">5</div>
                        <div class="item osenka">5</div>
                        <div class="item osenka"></div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn"><img src="{{asset('img/add-icon.png')}}" alt=""></button>
        
        
        </div>
        <div class="plan journal-section">
            <div class="item">
                <div class="date">09.21</div>
                <div class="desc">Алгоритмы сортирования</div>
            </div>
            <div class="item">
                <div class="date">09.21</div>
                <div class="desc">Алгоритмы сортирования</div>
            </div>
            <div class="item">
                <div class="date">09.21</div>
                <div class="desc">Алгоритмы сортирования</div>
            </div>
            <div class="item">
                <div class="date">09.21</div>
                <div class="desc">Алгоритмы сортирования</div>
            </div>
            <div class="item">
                <div class="date">09.21</div>
                <div class="desc">Алгоритмы сортирования</div>
            </div>
            <div class="item">
                <div class="date">09.21</div>
                <div class="desc">Алгоритмы сортирования</div>
            </div>

            <div class="item">
                <div class="date">09.21</div>
                <div class="desc">Алгоритмы сортирования</div>
            </div>
            <div class="item">
                <div class="date">09.21</div>
                <div class="desc">Алгоритмы сортирования</div>
            </div>
            <div class="item">
                <div class="date">09.21</div>
                <div class="desc">Алгоритмы сортирования</div>
            </div>
            <div class="item">
                <div class="date">09.21</div>
                <div class="desc">Алгоритмы сортирования</div>
            </div>
            <div class="item">
                <div class="date">09.21</div>
                <div class="desc">Алгоритмы сортирования</div>
            </div>
        </div>
    </div>
</div> -->





@endsection
@section('link_js')
    @parent
    <!-- Здесь можно подключить js -->
    <script src="{{asset('js/journal.js')}}"></script>
@endsection
