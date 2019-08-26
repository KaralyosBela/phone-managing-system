<?php
session_start();

if ($_SESSION['loggedin'] == "no") {
    header('Location: index.php');
    exit;
}

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
    <title>SIM kártyák</title>
    <style>
        .table-hover tbody tr:hover td {
            background-color: rgba(23, 161, 183, 0.56);
            cursor: pointer;
        }

        .navbar-dark .navbar-nav .active > .nav-link {
            color: rgb(23, 161, 183);
        }

        .form-group {
            margin-bottom: 0;
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
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="fooldalbootstrap.php">Lekérdezések <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="felhasznalok_managelese.php">Dolgozók</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="telefonok_managelese.php">Telefonok</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="">SIM kártyák</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Kilépés</a>
            </li>
        </ul>

        <!--<form method="post" class="form-inline my-2 my-lg-0" action="add_sim.php">
            <button class="btn btn-info my-2 my-sm-0" type="submit">Új SIM hozzáadása</button>
        </form>-->
    </div>
</nav>

<!--
<div class="container-fluid bg-dark pt-1 mt-0">
    <div class="form-row">
        <div class="form-group col-md-2">
            <form method="post" action="add_sim.php">
                <button class="btn btn-info btn-block" type="submit">Új SIM</button>
            </form>
        </div>
        <div class="form-group col-md-2">
            <input type="text" class="form-control text-center" placeholder="IMEI szerint" name="nev">
        </div>
        <div class="form-group col-md-2">
            <input type="text" class="form-control text-center" placeholder="Telefonszám szerint" name="telefonszam">
        </div>
        <div class="form-group col-md-2">
            <input type="text" class="form-control text-center" placeholder="Hűség szerint" name="tel_imei">
        </div>
        <div class="form-group col-md-4">
            <button type="submit" class="btn btn-info btn-block" name="submit">Keresés</button>
        </div>
    </div>
</div>
-->

<div class="container-fluid bg-dark pt-1 mt-0">
    <div class="form-row">
        <div class="col-md-2">
            <div class="form-row">
                <div class="form-group col-md">
                    <form method="post" action="add_sim.php">
                        <button class="btn btn-info btn-block" type="submit" <?php if($_SESSION['admin']=="no") echo "disabled" ?>>Új SIM</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-10">
            <form method="post" class="mb-0">
                <div class="container-fluid bg-dark ">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control text-center" placeholder="IMEI szerint" name="imei">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control text-center" placeholder="Telefonszám szerint"
                                   name="telefonszam">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control text-center" placeholder="Hűség szerint"
                                   name="huseg">
                        </div>
                        <div class="form-group col-md-3">
                            <button type="submit" class="btn btn-info btn-block" name="submit">Keresés</button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

<div class="table-responsive">

    <?php
    include "Connection.php";

    //$sql = "SELECT * from sim";

    if (isset($_POST['submit'])) {

        $sql = "SELECT * FROM sim";

        if (!empty($_POST['imei'])) {
            $imei = $_POST['imei'];
            $sql .= " WHERE IMEI LIKE '%" . $imei . "%'";
        }
        if (!empty($_POST['telefonszam'])) {
            $telefonszam = $_POST['telefonszam'];
            $sql .= " WHERE Telefonszam LIKE '%" . $telefonszam . "%'";
        }
        if (!empty($_POST['huseg'])) {
            $huseg = $_POST['huseg'];
            $sql .= " WHERE Huseg LIKE '%" . $huseg . "%'";
        }

    } else {
        $sql = "SELECT * FROM sim";
    }

    if ($_GET) {
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

        echo "<table class='table table-dark table-hover table-striped'>";
        echo "<tr class='thead-dark'>
            <th class='text-info'><a href='simek_managelese.php?sort=imeiszerint&ascdesc=$ascdesc'>IMEI</a></th>
            <th class='text-info'>Telefon IMEI</th>
            <th class='text-info'><a href='simek_managelese.php?sort=telszamszerint&ascdesc=$ascdesc'>Telefonszam</a></th>
            <th class='text-info'>Pin 1</th>
            <th class='text-info'>Pin 2</th>
            <th class='text-info'>Puk 1</th>
            <th class='text-info'>Puk 2</th>
            <th class='text-info'><a href='simek_managelese.php?sort=hangszerint&ascdesc=$ascdesc'>Hang</a></th>
            <th class='text-info'><a href='simek_managelese.php?sort=internetszerint&ascdesc=$ascdesc'>Internet</a></th>
            <th class='text-info'><a href='simek_managelese.php?sort=husegszerint&ascdesc=$ascdesc'>Hűseg</a></th>
            <th class='text-info'><a href='simek_managelese.php?sort=husegkezdeteszerint&ascdesc=$ascdesc'>Hűseg kezdete</a></th>
            <th colspan='2' class='text-center text-info'>Opciók</th>
            </tr>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["IMEI"] . "</td>" .
                    "<td>" . $row["Telefon_IMEI"] . "</td>" .
                    "<td>" . $row["Telefonszam"] . "</td>" .
                    "<td>" . $row["Pin1"] . "</td>" .
                    "<td>" . $row["Pin2"] . "</td>" .
                    "<td>" . $row["Puk1"] . "</td>" .
                    "<td>" . $row["Puk2"] . "</td>" .
                    "<td>" . ($row['Hang'] == "1" ? 'Van' : 'Nincs') . "</td>" .
                    "<td>" . ($row['Internet'] == "1" ? 'Van' : 'Nincs') . "</td>" .
                    "<td>" . ($row['Huseg'] == "1" ? 'Van' : 'Nincs') . "</td>" .
                    "<td>" . $row["Huseg_kezdete"] . "</td>";

                if ($_SESSION['admin'] == "no") {
                    echo "<td></td>";
                } else {
                    echo "<td><a class=\"badge badge-light\"  href='edit_sim.php?imei=" . $row['IMEI'] . "'>Szerkesztés</a></td>";

                    if (empty($row["Telefon_IMEI"])) {
                        echo "<td><a class=\"badge badge-light\" href='#'>Felszabadítás</a></td>";
                    } else {
                        echo "<td><a class=\"badge badge-info\" href='unset_sim.php?imei=" . $row['IMEI'] . "'>Felszabadítás</a></td>";
                    }

                    echo "<td><a class=\"badge badge-danger\"  href='delete_sim.php?imei=" . $row['IMEI'] . "'>Törlés</a></td>";
                    echo "</tr>";
                }
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
