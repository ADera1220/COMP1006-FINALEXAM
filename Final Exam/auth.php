<?php

//use session_start to look for an existing session
session_start();

if(empty($_SESSION['user_id'])) {
    header('location:login.php');
    exit();
}

?>