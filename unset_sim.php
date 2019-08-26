<?php
session_start();

if ($_SESSION['loggedin'] == "no") {
    header('Location: index.php');
    exit;
}
include "connection.php";

$imei = $_GET['imei'];

$sql = "UPDATE sim SET Telefon_IMEI = NULL WHERE IMEI=$imei";
$connection->query($sql);

header('Location: simek_managelese.php');

?>