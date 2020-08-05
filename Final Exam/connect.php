<?php
    $dsn = 'mysql:host=172.31.22.43;dbname=Adam200422676';
    $username = 'Adam200422676';
    $pw = 'OJ2a-KKe6M'; 
    $db = new PDO($dsn, $username, $pw);
    //set error mode to exception 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>