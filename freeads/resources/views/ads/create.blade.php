<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("css/tailwind.min.css") }}">
    <title>Freeads</title>
</head>
<body>
<header id="header"></header>
<div class="container">
    {!! form_start($form) !!}
    <div class="row">
        <div class="col-lg-6">
            {!! form_row($form->title) !!}
            {!! form_row($form->price) !!}
            {!! form_row($form->photo) !!}
        </div>
        <div class="col-lg-6">
            {!! form_row($form->description) !!}
        </div>
        <div class="col-lg-2">
            {!! form_row($form->submit) !!}
        </div>
    </div>
    {!! form_end($form) !!}
</div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
</html>
