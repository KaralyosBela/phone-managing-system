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

$sql = "SELECT * FROM telefon WHERE imei = $imei";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

$a = $row['imei'];
$b = $row['Telefon_tipus'];
$c = $row['Vasarlas_datuma'];
$d = $row['Garancia'];
$e = $row['Sajat'];

if (isset($_POST['szerkeszt'])) {

    $imei_szerk = $_POST['imei'];
    $Telefontipus_szerk = $_POST['telefon_tipus'];
    $vasarlasdatuma_szerk = $_POST['vasarlas_datum'];
    $garancia_szerk = $_POST['garancia_lejarata'];
    if(empty($_POST['ceges'])) $ceges = 0; else $ceges = 1;

    $sql = "UPDATE telefon SET imei=$imei_szerk, 
            Telefon_tipus = '$Telefontipus_szerk', 
            Vasarlas_datuma = '$vasarlasdatuma_szerk', 
            Garancia = '$garancia_szerk', 
            Sajat = '$ceges'
            WHERE imei=$imei";
    $connection->query($sql);
    header('Location: telefonok_managelese.php');

}

?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>Edit user</title>
</head>

<body class="bg-dark text-light">

<div class="container-fluid">
    <div class="row">
        <div class="col"></div>
        <div class="col-lg-4 col-md-5 col-sm-6 mt-5">
            <form method="post">
                <div class="form-group">
                    <label for="">IMEI szám</label>
                    <input type="text" name="imei" class="form-control" value="<?php if (isset($a)) echo $a; ?>">
                </div>
                <div class="form-group">
                    <label for="">Telefon típusa</label>
                    <input type="text" name="telefon_tipus" class="form-control" value="<?php if (isset($b)) echo $b; ?>">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">Vásárlás dátuma</label>
                        <input type="date" name="vasarlas_datum" class="form-control" value="<?php if (isset($c)) echo $c; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Garancia lejárata</label>
                        <input type="date" name="garancia_lejarata" class="form-control" value="<?php if (isset($d)) echo $d; ?>">
                    </div>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="ceges" name="ceges" <?php if ($e == 1) echo "checked"; ?>>
                    <label class="form-check-label" for="defaultCheck1">
                        Céges telefon
                    </label>
                </div>
                <button type="submit" class="btn btn-info btn-block" name="szerkeszt">Szerkesztés</button>
                <a href="telefonok_managelese.php" class="btn-danger btn btn-block">Vissza</a>

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




