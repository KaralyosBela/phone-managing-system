<?php
session_start();

if ($_SESSION['loggedin'] == "no") {
    header('Location: index.php');
    exit;
}
include "connection.php";

$imei = $_GET['imei'];

$sql = "UPDATE telefon SET Kiadas = NULL, Visszavetel = NULL WHERE imei=$imei";
$connection->query($sql);

header('Location: telefonok_managelese.php');

?>