<?php
session_start();

if ($_SESSION['loggedin'] == "no") {
    header('Location: index.php');
    exit;
}
if ($_SESSION['admin'] == "no") {
    header('Location: fooldalbootstrap.php');
    exit;
}

$hiba = 0;
include "Connection.php";

if ($_POST) {
    if (!empty($_POST['nev']) && !empty($_POST['osztaly']) && !empty($_POST['beosztas'])) {
        $nev = $_POST['nev'];
        $osztaly = $_POST['osztaly'];
        $beosztas = $_POST['beosztas'];

        $sql = "INSERT INTO felhasznalok (ID, Nev, Osztaly, Beosztas ) VALUES (NULL, '$nev', '$osztaly', '$beosztas')";
        $connection->query($sql);
        //header('Location: felhasznalok_managelese.php');

        if (isset($_POST['telefon_add'])) {
            $sql = "SELECT * FROM felhasznalok WHERE Nev = '" . $_POST['nev'] . "'";
            $result = $connection->query($sql);
            $row = $result->fetch_assoc();
            $id = $row['ID'];

            $sql = "UPDATE telefon SET User_id='$id' WHERE Telefon_tipus = '" . $_POST['telefon_add'] . "'";
            $connection->query($sql);
            //header('Location: felhasznalok_managelese.php');

            if (isset($_POST['sim_add'])) {
                $sql = "SELECT telefon.imei FROM telefon WHERE User_id = $id";
                $result = $connection->query($sql);
                $row = $result->fetch_assoc();
                $telimei = $row['imei'];
                echo $telimei;
                echo $_POST['sim_add'];
                $sql = "UPDATE sim SET Telefon_IMEI='$telimei' WHERE imei = '" . $_POST['sim_add'] . "'";
                echo $sql;
                $connection->query($sql);
            }

        }
        header('Location: felhasznalok_managelese.php');
    } else {
        $hiba = 1;
    }
}

?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>Dolgozó hozzáadása</title>
</head>

<body class="bg-dark text-light">

<div class="container-fluid">
    <div class="row">
        <div class="col"></div>
        <div class="col-lg-4 col-md-5 col-sm-6 mt-5">
            <form method="post">
                <div class="form-group">
                    <label for="">Név*</label>
                    <input type="text" class="form-control" id="" name="nev">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">Osztály*</label>
                        <input type="text" class="form-control" id="" name="osztaly">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Beosztás*</label>
                        <input type="text" class="form-control" id="" name="beosztas">
                    </div>
                </div>
                <?php
                $sql = "SELECT Telefon_tipus FROM telefon WHERE User_id IS NULL";
                $result = $connection->query($sql);

                echo "<label>Telefon választása dolgozónak (opcinális)</label>";
                echo "<select name='telefon_add' class='form-control'>";
                echo "<option disabled selected value> Telefon választása </option>";
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['Telefon_tipus'] . "'>" . $row['Telefon_tipus'] . "</option>";
                }
                echo "</select><br>";
                ?>
                <div class="form-group">
                    <label>Simek (Telefonszám, Imei) (opcionális)</label>
                    <?php
                    $sql = "SELECT * FROM sim WHERE Telefon_IMEI IS NULL";
                    $result = $connection->query($sql);

                    echo "<select class=\"form-control\" name='sim_add' >";
                    echo "<option disabled selected value>  Telefonszám választása </option>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['IMEI'] . "'>" . $row['Telefonszam'] . " (" . $row['IMEI'] . ")</option>";
                    }
                    echo "</select>";
                    ?>
                </div>
                <button type="submit" class="btn btn-info btn-block" name="submit">Hozzáad</button>
                <a href="felhasznalok_managelese.php" class="btn-danger btn btn-block">Vissza</a>
                <p class=" font-weight-light text-center mt-1">A *-al jelölt mezők kitöltése kötelező.</p>
                <?php

                if ($_POST) {
                    if ($hiba == 1) {
                        echo "<div class=\"alert alert-info mt-3 text-center\" role=\"alert\">Tölts ki minden mezőt!</div>";
                    }
                }
                ?>
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
</body>

</html>
