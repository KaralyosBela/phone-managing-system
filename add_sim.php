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
include "Connection.php";
global $imei;

if ($_POST) {
    if (!empty($_POST['imei']) && !empty($_POST['telefonszam']) && !empty($_POST['pin1']) &&
        !empty($_POST['pin2']) && !empty($_POST['puk1']) && !empty($_POST['puk2'])) {

        $imei = $_POST['imei'];
        $telefonszam = $_POST['telefonszam'];
        $pin1 = $_POST['pin1'];
        $pin2 = $_POST['pin2'];
        $puk1 = $_POST['puk1'];
        $puk2 = $_POST['puk2'];
        if (empty($_POST['hang'])) $hang = 0; else $hang = 1;
        if (empty($_POST['internet'])) $internet = 0; else $internet = 1;
        if (empty($_POST['huseg'])) $huseg = 0; else $huseg = 1;
        $husegdatum = $_POST['husegdatum'];

        if ($huseg == 1) {
            $sql = "INSERT INTO sim (IMEI, Telefon_IMEI, Telefonszam, Pin1, Pin2, Puk1, Puk2, Hang, Internet, Huseg, Huseg_kezdete ) 
                    VALUES ('$imei', NULL, '$telefonszam', '$pin1', '$pin2', '$puk1', '$puk2', '$hang', '$internet', '$huseg', '$husegdatum')";
            $connection->query($sql);
            header('Location: simek_managelese.php');
        } else {
            $sql = "INSERT INTO sim (IMEI, Telefon_IMEI, Telefonszam, Pin1, Pin2, Puk1, Puk2, Hang, Internet, Huseg, Huseg_kezdete ) 
                    VALUES ('$imei', NULL, '$telefonszam', '$pin1', '$pin2', '$puk1', '$puk2', '$hang', '$internet', NULL , NULL )";
            $connection->query($sql);
        }

        if (isset($_POST['telefon_add'])) {
            $sql = "SELECT * FROM telefon WHERE Telefon_tipus = '" . $_POST['telefon_add'] . "'";
            $result = $connection->query($sql);
            $row = $result->fetch_assoc();
            $id = $row['imei'];

            $sql = "UPDATE sim SET sim.Telefon_IMEI='$id' WHERE sim.IMEI = '$imei'";
            $connection->query($sql);
            header('Location: simek_managelese.php');
        }
        header('Location: simek_managelese.php');
    }

}

?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>SIM hozzáadása</title>
</head>

<body class="bg-dark text-light">

<div class="container-fluid">
    <div class="row mt-4">
        <div class="col"></div>
        <div class="col-lg-4 col-md-5 col-sm-6">
            <form method="post">
                <div class="form-group">
                    <label for="">IMEI szám*</label>
                    <input type="text" class="form-control" id="" name="imei">
                </div>
                <div class="form-group">
                    <label for="">Telefonszám*</label>
                    <input type="text" class="form-control" id="" name="telefonszam">
                </div>
                <div class="form-row text-center">
                    <div class="form-group col-md-3">
                        <label for="">PIN-kód 1*</label>
                        <input type="text" class="form-control" id="" name="pin1">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">PIN-kód 2*</label>
                        <input type="text" class="form-control" id="" name="pin2">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">PUK-kód 1*</label>
                        <input type="text" class="form-control" id="" name="puk1">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">PUK-kód 2*</label>
                        <input type="text" class="form-control" id="" name="puk2">
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="form-check form-check-inline col">
                        <input class="form-check-input" type="checkbox" checked value="hang" name="hang">
                        <label class="form-check-label" for="inlineCheckbox1">Hang*</label>
                    </div>
                    <div class="form-check form-check-inline col">
                        <input class="form-check-input" type="checkbox" name="internet" value="internet">
                        <label class="form-check-label" for="inlineCheckbox1">Internet*</label>
                    </div>
                    <div class="form-check form-check-inline col">
                        <input class="form-check-input" type="checkbox" name="huseg" value="huseg">
                        <label class="form-check-label" for="inlineCheckbox1">Hűség</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Hűség lejárata (amennyiben van)</label>
                    <input type="date" class="form-control" id="" name="husegdatum">
                </div>
                <?php
                $sql = "SELECT Telefon_tipus FROM telefon";
                $result = $connection->query($sql);

                echo "<label>SIM kártya fűzése az alábbi telefonhoz (opcionális)</label>";
                echo "<select name='telefon_add' class='form-control'>";
                echo "<option disabled selected value> -- Telefon választása -- </option>";
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['Telefon_tipus'] . "'>" . $row['Telefon_tipus'] . "</option>";
                }
                echo "</select><br>";
                ?>
                <button type="submit" class="btn btn-info btn-block" name="submit">Hozzáad</button>
                <a href="simek_managelese.php" class="btn-danger btn btn-block">Vissza</a>
                <p class=" font-weight-light text-center mt-1">A *-al jelölt mezők kitöltése kötelező.</p>

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
