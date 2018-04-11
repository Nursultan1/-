@extends('layouts.app')
@section('titel', 'Журнал')
@section('link')
    @parent
    <!-- Здесь можно подключить css -->
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/modal.css">
@endsection
@section('content')
    <div class="wrapper">
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
                <div class="klass">
                    <h3>1-класс</h3>
                    <ul>
                        <li v-on:click="showHideModal=true" >1_а_класс</a></li>
                        <li >1_б_класс</li>
                        <li >1_в_класс</li>
                    </ul>
                </div>
                <div class="klass">  
                    <h3>2-класс</h3>
                    <ul>
                        <li>1_а_класс</li>
                        <li>1_б_класс</li>
                        <li>1_в_класс</li>
                    </ul>
                </div>
                <div class="klass">
                    <h3>3-класс</h3>
                    <ul>
                        <li>1_а_класс</li>
                        <li>1_б_класс</li>
                        <li>1_в_класс</li>
                    </ul>  
                </div>
                <div class="klass">
                    <h3>4-класс</h3>
                    <ul>
                        <li>1_а_класс</li>
                        <li>1_б_класс</li>
                        <li>1_в_класс</li>
                    </ul>  
                </div>
                <div class="klass">
                    <h3>5-класс</h3>
                    <ul>
                        <li>1_а_класс</li>
                        <li>1_б_класс</li>
                        <li>1_в_класс</li>
                    </ul>  
                </div>
                <div class="klass">
                    <h3>6-класс</h3>
                    <ul>
                        <li>1_а_класс</li>
                        <li>1_б_класс</li>
                        <li>1_в_класс</li>
                    </ul>  
                </div>
                <div class="klass">
                    <h3>7-класс</h3>
                    <ul>
                        <li>1_а_класс</li>
                        <li>1_б_класс</li>
                        <li>1_в_класс</li>
                    </ul>  
                </div>
                <div class="klass">
                    <h3>8-класс</h3>
                    <ul>
                        <li>1_а_класс</li>
                        <li>1_б_класс</li>
                        <li>1_в_класс</li>
                    </ul>  
                </div>
                <div class="klass">
                    <h3>9-класс</h3>
                    <ul>
                        <li>1_а_класс</li>
                        <li>1_б_класс</li>
                        <li>1_в_класс</li>
                    </ul>  
                </div>
                <div class="klass">
                    <h3>10-класс</h3>
                    <ul>
                        <li>1_а_класс</li>
                        <li>1_б_класс</li>
                        <li>1_в_класс</li>
                    </ul>  
                </div>
                <div class="klass">
                    <h3>11-класс</h3>
                    <ul>
                        <li>1_а_класс</li>
                        <li>1_б_класс</li>
                        <li>1_в_класс</li>
                    </ul>  
                </div>
            </div>
        </div>
        <footer>
            <h4> © 2016г ПКМУК | Все права защищены.</h4>
        </footer>
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
