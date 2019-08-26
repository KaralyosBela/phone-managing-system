<?php
session_start();

if($_SESSION['loggedin'] == "no"){
    header('Location: index.php');
    exit;
}
include "Connection.php";

if ($_POST) {

    $sql = "SELECT * FROM felhasznalok
LEFT JOIN telefon ON felhasznalok.ID = telefon.User_id
LEFT JOIN sim ON telefon.imei = sim.Telefon_IMEI";

    if (!empty($_POST['nev'])) {
        $nevszerint = $_POST['nev'];
        $sql .= " WHERE nev LIKE '%" . $nevszerint . "%'";
    }
    if (!empty($_POST['telefon'])) {
        $telefonszerint = $_POST['telefon'];
        $sql .= " WHERE Telefon_tipus LIKE '%" . $telefonszerint . "%'";
    }
    if (!empty($_POST['telefonszam'])) {
        $telefonszamszerint = $_POST['telefonszam'];
        $sql .= " WHERE Telefonszam LIKE '%" . $telefonszamszerint . "%'";
    }
    if (!empty($_POST['tel_imei'])) {
        $telimeiszerint = $_POST['tel_imei'];
        $sql .= " WHERE telefon.imei LIKE '%" . $telimeiszerint . "%'";
    }
    if (!empty($_POST['sim_imei'])) {
        $simimeiszerint = $_POST['sim_imei'];
        $sql .= " WHERE Telefon_IMEI LIKE '%" . $simimeiszerint . "%'";
    }

} else {
    $sql = "SELECT * FROM felhasznalok
LEFT JOIN telefon ON felhasznalok.ID = telefon.User_id
LEFT JOIN sim ON telefon.imei = sim.Telefon_IMEI";
}

echo "<h2>Felhasználók illetve hozzájuk tartozó telefonaik simekkel.</h2>";

$result = $connection->query($sql);


if ($result->num_rows == 0) {
    echo "Nincs találat az alábbi keresési feltételeknek!";
} else {

    echo "<table border='1'";
    echo "<tr>
<th>Név</th>
<th>Osztály</th>
<th>Beosztás</th>
<th>Telefon IMEI</th>
<th>Telefon típusa</th>
<th>Sim IMEI</th>
<th>Telefonszám</th>
<th>Pin kód 1</th>
<th>Pin kód 2</th>
<th>Puk kód 1</th>
<th>Puk kód 2</th>
<th>Hang</th>
<th>Internet</th>
<th>Hűseg</th>
<th>Hűseg kezdete</th>
</tr>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Nev"] . "</td>" .
                "<td>" . $row["Osztaly"] . "</td>" .
                "<td>" . $row["Beosztas"] . "</td>" .
                "<td>" . $row["imei"] . "</td>" .
                "<td>" . $row["Telefon_tipus"] . "</td>" .
                "<td>" . $row["IMEI"] . "</td>" .
                "<td>" . $row["Telefonszam"] . "</td>" .
                "<td>" . $row["Pin1"] . "</td>" .
                "<td>" . $row["Pin2"] . "</td>" .
                "<td>" . $row["Puk1"] . "</td>" .
                "<td>" . $row["Puk2"] . "</td>" .
                "<td>" . $row["Hang"] . "</td>" .
                "<td>" . $row["Internet"] . "</td>" .
                "<td>" . $row["Huseg"] . "</td>" .
                "<td>" . $row["Huseg kezdete"] . "</td>";
            echo "</tr>";
        }
    }
    echo "</table><br>";

}


?>

<html>

<head>
    <title>Kereses</title>
</head>

<body>
<form method="post">
    <label for="nev">Név:</label>
    <input type="text" name="nev">

    <label for="telefon">Telefon:</label>
    <input type="text" name="telefon">

    <label for="telefonszam">Telefonszam:</label>
    <input type="text" name="telefonszam">

    <label for="tel_imei">Telefon IMEI:</label>
    <input type="text" name="tel_imei">

    <label for="sim_imei">Sim IMEI:</label>
    <input type="text" name="sim_imei">

    <input type="submit" name="submit" value="Kereses">
</form>

</body>
<a href="fooldal.php">Vissza</a>

</html>



