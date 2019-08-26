<?php

$server = "localhost";
$username = "root";
$password = "";
$databasename = "nyilvantartasok";

$connection = new mysqli($server,$username,$password,$databasename);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

mysqli_set_charset($connection,"utf8");

?>