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

if ($_POST) {

    if (!empty($_POST['imei']) && !empty($_POST['telefon_tipus']) && !empty($_POST['vasarlas_datum']) && !empty($_POST['garancia_lejarata'])) {


        if (isset($_POST['user_add'])) {
            $imei = $_POST['imei'];
            $telefon_tipus = $_POST['telefon_tipus'];
            $vasarlas_datum = $_POST['vasarlas_datum'];
            $garancia_lejarata = $_POST['garancia_lejarata'];
            if (empty($_POST['ceges'])) $ceges = 0; else $ceges = 1;

            $sql = "SELECT ID FROM felhasznalok WHERE Nev = '" . $_POST['user_add'] . "'";
            $result = $connection->query($sql);
            $row = $result->fetch_assoc();
            $id = $row['ID'];
            $sql = "INSERT INTO telefon (imei, User_id, Telefon_tipus, Vasarlas_datuma, Garancia, Kiadas, Visszavetel, Sajat ) 
                VALUES ('$imei', $id, '$telefon_tipus', '$vasarlas_datum', '$garancia_lejarata', NOW(), NULL, $ceges)";
            $connection->query($sql);
            header('Location: telefonok_managelese.php');


        } else {

            $imei = $_POST['imei'];
            $telefon_tipus = $_POST['telefon_tipus'];
            $vasarlas_datum = $_POST['vasarlas_datum'];
            $garancia_lejarata = $_POST['garancia_lejarata'];
            if (empty($_POST['ceges'])) $ceges = 0; else $ceges = 1;

            $sql = "INSERT INTO telefon (imei, User_id, Telefon_tipus, Vasarlas_datuma, Garancia, Kiadas, Visszavetel, Sajat ) 
                VALUES ('$imei', NULL, '$telefon_tipus', '$vasarlas_datum', '$garancia_lejarata', NULL, NULL, $ceges)";
            $connection->query($sql);
            header('Location: telefonok_managelese.php');

        }
    }


}

?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>Telefon hozzáadása</title>
</head>

<body class="bg-dark text-light">

<div class="container-fluid">
    <div class="row">
        <div class="col"></div>
        <div class="col-lg-4 col-md-5 col-sm-6 mt-3">
            <form method="post">
                <div class="form-group">
                    <label for="">IMEI szám*</label>
                    <input type="text" class="form-control" id="" name="imei">
                </div>
                <div class="form-group">
                    <label for="">Telefon típusa*</label>
                    <input type="text" class="form-control" id="" name="telefon_tipus">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">Vásárlás dátuma*</label>
                        <input type="date" class="form-control" id="" name="vasarlas_datum">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Garancia lejárata*</label>
                        <input type="date" class="form-control" id="" name="garancia_lejarata">
                    </div>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="ceges" name="ceges" checked>
                    <label class="form-check-label" for="defaultCheck1">
                        Céges telefon
                    </label>
                </div>
                <?php
                $sql = "SELECT Nev FROM felhasznalok";
                $result = $connection->query($sql);

                echo "<label>Telefon kiadás dolgozónak (opcinális)</label>";
                echo "<select name='user_add' class='form-control'>";
                echo "<option disabled selected value> -- Felhasználó választása -- </option>";
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['Nev'] . "'>" . $row['Nev'] . "</option>";
                }
                echo "</select><br>";
                ?>

                <button type="submit" class="btn btn-info btn-block" name="submit">Hozzáad</button>
                <a href="telefonok_managelese.php" class="btn-danger btn btn-block">Vissza</a>
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
