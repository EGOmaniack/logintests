<?php
include '../helpers/index.php';

if(file_exists("../users.json") && isset($_POST)) {
    $users = file_get_contents("../users.json");
    $users = json_decode($users, true);

    $login = $_POST['login'];
    $pass = $_POST['pass'];

    $alredyisuser = checkUser($login);
    echo "login - $login <br /> pass - $pass";
    // var_dump(login($login, "", true));
    if(!$alredyisuser) {
        $newuser;
        $newuser['id'] = time() - 1504154812;
        $newuser['login'] = $login;
        $newuser['pass'] = hash('sha256', $pass);
        $newuser['regdate'] = time();
        $newuser['permissionlvl'] = 'regular';

        $users[] = $newuser;

        file_put_contents("../users.json", json_encode($users, JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT));
        echo "<br />done";
    }
}