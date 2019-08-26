<?php
session_start();

if ($_SESSION['loggedin'] == "no") {
    header('Location: index.php');
    exit;
}
include "connection.php";

$imeichg = $_GET['imei'];

$sql = "SELECT * FROM felhasznalok
LEFT JOIN telefon ON felhasznalok.ID = telefon.User_id
LEFT JOIN sim ON telefon.imei = sim.Telefon_IMEI WHERE telefon.imei = $imeichg";

$result = $connection->query($sql);
$row = $result->fetch_assoc();

$id = $row['ID'];
$nev = $row['Nev'];
$beosztas = $row['Beosztas'];
$tel_imei = $row['imei'];
$telefontipus = $row['Telefon_tipus'];
$vasarlasdatuma = $row['Vasarlas_datuma'];
$garancia = $row['Garancia'];
$kiadas = $row['Kiadas'];
$visszavetel = $row['Visszavetel'];
$sajat = $row['Sajat'];
$imei = $row['IMEI'];
$telefonszam = $row['Telefonszam'];
$pin1 = $row['Pin1'];
$pin2 = $row['Pin2'];
$puk1 = $row['Puk1'];
$puk2 = $row['Puk2'];
$hang = $row['Hang'];
$internet = $row['Internet'];
$huseg = $row['Huseg'];
$husegkezdete = $row['Huseg_kezdete'];

echo $id . " " .
    $nev . " " .
    $beosztas . " " .
    $tel_imei . " " .
    $telefontipus . " " .
    $vasarlasdatuma . " " .
    $garancia . " " .
    $kiadas . " " .
    $visszavetel . " " .
    $sajat . " " .
    $imei . " " .
    $telefonszam . " " .
    $pin1 . " " .
    $pin2 . " " .
    $puk1 . " " .
    $puk2 . " " .
    $hang . " " .
    $internet . " " .
    $huseg . " " .
    $husegkezdete;

$sql = "INSERT INTO archiv (ID, Nev, Beosztas, tel_imei, Telefon_tipus, Vasarlas_datuma, Garancia, Kiadas, Visszavetel, Sajat, IMEI, Telefonszam, Pin1, Pin2, Puk1, Puk2, Hang, Internet, Huseg, Huseg_kezdete ) 
                    VALUES ('$id',
                     '$nev', 
                     '$beosztas', 
                     '$tel_imei', 
                     '$telefontipus', 
                     '$vasarlasdatuma', 
                     '$garancia', 
                     '$kiadas', 
                     NOW(), 
                     '$sajat', 
                     '$imei', 
                     '$telefonszam', 
                     '$pin1', 
                     '$pin2', 
                     '$puk1', 
                     '$puk2', 
                     '$hang', '$internet', '$huseg', 
                     '$husegkezdete')";

$connection->query($sql);

$sql = "UPDATE telefon SET User_id = NULL, Visszavetel = NULL, Kiadas = NULL WHERE imei=$imeichg";
$connection->query($sql);

header('Location: telefonok_managelese.php');

?>