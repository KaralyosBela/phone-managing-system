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
include "Connection.php";

$id = $_GET['id'];

$sql = "SELECT * FROM felhasznalok WHERE id = $id";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

$a = $row['Nev'];
$b = $row['Osztaly'];
$c = $row['Beosztas'];

if (isset($_POST['szerkeszt'])) {

    $nev_szerk = $_POST['nev_szerk'];
    $osztaly_szerk = $_POST['osztaly_szerk'];
    $beosztas_szerk = $_POST['beosztas_szerk'];

    $sql = "UPDATE felhasznalok SET Nev='$nev_szerk', Osztaly='$osztaly_szerk', Beosztas='$beosztas_szerk' WHERE ID=$id";
    $connection->query($sql);
    header('Location: felhasznalok_managelese.php');

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
                    <label for="">Név</label>
                    <input type="text" name="nev_szerk" class="nev form-control" value="<?php if (isset($a)) echo $a; ?>">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">Osztály</label>
                        <input type="text" name="osztaly_szerk" class="osztaly form-control" value="<?php if (isset($b)) echo $b ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Beosztás</label>
                        <input type="text" name="beosztas_szerk" class="beosztas form-control" value="<?php if (isset($c)) echo $c ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-info btn-block" name="szerkeszt">Szerkeszt</button>
                <a href="felhasznalok_managelese.php" class="btn-danger btn btn-block">Vissza</a>

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




