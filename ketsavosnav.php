<?php
session_start();

if ($_SESSION['loggedin'] == "no") {
    header('Location: index.php');
    exit;
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
            /*background-color: rgba(40,166,69,0.56);*/
            cursor: pointer;
        }
        .navbar-dark .navbar-nav .active>.nav-link {
            color: rgb(23, 161, 183);
            /*color: rgb(27, 187, 65);*/
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
        <div class="flex-column">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="fooldalbootstrap.php">Lekérdezések <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#.php">Dolgozók</a>
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
            <ul class="navbar-nav">
                <form method="post" class="form-inline my-2 my-lg-0" action="telefondolgozonak.php ">
                    <button class="btn btn-info my-2 my-sm-0 mr-2" type="submit">Telefon kiadása dolgozónak</button>
                </form>
                <form method="post" class="form-inline my-2 my-lg-0" action="add_user.php">
                    <button class="btn btn-info my-2 my-sm-0" type="submit">Új dolgozó hozzáadása</button>
                </form>
            </ul>
        </div>
    </div>
</nav>

<form method="post" class="mb-0">
    <div class="container-fluid bg-secondary pt-3 mt-0">
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
                <button type="submit" class="btn btn-info btn-block" name="submit">Keresés</button>
            </div>
        </div>
    </div>
</form>

<div class="table-responsive">

    <?php
    include "Connection.php";

    $sql = "SELECT * from Felhasznalok";
    $result = $connection->query($sql);

    echo "<table class='table table-dark table-hover table-striped'>";
    echo "<tr class='thead-dark'>
<th class='text-info'>ID</th>
<th class='text-info'>Név</th>
<th class='text-info'>Osztály</th>
<th class='text-info'>Beosztás</th>
<th colspan='2' class='text-center text-info'>Opciók</th></tr>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr class='eger'>";
            echo "<td>" . $row['ID'] . "</td>" .
                "<td>" . $row['Nev'] . "</td>" .
                "<td>" . $row['Osztaly'] . "</td>" .
                "<td>" . $row['Beosztas'] . "</td>" .
                "<td><a class=\"badge badge-light\"  href='edit_user.php?id=" . $row['ID'] . "'>Szerkesztés</a></td>" .
                "<td><a class=\"badge badge-danger\"  href='delete_user.php?id=" . $row['ID'] . "'>Törlés</a></td>";
            echo "</tr>";
        }
    }
    echo "</table><br>";
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
