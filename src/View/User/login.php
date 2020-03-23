<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
<form action="/MVC_PiePHP/index.php" method="post">
    <div class="container">
        <label for="email"><b>Email</b>
            <input type="text" placeholder="Enter Email" name="email" required>
        </label>
        <label for="password"><b>Password</b>
            <input type="password" placeholder="Enter Password" name="password" required>
        </label>
        <button type="submit">Login</button>
    </div>
</form>
</body>
</html>
