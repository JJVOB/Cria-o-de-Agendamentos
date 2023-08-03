<?php
function getConnection(){
    $user = 'root';
    $pass = '';
    $db = new PDO('mysql:host=localhost;dbname=levex', $user, $pass);
    
    return $db;
}