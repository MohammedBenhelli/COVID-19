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
    <form method="GET" action="{{ 'http://localhost:3000/requestAds' }}" accept-charset="UTF-8"
          enctype="multipart/form-data">
        <input class="invisible" required="required" name="id" value="{{ $ads[0]['id'] }}" type="text" id="id">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="title" class="control-label required">Title</label>
                    <input class="form-control" required="required" minlength="4" name="title" value="{{ $ads[0]["title"] }}" type="text" id="title">
                </div>
                <div class="form-group">
                    <label for="price" class="control-label required">Price</label>
                    <input class="form-control" required="required" name="price" value="{{ $ads[0]["price"] }}" type="number" id="price">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="description" class="control-label required">Description</label>
                    <textarea class="form-control" required="required" minlength="15" name="description" cols="50"
                              rows="10" id="description">{{ $ads[0]["description"] }}</textarea>
                </div>
            </div>
            <div class="col-lg-2">
                <button class="form-control" type="submit">Submit</button>

            </div>
        </div>
    </form>
</div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
</html>
