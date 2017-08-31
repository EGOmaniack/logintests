<?php
// include_once '../helpers/index.php';
function login (string $login, string $pass) {
    if(file_exists('../users.json')) {
        //пытаемся найти такого юзера
        $users = file_get_contents('../users.json');
        $users = json_decode($users);
        $user = "";
        $pass = hash('sha256', $pass);
        
        for ($i=0; $i < count($users); $i++) { 
            if($login === $users[$i]->login) {
                $user = $users[$i];
                break;
            }
        }
        if(isset($user->id)) {
            return true;
        } else {
            return false;
        }
    } 
}

if(file_exists("../users.json") && isset($_POST)) {
    $users = file_get_contents("../users.json");
    $users = json_decode($users, true);

    $login = $_POST['login'];
    $pass = $_POST['pass'];

    $alredyisuser = login($login, $pass, true);
    echo "login - $login <br /> pass - $pass";
    // var_dump(login($login, "", true));
    if(!$alredyisuser) {
        $newuser;
        $newuser['id'] = time() - 1504154812;
        $newuser['login'] = $login;
        $newuser['pass'] = hash('sha256', $pass);
        $newuser['regdate'] = time();

        $users[] = $newuser;

        file_put_contents("../users.json", json_encode($users, JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT));
        echo "<br />done";
    }
}