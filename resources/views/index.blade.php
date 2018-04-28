@extends('layouts.app')
@section('titel', 'Журнал')
@section('link')
    @parent
    <!-- Здесь можно подключить css -->
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/modal.css">
@endsection
@section('content')
        <div class="content">
            <div class="klassy">
            <?php $class=1?>
                @foreach ($classList as $list)
                    <div class="klass">
                    <h3><?php echo $class; $class++?>-класс</h3>
                        <ul>
                            @foreach ($list as $Item)
                               <li v-on:click="showHideModal=true">{{$Item->class_name_numbe}}_{{$Item->class_name_categori}}_класс</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    <!-- Модальное окно -->
    <div id='win' v-if="showHideModal">
        <div class="modalU"></div>
        <div class="modal-okno">
            <div class="header-modal"><img src="img/x.png" @click="showHideModal=false" alt="">
            </div>
            
            <br/>
            <a href="journal.html">журнал</a>
        </div>
    </div>
    <!-- Здесь можно тело страницы-->
@endsection
@section('link_js')
    @parent
    <!-- Здесь можно подключить js -->
@endsection
