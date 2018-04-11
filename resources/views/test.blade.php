<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>test</title>
</head>
<body>
    <h1>Список</h1>
    <table border="1" width="600">
        <tr>
        <td>Name</td><td>last name</td><td>Изменить</td><td>Удалить</td>
        </tr>
        @foreach ($lists as $list)
        <tr>
        <td>{{ $list->name }}</td><td>{{ $list->name }}</td><td><a href="{{route('edit')}}/{{ $list->name }}">Изменить</a></td><td><a href="{{route('delete')}}/{{ $list->name }}">Удалить</a></td>
        <tr>
        @endforeach
    </table>
    <a href="{{route('add')}}"> <button >Добавить</button></a><br/>   
</body>
</html>