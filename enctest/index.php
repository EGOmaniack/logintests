<?php
session_start();
// var_dump($_SESSION);

$permission = $_SESSION['user']->permissionlvl;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../libs/hash.js"></script>
    <title>Document</title>
</head>
<body>
    <p id="answer"></p>
    <form action="encpass.php" id="regform">
        <input type="text" name="login" id="login">
        <input type="password" id="pwd" name="password" />
        <input type="submit" <?php echo $permission !== "admin" ? "disabled" : "" ?> >
    </form>
    <script>
        var pwdObj = document.getElementById('pwd');
        var login = document.getElementById('login');
        var regform = document.getElementById('regform');

        function mySubmit(value) {
            var hashObj = new jsSHA("SHA-512", "TEXT", {numRounds: 5});
            hashObj.update(value);
            var hash = hashObj.getHash("HEX");
            return hash;
        }
        regform.addEventListener('submit', function (e){
            e.preventDefault();
            let body = `login=${encodeURIComponent(login.value)}&pass=${mySubmit(pwdObj.value)}`;

            let request = new XMLHttpRequest();
            request.open('POST', regform.action, true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            
            request.onload = function() {
            if (request.status >= 200 && request.status < 400) {
                // Success!
                // console.log(request.responseText);
                document.getElementById('answer').innerHTML = request.responseText;
            } else {
                // We reached our target server, but it returned an error
            }
            };
            
            request.onerror = function() {
            };
            
            request.send(body);
        });
    </script>
</body>
</html>