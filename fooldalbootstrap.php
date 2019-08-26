<?php
session_start();

include "Connection.php";

if ($_SESSION['loggedin'] == "no") {
    header('Location: index.php');
    exit;
}

global $workers, $phones, $sims, $kiadotttelefon, $kiadottsim;

$sql = "SELECT * FROM felhasznalok";
$result = $connection->query($sql);
$workers = $result->num_rows;
$sql = "SELECT * FROM telefon";
$result = $connection->query($sql);
$phones = $result->num_rows;
$sql = "SELECT * FROM sim";
$result = $connection->query($sql);
$sims = $result->num_rows;

$ascdesc = "";
$ascdesc = isset($_GET['ascdesc']) ? $_GET['ascdesc'] : 'DESC';
switch (strtoupper($ascdesc)) {
    case 'DESC':
        $ascdesc = 'ASC';
        break;
    case 'ASC':
        $ascdesc = 'DESC';
        break;
    default:
        $ascdesc = 'DESC';
        break;
}
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


    <title>Keresés & Lekérdezések</title>
    <style>
        .table-hover tbody tr:hover td {
            background-color: rgba(23, 161, 183, 0.56);
            cursor: pointer;
        }

        .navbar-dark .navbar-nav .active > .nav-link {
            color: rgb(23, 161, 183);
        }

        a, a:hover {
            text-decoration: none;
            color: #17a1b7;
        }

    </style>

</head>

<body class="bg-dark">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="">Lekérdezések <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="felhasznalok_managelese.php">Dolgozók</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="telefonok_managelese.php">Telefonok</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="simek_managelese.php">SIM kártyák</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Kilépés</a>
            </li>
        </ul>

        <form class="form-inline my-2 my-lg-0">
            <button class="btn btn-info my-2 my-sm-0 mr-2 " type="submit">Dolgozók <span
                        class="badge badge-light"><?php echo $workers; ?> db</span></button>
        </form>
        <form class="form-inline my-2 my-lg-0">
            <button class="btn btn-info my-2 my-sm-0 mr-2 " type="submit">Telefonok <span
                        class="badge badge-light"><?php echo $phones; ?> db</span></button>
        </form>
        <form class="form-inline my-2 my-lg-0">
            <button class="btn btn-info my-2 my-sm-0 mr-2 " type="submit">SIM kártyák <span
                        class="badge badge-light"><?php echo $sims; ?> db</span></button>
        </form>
    </div>


</nav>

<form method="post" class="mb-0">
    <div class="container-fluid bg-dark pt-1 mt-0">
        <div class="form-row">
            <div class="form-group col-md-2">
                <input type="text" class="form-control text-center" placeholder="Név szerint" name="nev">
            </div>
            <div class="form-group col-md-2">
                <input type="text" class="form-control text-center" placeholder="Telefon szerint" name="telefon">
            </div>
            <div class="form-group col-md-2">
                <input type="text" class="form-control text-center" placeholder="Telefonszám szerint"
                       name="telefonszam">
            </div>
            <div class="form-group col-md-2">
                <input type="text" class="form-control text-center" placeholder="Telefon IMEI szerint" name="tel_imei">
            </div>
            <div class="form-group col-md-2">
                <input type="text" class="form-control text-center" placeholder="Sim IMEI szerint" name="sim_imei">
            </div>
            <div class="form-group col-md-2">
                <button type="submit" class="btn btn-info btn-block" name="submit">Keresés<span
                            class="glyphicon glyphicon-star" aria-hidden="true"></span></button>
            </div>
        </div>
    </div>
</form>

<div class="table-responsive">
    <?php

    include "Connection.php";

    if (isset($_POST['submit'])) {

        $sql = "SELECT * FROM felhasznalok
LEFT JOIN telefon ON felhasznalok.ID = telefon.User_id
LEFT JOIN sim ON telefon.imei = sim.Telefon_IMEI where telefon.imei is not null";

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
            $sql .= " WHERE sim.IMEI LIKE '%" . $simimeiszerint . "%'";
        }


    } else {
        $sql = "SELECT * FROM felhasznalok
LEFT JOIN telefon ON felhasznalok.ID = telefon.User_id
LEFT JOIN sim ON telefon.imei = sim.Telefon_IMEI where telefon.imei is not null";
    }

    if ($_GET) {
        if ($_GET['sort'] == 'nevszerint') {
            $sql .= " ORDER by Nev $ascdesc";
        }
        if ($_GET['sort'] == 'osztalyszerint') {
            $sql .= " ORDER by Osztaly $ascdesc";
        }
        if ($_GET['sort'] == 'beosztasszerint') {
            $sql .= " ORDER by Beosztas $ascdesc";
        }
        if ($_GET['sort'] == 'imeiszerint') {
            $sql .= " ORDER by imei $ascdesc";
        }
        if ($_GET['sort'] == 'tipusszerint') {
            $sql .= " ORDER by Telefon_tipus $ascdesc";
        }
        if ($_GET['sort'] == 'vasarlasszerint') {
            $sql .= " ORDER by Vasarlas_datuma $ascdesc";
        }
        if ($_GET['sort'] == 'gariszerint') {
            $sql .= " ORDER by Garancia $ascdesc";
        }
        if ($_GET['sort'] == 'sajatszerint') {
            $sql .= " ORDER by Sajat $ascdesc";
        }
        if ($_GET['sort'] == 'imeiszerint') {
            $sql .= " ORDER by IMEI $ascdesc";
        }
        if ($_GET['sort'] == 'telszamszerint') {
            $sql .= " ORDER by Telefonszam $ascdesc";
        }
        if ($_GET['sort'] == 'hangszerint') {
            $sql .= " ORDER by Hang $ascdesc";
        }
        if ($_GET['sort'] == 'internetszerint') {
            $sql .= " ORDER by Internet $ascdesc";
        }
        if ($_GET['sort'] == 'husegszerint') {
            $sql .= " ORDER by Huseg $ascdesc";
        }
        if ($_GET['sort'] == 'husegkezdeteszerint') {
            $sql .= " ORDER by Huseg_kezdete $ascdesc";
        }
    }

    $result = $connection->query($sql);


    if ($result->num_rows == 0) {
        echo "<div class=\"container-fluid\"><div class=\"alert alert-info mt-3 text-center\" role=\"alert\">Nincs találat a keresési feltételre.</div></div>";
    } else {

        echo "<table class='table table-dark table-hover table-striped '>";
        echo "<tr class='thead-dark'>
<th class='text-info'><a href='fooldalbootstrap.php?sort=nevszerint&ascdesc=$ascdesc'>Név</a></th>
<th class='text-info'><a href='fooldalbootstrap.php?sort=osztalyszerint&ascdesc=$ascdesc'>Osztály</a></th>
<th class='text-info'><a href='fooldalbootstrap.php?sort=beosztasszerint&ascdesc=$ascdesc'>Beosztás</a></th>
<th class='text-info'><a href='fooldalbootstrap.php?sort=telimeiszerint&ascdesc=$ascdesc'>Telefon IMEI</a></th>
<th class='text-info'><a href='fooldalbootstrap.php?sort=tipusszerint&ascdesc=$ascdesc'>Telefon típusa</a></th>
<th class='text-info'><a href='fooldalbootstrap.php?sort=vasarlasszerint&ascdesc=$ascdesc'>Vásárlás</a></th>
<th class='text-info' data-toggle=\"tooltip\" data-placement=\"top\" title=\"Zöld: 30 napon túli a lejárat.\nSárga: 30 nap alatti.\nPiros: 7 nap alatti.\"><a href='fooldalbootstrap.php?sort=gariszerint&ascdesc=$ascdesc'>Garancia</a></th>
<th class='text-info'><a href='fooldalbootstrap.php?sort=sajatszerint&ascdesc=$ascdesc'>Saját</a></th>
<th class='text-info'><a href='fooldalbootstrap.php?sort=simimeiszerint&ascdesc=$ascdesc'>Sim IMEI</a></th>
<th class='text-info'><a href='fooldalbootstrap.php?sort=telszamszerint&ascdesc=$ascdesc'>Telefonszam</a></th>
<!--<th class='text-info'><a href='fooldalbootstrap.php?sort=hangszerint&ascdesc=$ascdesc'>Hang</a></th>
<th class='text-info'><a href='fooldalbootstrap.php?sort=internetszerint&ascdesc=$ascdesc'>Internet</a></th>
<th class='text-info'><a href='fooldalbootstrap.php?sort=husegszerint&ascdesc=$ascdesc'>Hűseg</a></th>-->
<th class='text-info'><a href='fooldalbootstrap.php?sort=husegkezdeteszerint&ascdesc=$ascdesc'>Hűseg kezdete</a></th>
<th class='text-info'>Print</th>

</tr>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["Nev"] . "</td>" .
                    "<td>" . $row["Osztaly"] . "</td>" .
                    "<td>" . $row["Beosztas"] . "</td>" .
                    "<td>" . $row["imei"] . "</td>" .
                    "<td>" . $row["Telefon_tipus"] . "</td>" .
                    "<td>" . $row["Vasarlas_datuma"] . "</td>";

                $currentDate = time();
                $garTime = strtotime($row["Garancia"]);
                $timeDiffInDays = round((($garTime - $currentDate)) / 60 / 60 / 24);
                if ($timeDiffInDays > 30) $asd = "<span class=\"badge badge-pill badge-success\">" . $timeDiffInDays . "</span>";
                else if ($timeDiffInDays <= 30 && $timeDiffInDays > 7) $asd = "<span class=\"badge badge-pill badge-warning\">" . $timeDiffInDays . "</span>";
                else if ($timeDiffInDays <= 7 && $timeDiffInDays > 0) $asd = "<span class=\"badge badge-pill badge-danger\">" . $timeDiffInDays . "</span>";
                else if ($timeDiffInDays <= 0) $asd = "<span class=\"badge badge-pill badge-danger\">exp</span>";
                if (is_null($row["Garancia"])) $asd = null;

                echo "<td>" . $row["Garancia"] . " " . $asd . "</td>";

                if (is_null($row['Sajat'])) {
                    echo "<td></td>";
                } else {
                    echo "<td>" . ($row['Sajat'] == "0" ? 'Saját' : 'Céges') . "</td>";
                }

                echo "<td>" . $row["IMEI"] . "</td>" .
                    "<td>" . $row["Telefonszam"] . "</td>";

                /*if (is_null($row['Hang'])) {
                    echo "<td></td>";
                } else {
                    echo "<td>" . ($row['Hang'] == "1" ? 'Van' : 'Nincs') . "</td>";
                }
                if (is_null($row['Internet'])) {
                    echo "<td></td>";
                } else {
                    echo "<td>" . ($row['Internet'] == "1" ? 'Van' : 'Internet') . "</td>";
                }
                if (is_null($row['Huseg'])) {
                    echo "<td></td>";
                } else {
                    echo "<td>" . ($row['Huseg'] == "1" ? 'Van' : 'Huseg') . "</td>";
                }*/

                echo "<td>" . $row["Huseg_kezdete"] . "</td>";
                if (!is_null($row['imei'])) {
                    echo "<td><a class=\"badge badge-light\" target=\"_blank\" href='nyomtatas.php?id=" . $row['ID'] . "&telimei=" . $row['imei'] . "' >Print</a></td>";
                }else
                {
                    echo "<td></td>";
                }
                echo "</tr>";
            }
        }
        echo "</table><br>";

    }

    ?>
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

