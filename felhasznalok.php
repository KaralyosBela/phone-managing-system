<?php
session_start();

if($_SESSION['loggedin'] == "no"){
    header('Location: index.php');
    exit;
}
include "Connection.php";
global $a;
global $b;
global $c;
global $d;

if(isset($_POST['hozzaad']))
{
    if(!empty($_POST['nev_add']) && !empty($_POST['osztaly_add']) && !empty($_POST['beosztas_add'])) {
        $nev = $_POST['nev_add'];
        $osztaly = $_POST['osztaly_add'];
        $beosztas = $_POST['beosztas_add'];

        $sql = "INSERT INTO felhasznalok (ID, Nev, Osztaly, Beosztas ) VALUES (NULL, '$nev', '$osztaly', '$beosztas')";

        if ($connection->query($sql) === TRUE) {
            echo "New record created infofully";
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
    }
}

if(isset($_POST['torol']))
{
    $sql = "DELETE FROM felhasznalok WHERE Nev = '".$_POST['nevlista_torol']."'";
    $connection->query($sql);
}

if(isset($_POST['kivalaszt']))
{
    $sql = "select * from felhasznalok where Nev = '".$_POST['nevlista_szerkeszt']."'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    $a = $row['Nev'];
    $b = $row['Osztaly'];
    $c = $row['Beosztas'];
    $d = $row['ID'];
}

if(isset($_POST['szerkeszt']))
{
    if(!empty($_POST['nev_szerk']) && !empty($_POST['osztaly_szerk']) && !empty($_POST['beosztas_szerk'])) {

        echo "jo ";
        $nev_szerk = $_POST['nev_szerk'];
        $osztaly_szerk = $_POST['osztaly_szerk'];
        $beosztas_szerk = $_POST['beosztas_szerk'];
        $id_szerk = $_POST['id_szerk'];

        echo $nev_szerk." ";
        echo $osztaly_szerk." ";
        echo $beosztas_szerk." ";
        echo $id_szerk;

        $sql = "UPDATE felhasznalok SET Nev='$nev_szerk', Osztaly='$osztaly_szerk', Beosztas='$beosztas_szerk' WHERE ID=$id_szerk";
        $connection->query($sql);
    }
}

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
echo "</table><br>";
?>

<html>

<head>
    <title>Add user</title>
</head>

<body>
<form method="post">
    <h3>Felhasználó hozzáadása:</h3>
    <label for="nev">Név:</label>
    <input type="text" name="nev_add" class="nev">
    <label for="osztaly">Osztály:</label>
    <input type="text" name="osztaly_add" class="osztaly">
    <label for="beosztas">Beosztás:</label>
    <input type="text" name="beosztas_add" class="beosztas">
    <input type="submit" name="hozzaad" value="Hozzáad">

    <h3>Felhasználó szerkesztése:</h3>
    <?php
    $sql = "SELECT Nev FROM felhasznalok";
    $result = $connection->query($sql);

    echo "<select name='nevlista_szerkeszt'>";
    echo "<option disabled selected value> -- Válaszd ki a szerkesztendő személyt -- </option>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['Nev'] . "'>" . $row['Nev'] . "</option>";
    }
    echo "</select>";
    ?>
    <input type="submit" name="kivalaszt" value="Kiválaszt">
    <label for="nev">Név:</label>
    <input type="text" name="nev_szerk" class="nev" value="<?php if(isset($a)) echo $a; ?>">
    <label for="osztaly">Osztály:</label>
    <input type="text" name="osztaly_szerk" class="osztaly" value="<?php if(isset($b)) echo $b?>">
    <label for="beosztas">Beosztás:</label>
    <input type="text" name="beosztas_szerk" class="beosztas" value="<?php if(isset($c)) echo $c ?>">
    <input type="hidden" name="id_szerk" value="<?php if(isset($d)) echo $d ?>">
    <input type="submit" name="szerkeszt" value="Szerkeszt">

    <h3>Felhasználó törlése:</h3>
    <?php
    $sql = "SELECT Nev FROM felhasznalok";
    $result = $connection->query($sql);

    echo "<select name='nevlista_torol'>";
    echo "<option disabled selected value> -- Válaszd ki a törlendő személyt -- </option>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['Nev'] . "'>" . $row['Nev'] . "</option>";
    }
    echo "</select>";
    ?>
    <input type="submit" name="torol" value="Töröl">
</form>
</body>

</html>
