<?php
session_start();
$_SESSION['loggedin'] = "no";

include "Connection.php";
global $row;

if ($_POST) {
    if (isset($_POST['submit'])) {
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $sql = "SELECT * FROM admin WHERE felhasznalonev = '" . $_POST['username'] . "' AND jelszo = '" . $_POST['password'] . "'";
            $result = $connection->query($sql);
            $row = $result->fetch_assoc();
            $admine = $row['admine'];
            reset($result);
            $row = $result->num_rows;
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
    <title>Bejelentkezés</title>

</head>

<body class="text-light bg-dark">

<div class="jumbotron jumbotron-fluid bg-dark">
    <div class="container">
        <h1 class="display-4 text-light text-center">Keter telefon nyilvántartás</h1>
        <p class="lead text-light text-center">Dolgozók, telefonok illetve SIM kártyák hozzáadása, szerkesztése, törlése valamint ezek összekapcsolása</p>
    </div>
</div>

<div class="container ">
    <div class="row">
        <div class="col">
        </div>
        <div class="col-lg-4 col-md-5 col-sm-6">
            <form method="post"">
                <div class="form-group">
                    <input type="text" class="form-control text-center" id="exampleInputEmail1" name="username" placeholder="Felhasználónév">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control text-center" id="exampleInputPassword1" name="password" placeholder="Jelszó">
                </div>
                <button type="submit" class="btn btn-info btn-block" name="submit">Bejelentkezés</button>
                <?php
                if ($_POST) {
                    if ($row == 1 && $admine == 1) {
                        $_SESSION['loggedin'] = "yes";
                        $_SESSION['admin'] = "yes";
                        header('Location: fooldalbootstrap.php');
                    } else if ($row == 1 && $admine == 0) {
                        $_SESSION['loggedin'] = "yes";
                        $_SESSION['admin'] = "no";
                        header('Location: fooldalbootstrap.php');
                    } else {
                        echo "<div class=\"alert alert-info mt-3 text-center\" role=\"alert\">Hibás felhaszálónév/jelszó!</div>";
                    }
                }
                ?>

            </form>
        </div>
        <div class="col">
        </div>
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
