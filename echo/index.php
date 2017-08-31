<?php
session_start();
include '../helpers/index.php';

if(!toOld()) {
    echo $_POST['message'];
} else {
    header("HTTP/1.0 406 Not Acceptable");
    die('sorry you need to login');
}