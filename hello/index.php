<?php
session_start();
include '../helpers/index.php';

if (!toOld()) {
    echo "hello " . $_SESSION["user"]->login . " on welcome page" . "<br />";
    echo "Last time siimed - " . $_SESSION['lastTime'] . "sek" . "<br />";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="../index.php"  method="post">
        <input type="submit" value="back">
    </form>
    <p id="message">message</p>
    <form action="../echo/index.php" method="post" id="messageForm">
        <input type="text" name="message" id="inputMessage">
        <input type="submit" value="Отправить">
    </form>
    <script src="main.js"></script>
</body>
</html>