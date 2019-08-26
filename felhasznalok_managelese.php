<?php
session_start();
include "Connection.php";

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
    <title>Dolgozók</title>
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
            <li class="nav-item active">
                <a class="nav-link" href="">Dolgozók</a>
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
        <!--<form method="post" class="form-inline my-2 my-lg-0" action="telefondolgozonak.php ">
            <button class="btn btn-info my-2 my-sm-0 mr-2" type="submit">Telefon kiadása dolgozónak</button>
        </form>
        <form method="post" class="form-inline my-2 my-lg-0" action="add_user.php">
            <button class="btn btn-info my-2 my-sm-0" type="submit">Új dolgozó hozzáadása</button>
        </form>
        -->
    </div>
</nav>

<div class="container-fluid bg-dark pt-1 mt-0">
    <div class="form-row">
        <div class="col-md-4">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <form method="post" action="telefondolgozonak.php">
                        <button class="btn btn-info btn-block" type="submit" <?php if($_SESSION['admin']=="no") echo "disabled" ?>>Telefon kiadása</button>
                    </form>
                </div>
                <div class="form-group col-md-6">
                    <form method="post" action="add_user.php">
                        <button class="btn btn-info btn-block" type="submit " <?php if($_SESSION['admin']=="no") echo "disabled" ?>>Új dolgozó</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <form method="post" class="mb-0">
                <div class="container-fluid bg-dark ">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control text-center" placeholder="Név szerint" name="nev">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control text-center" placeholder="Osztály szerint"
                                   name="osztaly">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control text-center" placeholder="Beosztás szerint"
                                   name="beosztas">
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
        if (isset($_POST['submit'])) {

            $sql = "SELECT * FROM felhasznalok";

            if (!empty($_POST['nev'])) {
                $nevszerint = $_POST['nev'];
                $sql .= " WHERE Nev LIKE '%" . $nevszerint . "%'";
            }
            if (!empty($_POST['beosztas'])) {
                $beosztas = $_POST['beosztas'];
                $sql .= " WHERE Beosztas LIKE '%" . $beosztas . "%'";
            }
            if (!empty($_POST['osztaly'])) {
                $osztaly = $_POST['osztaly'];
                $sql .= " WHERE Osztaly LIKE '%" . $osztaly . "%'";
            }

        } else {
            $sql = "SELECT * FROM felhasznalok";
        }

        if ($_GET) {
            if ($_GET['sort'] == 'nevszerint') {
                $sql .= " ORDER BY Nev $ascdesc";
            }
            if ($_GET['sort'] == 'osztalyszerint') {
                $sql .= " ORDER by Osztaly $ascdesc";
            }
            if ($_GET['sort'] == 'beosztasszerint') {
                $sql .= " ORDER by Beosztas $ascdesc";
            }

        }
        $result = $connection->query($sql);

        if ($result->num_rows == 0) {
            echo "<div class=\"container-fluid\"><div class=\"alert alert-info mt-3 text-center\" role=\"alert\">Nincs találat a keresési feltételre.</div></div>";
        } else {

            echo "<table class='table table-dark table-hover table-striped'>
        <tr class='thead-dark'>
            <th class='text-info'>ID</th>
            <th class='text-info'><a href='felhasznalok_managelese.php?sort=nevszerint&ascdesc=$ascdesc'>Név</a></th>
            <th class='text-info'><a href='felhasznalok_managelese.php?sort=osztalyszerint&ascdesc=$ascdesc'>Osztály</a></th>
            <th class='text-info'><a href='felhasznalok_managelese.php?sort=beosztasszerint&ascdesc=$ascdesc'>Beosztás</a></th>
            <th colspan='2' class='text-center text-info'>Opciók</th>
        </tr>";


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='eger'>";
                    echo "<td>" . $row['ID'] . "</td>" .
                        "<td>" . $row['Nev'] . "</td>" .
                        "<td>" . $row['Osztaly'] . "</td>" .
                        "<td>" . $row['Beosztas'] . "</td>";

                    if($_SESSION['admin']=="no") {
                        echo "<td></td>";
                    }else {
                        echo "<td><a class=\"badge badge-light\"  href='edit_user.php?id=" . $row['ID'] . "' >Szerkesztés</a></td>" .
                            "<td><a class=\"badge badge-danger\"  href='delete_user.php?id=" . $row['ID'] . "'>Törlés</a></td>";
                    }
                    echo "</tr>";
                }
            }
        }
        ?>
    </table>
    <br>

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
