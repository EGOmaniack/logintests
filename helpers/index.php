<?php
function login (string $login, string $pass) {
    if(file_exists('./users.json')) {
        //пытаемся найти такого юзера
        $users = file_get_contents('./users.json');
        $users = json_decode($users);
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