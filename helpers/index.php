<?php
function getUsers () {
    $filepath = "http://{$_SERVER['SERVER_NAME']}:8090/login/users.json";
    $users;
    $users = file_get_contents($filepath);
    $users = json_decode($users);
    return $users;
    
    header("HTTP/1.0 406 Not Acceptable");
    die("something rong <br />$filepath");
}


function login (string $login, string $pass) {
    $users = getUsers();
    $user = "";
    $pass = hash('sha256', $pass);
    for ($i=0; $i < count($users); $i++) { 
        if($login === $users[$i]->login && 
        $pass === $users[$i]->pass) {
            $user = $users[$i];
            break;
        }
    }
    return $user;
}
function checkUser (string $login) {
    $users = getUsers();
    $user = "";

    for ($i=0; $i < count($users); $i++) { 
        if($login === $users[$i]->login) {
            $user = $users[$i];
            break;
        }
    }
    return isset($user->id);
}
function logout () {
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
function toOld() {
    if(isset($_SESSION['lastTimeStamp']) && time() - (int)$_SESSION['lastTimeStamp'] < 300) {
        $_SESSION['lastTime'] = time() - $_SESSION['lastTimeStamp'];
        $_SESSION['lastTimeStamp'] = time (); //если небыло дольше 300 сек то кто ты вообще????
        return false;
    } else {
        logout();
        return true;
    }
}
?>