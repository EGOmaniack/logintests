<?php
session_start(); //Запускаем сессию всегда
include './helpers/index.php';

if(isset($_POST) && isset($_POST['loginform'])) {
    $login = $_POST['login'];
    $pass = $_POST['hashpass'];
    $user = login($login, $pass);
    if(isset($user->id)) {
        unset($user->pass);
        $_SESSION['user'] = $user;
        $_SESSION['logged'] = true;
        $_SESSION['lastTimeStamp'] = time ();
        header("location: hello/", true, "301");
    } else {
        echo "incorrect login or pass";
    }
}
if(isset($_POST) && isset($_POST['logout'])) {
    logout();
}
if(isset($_SESSION['logged'])) {
    if(!toOld()) {
        echo "hello " . $_SESSION["user"]->login;
    } else {
        echo "to old";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="./libs/hash.js"></script>
</head>
<body>
<?php if(!isset($_SESSION["logged"])): ?>
    <form method="post" id="loginform">
        <input type="text" name="login" id="login">
        <input type="password" id="pwd">
        <input type="submit" name="loginform" value="login">
        <input type="hidden" name="hashpass" id="hashpass">
    </form>
    <form action="./enctest/index.php" method="post">
        <input type="submit" value="Зарегистрироваться">
    </form>
<?php else: ?>
    <form method="post">
        <input type="submit" name="logout" value="logout">
    </form>
<?php endif ?>


    <script>
        var pwd = document.getElementById('pwd');
        var loginform = document.getElementById('loginform');
        var hashpass = document.getElementById('hashpass');

        function mySubmit(value) {
            var hashObj = new jsSHA("SHA-512", "TEXT", {numRounds: 5});
            hashObj.update(value);
            var hash = hashObj.getHash("HEX");
            return hash;
        }
        loginform.addEventListener('submit', function (e){
            // e.preventDefault();
            hashpass.value = mySubmit(pwd.value);
            // loginform.submit();
        });
    </script>
</body>
</html>