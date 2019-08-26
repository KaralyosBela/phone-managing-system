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
$id = $_GET['id'];

$sql = "SELECT * FROM felhasznalok WHERE ID='$id'";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

if (isset($_POST['yes'])) {
    $sql = "UPDATE telefon SET User_id = NULL WHERE User_id=$id";
    $connection->query($sql);
    $sql = "DELETE FROM felhasznalok WHERE ID = '" . $id . "'";
    $connection->query($sql);
    header('Location: felhasznalok_managelese.php');
} else if (isset($_POST['no'])) {
    header('Location: felhasznalok_managelese.php');
}

?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>Delete user</title>
</head>

<body class="bg-dark">


<div class="container-fluid mt-5">
    <div class="row">
    <div class="col"></div>
    <div class="col-lg-4 col-md-5 col-sm-6">
        <form method="post">
            <h4 class="text-center m-3 text-light">Biztosan törlöd a(z) *<?php echo $row['Nev']; ?>* nevű dolgozót?</h4>
            <div class="form-row">
                <div class="col"><button type="submit" class="btn btn-danger btn-block" name="yes" value="yes">Igen</button></div>
                <div class="col"><button type="submit" class="btn btn-info btn-block" name="no" value="no">Nem</button></div>
            </div>
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

