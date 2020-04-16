<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset("css/tailwind.min.css") }}">
    <title>Freeads</title>
</head>
<body>
<div id="ads" data="{{ $ads }}"></div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
</html>
