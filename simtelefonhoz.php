<?php

include "Connection.php";
session_start();

if($_SESSION['loggedin'] == "no"){
    header('Location: index.php');
    exit;
}



if (isset($_POST['yes'])) {
    if (!empty($_POST['telefon']) && !empty($_POST['sim'])) {
        echo $telimei = $_POST['telefon'];
        echo $sim = $_POST['sim'];
        $sql = "UPDATE sim SET Telefon_IMEI='$telimei' WHERE imei= '$sim'";
        echo $sql;
        $connection->query($sql);
        header('Location: telefonok_managelese.php');
    }else{
        $hiba = true;
    }
} else if (isset($_POST['no'])) {
    header('Location: telefonok_managelese.php');
}

?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>Dolgozók</title>
</head>

<body class="bg-dark">


<div class="container-fluid">
    <div class="row">
        <div class="col"></div>
        <div class="col-lg-4 col-md-5 col-sm-6">
            <form method="post" class="text-light mt-5">
                <div class="form-group">
                    <label>Simek (Telefonszám, Imei):</label>
                    <?php
                    $sql = "SELECT * FROM sim WHERE Telefon_IMEI IS NULL";
                    $result = $connection->query($sql);

                    echo "<select class=\"form-control\" name='sim'>";
                    echo "<option disabled selected value>  Telefonszám választása </option>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['IMEI'] . "'>" . $row['Telefonszam'] . " (". $row['IMEI'] .")</option>";
                    }
                    echo "</select>";
                    ?>
                </div>
                <div class="form-group">
                    <label>Telefonok (Típus, Imei):</label>

                    <?php
                    //$sql = "SELECT * FROM telefon WHERE User_id IS NULL";
                    $sql = "SELECT * FROM telefon";

                    $result = $connection->query($sql);

                    echo "<select class=\"form-control\" name='telefon'>";
                    echo "<option disabled selected value>  Telefon választása </option>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['imei'] . "'>" . $row['Telefon_tipus'] . " (". $row['imei'] .") </option>";
                    }
                    echo "</select>";
                    ?>
                </div>
                <div class="form-row">
                    <div class="col"><button type="submit" class="btn btn-info btn-block" name="yes" value="yes">Alkalmaz</button></div>
                    <div class="col"><button type="submit" class="btn btn-danger btn-block" name="no" value="no">Mégse</button></div>
                </div>
                <?php
                if ($_POST) {
                    if($hiba)
                        echo "<div class=\"alert alert-info mt-3 text-center\" role=\"alert\">Töltsd ki mind a két mezőt!</div>";
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
