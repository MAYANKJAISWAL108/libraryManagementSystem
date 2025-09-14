<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'library';

$conn = mysqli_connect($hostname, $username, $password, $database);

if(!$conn)
    die("Database Not Connected! ". mysqli_connect_error());

?>