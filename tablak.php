<?php
include "Connection.php";

//$sql = "SELECT * FROM felhasznalok";

//SELECT * FROM felhasznalok LEFT JOIN telefon ON felhasznalok.ID = telefon.User_id

//LEFT JOIN 3 TABLAVAL
/*SELECT * FROM felhasznalok
LEFT JOIN telefon ON felhasznalok.ID = telefon.User_id
LEFT JOIN sim ON telefon.imei = sim.Telefon_IMEI
*/

//RIGHT JOIN 3 TABLAVAL
/*
SELECT * FROM Sim
RIGHT JOIN telefon ON sim.Telefon_IMEI = telefon.imei
RIGHT JOIN felhasznalok ON telefon.User_id = felhasznalok.ID
 */

//FULL OUTER USER éS TELEFON
/*
SELECT * FROM felhasznalok
LEFT JOIN telefon ON felhasznalok.ID = telefon.User_id
UNION
SELECT * FROM felhasznalok
RIGHT JOIN telefon ON felhasznalok.ID = telefon.User_id
 */

//FULL OUTER TELEFON ÉS SIM
/*
SELECT * FROM telefon
LEFT JOIN sim ON telefon.imei = sim.Telefon_IMEI
UNION
SELECT * FROM telefon
RIGHT JOIN sim ON telefon.imei = sim.Telefon_IMEI
 */

//nemteljesenjo
/*
 SELECT * FROM felhasznalok
LEFT JOIN telefon ON felhasznalok.ID = telefon.User_id
LEFT JOIN sim ON telefon.imei = sim.Telefon_IMEI
UNION
SELECT * FROM felhasznalok
RIGHT JOIN telefon ON felhasznalok.ID = telefon.User_id
RIGHT JOIN sim ON telefon.imei = sim.Telefon_IMEI
 */

echo "<h2>Felhasználók illetve hozzájuk tartozó telefonaik simekkel.</h2>";
$sql = "SELECT * FROM felhasznalok
LEFT JOIN telefon ON felhasznalok.ID = telefon.User_id
LEFT JOIN sim ON telefon.imei = sim.Telefon_IMEI ORDER BY ID";
$result = $connection->query($sql);

echo "<table border='1'";
echo "<tr>
<th>ID</th>
<th>Név</th>
<th>Osztály</th>
<th>Beosztás</th>
<th>Imei</th>
<th>UserID</th>
<th>Telefon típusa</th>
<th>Vásárlás dátuma</th>
<th>Garancia</th>
<th>Kiadás</th>
<th>Visszavétel</th>
<th>IMEI</th>
<th>Telefon IMEI</th>
<th>Telefonszam</th>
<th>Pin1</th>
<th>Pin2</th>
<th>Puk1</th>
<th>Puk2</th>
<th>Hang</th>
<th>Internet</th>
<th>Huseg</th>
<th>Huseg kezdete</th>
</tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["ID"]. "</td>" .
            "<td>".$row["Nev"]. "</td>" .
            "<td>".$row["Osztaly"]. "</td>" .
            "<td>".$row["Beosztas"]. "</td>".
            "<td>".$row["imei"]. "</td>" .
            "<td>".$row["User_id"]. "</td>" .
            "<td>".$row["Telefon_tipus"]. "</td>" .
            "<td>".$row["Vasarlas_datuma"]. "</td>".
            "<td>".$row["Garancia"]. "</td>".
            "<td>".$row["Kiadas"]. "</td>".
            "<td>".$row["Visszavetel"]. "</td>".
            "<td>".$row["IMEI"]. "</td>" .
            "<td>".$row["Telefon_IMEI"]. "</td>" .
            "<td>".$row["Telefonszam"]. "</td>" .
            "<td>".$row["Pin1"]. "</td>".
            "<td>".$row["Pin2"]. "</td>" .
            "<td>".$row["Puk1"]. "</td>" .
            "<td>".$row["Puk2"]. "</td>".
            "<td>".$row["Hang"]. "</td>" .
            "<td>".$row["Internet"]. "</td>" .
            "<td>".$row["Huseg"]. "</td>".
            "<td>".$row["Huseg kezdete"]. "</td>";
        echo "</tr>";
    }
}
echo "</table>";
echo "<br>";

$sql = "SELECT * FROM telefon
LEFT JOIN sim ON telefon.imei = sim.Telefon_IMEI
UNION
SELECT * FROM telefon
RIGHT JOIN sim ON telefon.imei = sim.Telefon_IMEI";
$result = $connection->query($sql);

echo "<h2>Telefonok és SIMek kapcsolata.</h2>";
echo "<table border='1'";
echo "<tr>
<th>Imei</th>
<th>UserID</th>
<th>Telefon típusa</th>
<th>Vásárlás dátuma</th>
<th>Garancia</th>
<th>Kiadás</th>
<th>Visszavétel</th>
<th>IMEI</th>
<th>Telefon IMEI</th>
<th>Telefonszam</th>
<th>Pin1</th>
<th>Pin2</th>
<th>Puk1</th>
<th>Puk2</th>
<th>Hang</th>
<th>Internet</th>
<th>Huseg</th>
<th>Huseg kezdete</th>
</tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["imei"]. "</td>" .
            "<td>".$row["User_id"]. "</td>" .
            "<td>".$row["Telefon_tipus"]. "</td>" .
            "<td>".$row["Vasarlas_datuma"]. "</td>".
            "<td>".$row["Garancia"]. "</td>".
            "<td>".$row["Kiadas"]. "</td>".
            "<td>".$row["Visszavetel"]. "</td>".
            "<td>".$row["IMEI"]. "</td>" .
            "<td>".$row["Telefon_IMEI"]. "</td>" .
            "<td>".$row["Telefonszam"]. "</td>" .
            "<td>".$row["Pin1"]. "</td>".
            "<td>".$row["Pin2"]. "</td>" .
            "<td>".$row["Puk1"]. "</td>" .
            "<td>".$row["Puk2"]. "</td>".
            "<td>".$row["Hang"]. "</td>" .
            "<td>".$row["Internet"]. "</td>" .
            "<td>".$row["Huseg"]. "</td>".
            "<td>".$row["Huseg kezdete"]. "</td>";
        echo "</tr>";
    }
}
echo "</table>";
echo "<br>";




$sql = "SELECT * FROM felhasznalok
LEFT JOIN telefon ON felhasznalok.ID = telefon.User_id
UNION
SELECT * FROM felhasznalok
RIGHT JOIN telefon ON felhasznalok.ID = telefon.User_id";
$result = $connection->query($sql);

echo "<h2>Felhasználók és telefonok kapcsolata.</h2>";
echo "<table border='1'";
echo "<tr>
<th>ID</th>
<th>Név</th>
<th>Osztály</th>
<th>Beosztás</th>
<th>Imei</th>
<th>UserID</th>
<th>Telefon típusa</th>
<th>Vásárlás dátuma</th>
<th>Garancia</th>
</tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["ID"]. "</td>" .
            "<td>".$row["Nev"]. "</td>" .
            "<td>".$row["Osztaly"]. "</td>" .
            "<td>".$row["Beosztas"]. "</td>".
            "<td>".$row["imei"]. "</td>" .
            "<td>".$row["User_id"]. "</td>" .
            "<td>".$row["Telefon_tipus"]. "</td>" .
            "<td>".$row["Vasarlas_datuma"]. "</td>".
            "<td>".$row["Garancia"]. "</td>";
        echo "</tr>";
    }
}
echo "</table>";
echo "<br>";



$sql = "SELECT * from Sim";
$result = $connection->query($sql);

echo "<h2>Simek.</h2>";
echo "<table border='1'";
echo "<tr>
<th>IMEI</th>
<th>Telefon IMEI</th>
<th>Telefonszam</th>
<th>Pin1</th>
<th>Pin2</th>
<th>Puk1</th>
<th>Puk2</th>
<th>Hang</th>
<th>Internet</th>
<th>Huseg</th>
<th>Huseg kezdete</th>
</tr>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["IMEI"]. "</td>" .
            "<td>".$row["Telefon_IMEI"]. "</td>" .
            "<td>".$row["Telefonszam"]. "</td>" .
            "<td>".$row["Pin1"]. "</td>".
            "<td>".$row["Pin2"]. "</td>" .
            "<td>".$row["Puk1"]. "</td>" .
            "<td>".$row["Puk2"]. "</td>".
            "<td>".$row["Hang"]. "</td>" .
            "<td>".$row["Internet"]. "</td>" .
            "<td>".$row["Huseg"]. "</td>".
            "<td>".$row["Huseg kezdete"]. "</td>";
        echo "</tr>";

    }
}
echo "</table>";


echo "<br>";
$sql = "SELECT * from Felhasznalok";
$result = $connection->query($sql);

echo "<h2>Felhasználók.</h2>";
echo "<table border='1'";
echo "<tr><th>ID</th><th>Név</th><th>Osztály</th><th>Beosztás</th></tr>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["ID"]. "</td>" .
            "<td>".$row["Nev"]. "</td>" .
            "<td>".$row["Osztaly"]. "</td>" .
            "<td>".$row["Beosztas"]. "</td>";
        echo "</tr>";
    }
}
echo "</table>";

echo "<br>";

$sql = "SELECT * from Telefon";
$result = $connection->query($sql);

echo "<h2>Telefonok.</h2>";
echo "<table border='1'";
echo "<tr><th>IMEI</th><th>USER ID</th><th>Telefon típusa</th><th>Vásárlás dátuma</th><th>Garancia</th><th>Kiadás</th><th>Visszavétel</th></tr>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["imei"]. "</td>" .
            "<td>".$row["User_id"]. "</td>" .
            "<td>".$row["Telefon_tipus"]. "</td>" .
            "<td>".$row["Vasarlas_datuma"]. "</td>".
            "<td>".$row["Garancia"]. "</td>".
            "<td>".$row["Kiadas"]. "</td>".
            "<td>".$row["Visszavetel"]. "</td>";
        echo "</tr>";

    }
}
echo "</table>";

$connection->close();

?>


