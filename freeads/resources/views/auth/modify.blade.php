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
    <form method="GET" action="{{ 'http://localhost:3000/modifyUser' }}" accept-charset="UTF-8"
          enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="email" class="control-label required">Email</label>
                    <input class="form-control" required="required" name="email" value="{{ $user["email"] }}" type="email" id="email">
                </div>
                <div class="form-group">
                    <label for="pass" class="control-label required">Password</label>
                    <input class="form-control" name="pass" type="password" id="pass">
                </div>
                <div class="form-group">
                    <label for="passConf" class="control-label required">Password Confirmation</label>
                    <input class="form-control" name="passConf" type="password" id="passConf">
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
