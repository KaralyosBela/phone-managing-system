<?php
session_start();

if($_SESSION['loggedin'] == "no"){
    header('Location: index.php');
    exit;
}
if ($_SESSION['admin'] == "no") {
    header('Location: fooldalbootstrap.php');
    exit;
}
include "connection.php";

$imei = $_GET['imei'];

$sql = "SELECT * FROM sim WHERE imei = $imei";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

$a = $row['IMEI'];
$b = $row['Telefonszam'];
$c = $row['Pin1'];
$d = $row['Pin2'];
$e = $row['Puk1'];
$f = $row['Puk2'];
$g = $row['Hang'];
$h = $row['Internet'];
$j = $row['Huseg'];
$k = $row['Huseg_kezdete'];

if (isset($_POST['szerkeszt'])) {

    $imeiszam = $_POST['imei'];
    $telefonszam = $_POST['telefonszam'];
    $pin1 = $_POST['pin1'];
    $pin2 = $_POST['pin2'];
    $puk1 = $_POST['puk1'];
    $puk2 = $_POST['puk2'];
    if(empty($_POST['hang'])) $hang = 0; else $hang = 1;
    if(empty($_POST['internet'])) $internet = 0; else $internet = 1;
    if(empty($_POST['huseg'])) $huseg = 0; else $huseg = 1;
    /*$hang = $_POST['hang'];
    $internet = $_POST['internet'];
    $huseg = $_POST['huseg'];*/
    $husegdatuma = $_POST['husegdatuma'];

    if (empty($huseg)) {
        $sql = "UPDATE sim SET 
            IMEI = '$imeiszam',
            Telefonszam = '$telefonszam',
            Pin1 = '$pin1',
            Pin2 = '$pin2',
            Puk1 = '$puk1',
            Puk2 = '$puk2',
            Hang = '$hang',
            Internet = '$internet',
            Huseg = NULL,
            Huseg_kezdete = NULL WHERE IMEI = $imei";
    } else {
        $sql = "UPDATE sim SET 
            IMEI = '$imeiszam',
            Telefonszam = '$telefonszam',
            Pin1 = '$pin1',
            Pin2 = '$pin2',
            Puk1 = '$puk1',
            Puk2 = '$puk2',
            Hang = '$hang',
            Internet = '$internet',
            Huseg = '$huseg',
            Huseg_kezdete = '$husegdatuma' WHERE IMEI = $imei";
    }
    $connection->query($sql);
    echo $sql;
    header('Location: simek_managelese.php');

}

?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>Edit Sim</title>
</head>

<body class="bg-dark text-light">

<div class="container-fluid">
    <div class="row mt-4">
        <div class="col"></div>
        <div class="col-lg-4 col-md-5 col-sm-6">
            <form method="post">
                <div class="form-group">
                    <label for="">IMEI szám</label>
                    <input type="text" name="imei" class="form-control" value="<?php if (isset($a)) echo $a; ?>">
                </div>
                <div class="form-group">
                    <label for="">Telefonszám</label>
                    <input type="text" name="telefonszam" class="form-control" value="<?php if (isset($b)) echo $b; ?>">
                </div>
                <div class="form-row text-center">
                    <div class="form-group col-md-3">
                        <label for="">PIN-kód 1</label>
                        <input type="text" name="pin1" class="form-control" value="<?php if (isset($c)) echo $c; ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">PIN-kód 2</label>
                        <input type="text" name="pin2" class="form-control" value="<?php if (isset($d)) echo $d; ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">PUK-kód 1</label>
                        <input type="text" name="puk1" class="form-control" value="<?php if (isset($e)) echo $e; ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">PUK-kód 2</label>
                        <input type="text" name="puk2" class="form-control" value="<?php if (isset($f)) echo $f; ?>">
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="form-check form-check-inline col">
                        <input class="form-check-input" type="checkbox" value="hang" <?php if ($g == 1) echo "checked"; ?> name="hang">
                        <label class="form-check-label">Hang</label>
                    </div>
                    <div class="form-check form-check-inline col">
                        <input class="form-check-input" type="checkbox" name="internet" value="internet" <?php if ($h == 1) echo "checked"; ?>>
                        <label class="form-check-label">Internet</label>
                    </div>
                    <div class="form-check form-check-inline col">
                        <input class="form-check-input" type="checkbox" name="huseg" value="huseg" <?php if ($j == 1) echo "checked"; ?>>
                        <label class="form-check-label">Hűség</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Hűség lejárata (amennyiben van)</label>
                    <input type="date" name="husegdatuma" class="form-control" value="<?php if (isset($k)) echo $k; ?>">
                </div>

                <button type="submit" class="btn btn-info btn-block" name="szerkeszt">Szerkeszt</button>
                <a href="simek_managelese.php" class="btn-danger btn btn-block">Vissza</a>

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




