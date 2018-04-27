@extends('layouts.app')
@section('titel', 'AdminPanel')
@section('link')
    @parent
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/modal.css">
@endsection
@section('content')
    <header>
        <a href="index.html"><h1>На главная</h1></a>
        <a href="#"><h1>Классы</h1></a>
        <a href="#"><h1>Преподователи</h1></a>
        <a href="#"><h1>Запросы на регистрацию</h1></a>
    </header>
    <div class="content">
         <table>
            <tr >
                <td>ID</td><td width="200px" >Класс</td><td width="200px"  >Классный руководитель</td><td width="150px">Изменить</td><td width="150px">Удалить</td>
            </tr>
            @foreach($classList as $class)
                <tr>
                <td>{{$class['id']}}</td><td>{{$class['name']}}</td><td>{{$class['teache']}}</td><td><a href="{{url('update',[$class['id']])}}">Изменить</a></td><td><a href="{{url('delete',[$class['id']])}}">Удалить</a></td>
                </tr>
            @endforeach
        </table> 
        <div class="panel-upr">
            <!-- <button>Выделить все</button> -->
            <!-- <button onClick="getElementById('win').style.display='block';" >Удалить</button> -->
            <button onClick="getElementById('win').style.display='block';" >Список учеников</button>
            <button onClick="getElementById('win').style.display='block';" >Список предметов</button>
            <!-- <button onClick="getElementById('win').style.display='block';" >Изменить</button> -->
            <a href="{{url('add')}}"><button>Добавить новый класс</button></a>
        </div>
    </div>
    <!-- Модальное окно для удаления -->

    <!-- Модальные окна -->
    <!-- <div id='win'>
        <div class="modal" onClick="getElementById('win').style.display='none';"></div>
        <div class="modal-okno">
            <img src="img/x.png" onClick="getElementById('win').style.display='none';" alt="">
            <br/>
            <a href="journal.html">журнал</a>
        </div>
    </div>
    <div class="tmp">
        <div class="config-delete">
            <h2>Вы действительно хотитте удалить этот класс</h2>
            <div>
                <button>да</button> 
                <button>Отмена</button>
            </div>
        </div>
        <div class="predmet-list">
            <h2>11-класс</h2>
            <table>
                <tr>
                    <td>№</td> <td width="300px">Предмет</td><td width="300px">Преподователь</td>
                </tr>
                <tr>
                    <td>1</td> <td><input type="text" name="" id=""></td><td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <td>1</td> <td><input type="text" name="" id=""></td><td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <td>1</td> <td><input type="text" name="" id=""></td><td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <td>1</td> <td><input type="text" name="" id=""></td><td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <td>1</td> <td><input type="text" name="" id=""></td><td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <td>1</td> <td><input type="text" name="" id=""></td><td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <td>1</td> <td><input type="text" name="" id=""></td><td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <td>1</td> <td><input type="text" name="" id=""></td><td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <td>1</td> <td><input type="text" name="" id=""></td><td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <td>1</td> <td><input type="text" name="" id=""></td><td><input type="text" name="" id=""></td>
                </tr>
            </table>
            <div>
                <button>Сохранить</button> 
                <button>Отмена</button>
            </div>
        </div>
        <div class="edit">
            <h2>Редактирования</h2>
            <table>
                <tr>
                    <td>ID</td><td width="250px">Name</td><td width="250px">Teache</td><td width="100px">aud</td>
                </tr>
                <tr>
                    <td>ID</td><td><input type="text" name="" id=""></td><td><input type="text" name="" id=""></td><td><input type="text" name="" id=""></td>
                </tr>
            </table>
            <div>
                <button>Сохранить</button> 
                <button>Отмена</button>
            </div>
        </div>
        <div class="pupil-list">
            <h2>Список учеников</h2>
            <table>
                <tr>
                    <td>ID</td><td width="400px">ФИО</td>
                </tr>
                <tr>
                    <td>ID</td><td><input type="text" name="" id=""></td>
                </tr>
            </table>
            <div>
                <button>Сохранить</button> 
                <button>Отмена</button>
            </div>
        </div>
        <div class="new-class">
            <h2>Добавления нового класса</h2>
            <table>
                <tr>
                    <td>Название</td><td width="300px;"><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <td>Классный руководитель</td><td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <td>Аудитория</td><td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <td>Количество учеников</td><td><input type="text" name="" id=""></td>
                </tr>
            </table>
            Список учеников
            <table>
                <tr>
                    <td>№</td><td width="300px">ФИО</td>
                </tr>
                <tr>
                    <td>1</td><td width="300px"><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <td>1</td><td width="300px"><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <td>1</td><td width="300px"><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <td>1</td><td width="300px"><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <td>1</td><td width="300px"><input type="text" name="" id=""></td>
                </tr>
            </table>
        </div>
    </div> -->
@endsection
@section('link_js')
@endsection
