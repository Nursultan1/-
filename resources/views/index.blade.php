@extends('layouts.app')
@section('titel', 'Журнал')
@section('link')
    @parent
    <!-- Здесь можно подключить css -->
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/modal.css">
@endsection
@section('content')
        <header>
            <div class="titel">
                <h1>Электронный журнал</h1>                      
                <div class="line-blok">
                    <hr class="line line1" />
                    <hr class="line line2" />
                </div>
                
            </div>
            <div class="profil">
                <img src="img/test.jpg" alt="">
                <div class="href">
                    <h4>Фамилия Имя</h4>
                    <a href="profil.html">Личный кабинет</a>
                    <a href="">Выйти</a>
                </div>
            </div>
        </header>
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
