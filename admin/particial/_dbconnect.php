<?php
$server = "http://farco.atwebpages.com/";
$username = "3774788_farco";
$password = "farco1234";
$database = "3774788_farco";
$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn)
    die("connection failed");
// else
//     echo "successfully connected";
