<?php
session_start();

if ($_SESSION['loggedin'] == "no") {
    header('Location: index.php');
    exit;
}
include "Connection.php";
global $x;

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
    <title>Telefonok</title>
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
            <li class="nav-item active">
                <a class="nav-link" href="">Telefonok</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="simek_managelese.php">SIM kártyák</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Kilépés</a>
            </li>
        </ul>
        <!--<form method="post" class="form-inline my-2 my-lg-0" action="simtelefonhoz.php">
            <button class="btn btn-info my-2 my-sm-0 mr-2" type="submit">SIM kártya kapcsolás telefonhoz</button>
        </form>
        <form method="post" class="form-inline my-2 my-lg-0" action="add_telefon.php">
            <button class="btn btn-info my-2 my-sm-0" type="submit">Új telefon hozzáadása</button>
        </form>
        -->
    </div>
</nav>
<!--
<div class="mb-0">
    <div class="container-fluid bg-dark pt-1 mt-0">
        <div class="form-row">

            <div class="form-group col-md-2">
                <form method="post" action="simtelefonhoz.php">
                    <button class="btn btn-info btn-block" type="submit">Sim telefonhoz fűzése</button>
                </form>
            </div>
            <div class="form-group col-md-2">
                <form method="post" action="add_telefon.php">
                    <button class="btn btn-info btn-block" type="submit">Új telefon</button>
                </form>
            </div>
            <div class="form-group col-md-2">
                <input type="text" class="form-control text-center" placeholder="IMEI szerint" name="nev">
            </div>
            <div class="form-group col-md-2">
                <input type="text" class="form-control text-center" placeholder="Típus szerint" name="telefon">
            </div>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-info btn-block" name="submit">Keresés</button>
            </div>
        </div>
    </div>
</div>
-->

<div class="container-fluid bg-dark pt-1 mt-0">
    <div class="form-row">
        <div class="col-md-4">
            <div class="form-row">
                <!-- <div class="form-group col-md-6">
                    <form method="post" action="simtelefonhoz.php">
                        <button class="btn btn-info btn-block" type="submit">Sim telefonhoz fűzése</button>
                    </form>
                </div> -->
                <div class="form-group col-md">
                    <form method="post" action="add_telefon.php">
                        <button class="btn btn-info btn-block"
                                type="submit" <?php if ($_SESSION['admin'] == "no") echo "disabled" ?>>Új telefon
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <form method="post" class="mb-0">
                <div class="container-fluid bg-dark ">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control text-center" placeholder="IMEI szerint" name="imei">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control text-center" placeholder="Típus szerint"
                                   name="tipus">
                        </div>
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-info btn-block" name="submit">Keresés</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="table-responsive">
    <?php
    //$sql = "SELECT * from Telefon";

    if (isset($_POST['submit'])) {

        $sql = "SELECT * FROM telefon";

        if (!empty($_POST['imei'])) {
            $imei = $_POST['imei'];
            $sql .= " WHERE imei LIKE '%" . $imei . "%'";
        }
        if (!empty($_POST['tipus'])) {
            $tipus = $_POST['tipus'];
            $sql .= " WHERE Telefon_tipus LIKE '%" . $tipus . "%'";
        }

    } else {
        $sql = "SELECT * FROM telefon";
    }

    if ($_GET) {
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
        if ($_GET['sort'] == 'kiadasszerint') {
            $sql .= " ORDER by Kiadas $ascdesc";
        }
        if ($_GET['sort'] == 'visszavetelszerint') {
            $sql .= " ORDER by Visszavetel $ascdesc";
        }
        if ($_GET['sort'] == 'sajatszerint') {
            $sql .= " ORDER by Sajat $ascdesc";
        }
    }

    $result = $connection->query($sql);

    if ($result->num_rows == 0) {
        echo "<div class=\"container-fluid\"><div class=\"alert alert-info mt-3 text-center\" role=\"alert\">Nincs találat a keresési feltételre.</div></div>";
    } else {

        echo "<table class='table table-dark table-hover table-striped'>";
        echo "<tr  class='thead-dark text-info'>
<th class='text-info'><a href='telefonok_managelese.php?sort=imeiszerint&ascdesc=$ascdesc'>IMEI</a></th>
<th class='text-info'>USER ID</th>
<th class='text-info'><a href='telefonok_managelese.php?sort=tipusszerint&ascdesc=$ascdesc'>Telefon típusa</a></th>
<th class='text-info'><a href='telefonok_managelese.php?sort=vasarlasszerint&ascdesc=$ascdesc'>Vásárlás dátuma</a></th>
<th class='text-info' data-toggle=\"tooltip\" data-placement=\"top\" title=\"Zöld: 30 napon túli a lejárat.\nSárga: 30 nap alatti.\nPiros: 7 nap alatti.\"><a href='telefonok_managelese.php?sort=gariszerint&ascdesc=$ascdesc'>Garancia</a></th>
<th class='text-info'><a href='telefonok_managelese.php?sort=kiadasszerint&ascdesc=$ascdesc'>Kiadás</a></th>
<th class='text-info'><a href='telefonok_managelese.php?sort=visszavetelszerint&ascdesc=$ascdesc'>Visszavétel</a></th>
<th class='text-info'><a href='telefonok_managelese.php?sort=sajatszerint&ascdesc=$ascdesc'>Saját</a></th>
<th colspan='2' class='text-center text-info'>Opciók</th></tr>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["imei"] . "</td>" .
                    "<td>" . $row["User_id"] . "</td>" .
                    "<td>" . $row["Telefon_tipus"] . "</td>" .
                    "<td>" . $row["Vasarlas_datuma"] . "</td>";

                $currentDate = time();
                $garTime = strtotime($row["Garancia"]);
                $timeDiffInDays = round((($garTime - $currentDate)) / 60 / 60 / 24);
                if ($timeDiffInDays > 30) $asd = "<span class=\"badge badge-pill badge-success\">" . $timeDiffInDays . "</span>";
                else if ($timeDiffInDays <= 30 && $timeDiffInDays > 7) $asd = "<span class=\"badge badge-pill badge-warning\">" . $timeDiffInDays . "</span>";
                else if ($timeDiffInDays <= 7 && $timeDiffInDays > 0) $asd = "<span class=\"badge badge-pill badge-danger\">" . $timeDiffInDays . "</span>";
                else if ($timeDiffInDays <= 0) $asd = "<span class=\"badge badge-pill badge-danger\">exp</span>";
                if(is_null($row["Garancia"])) {
                    echo "<td>" . $row["Garancia"] . "</td>";
                }else{

                echo "<td>" . $row["Garancia"] . " " . $asd . "</td>"; }

                echo    "<td>" . $row["Kiadas"] . "</td>" .
                    "<td>" . $row["Visszavetel"] . "</td>" .
                    "<td>" . ($row['Sajat'] == "0" ? 'Saját' : 'Céges') . "</td>";


                if ($_SESSION['admin'] == "no") {
                    echo "<td></td>";
                } else {
                    echo "<td><a class=\"badge badge-light\" href='edit_telefon.php?imei=" . $row['imei'] . "'>Szerkesztés</a></td>";

                    if (empty($row["User_id"])) {
                        echo "<td><a class=\"badge badge-light\" href='#'>Felszabadítás</a></td>";
                    } else {
                        echo "<td><a class=\"badge badge-info\" href='unset_telefon.php?imei=" . $row['imei'] . "'>Felszabadítás</a></td>";
                    }
                    echo /*"<td><a class=\"badge badge-light\" href='unset_dates.php?imei=" . $row['imei'] . "'>Dátum törlés</a></td>" .*/
                        "<td><a class=\"badge badge-danger\" href='delete_telefon.php?imei=" . $row['imei'] . "'>Törlés</a></td>";
                    echo "</tr>";
                }
            }
        }
        echo "</table>";

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

