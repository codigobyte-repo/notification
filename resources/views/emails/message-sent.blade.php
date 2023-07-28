<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Redis</title>
</head>
<body>
    <h1>Hola, {{ $sender->name }} te envió un mensaje</h1>

    <p>
        {{ $body }}
    </p>

    <p>
        <a href="{{ url('/dashboard') }}">Ver mensaje</a>
    </p>

    <p>
        Gracias, <br>
        {{ config('app.name') }}
    </p>

</body>
</html>