<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('save')}}" method="post">
    <input name="_method" type="hidden" value="PATCH">
    <h2>Name</h2>
    <input type="text" name="name" id=""><br/>
    <h2>Last name</h2>
    <input type="text" name="lName" id=""><br/><br/>
    <input type="submit" value="Добавить">
    </form>
</body>
</html>