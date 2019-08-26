<?php

include "Connection.php";
$id = $_GET['id'];
$telimei = $_GET['telimei'];
$sql = "SELECT * FROM felhasznalok LEFT JOIN telefon ON felhasznalok.ID = telefon.User_id LEFT JOIN sim ON telefon.imei = sim.Telefon_IMEI WHERE felhasznalok.ID = $id AND telefon.imei = $telimei";
$result = $connection->query($sql);
$row = $result->fetch_assoc();
?>


<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <style>
        body {
            background: rgb(204, 204, 204);
        }

        page {
            background: white;
            display: block;
            margin: 0 auto;
        }

        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
        }

    </style>
</head>

<page size="A4">
    <body>
    <div class="container-fluid">
        <div class="row bg-light">
            <div class="col h3 my-3 text-left">
            KETER Hungary Kft
            </div>
            <div class="col h3 my-3 text-right">
            IT Department Ebes
            </div>
        </div>
        <div class="row bg-light">
            <div class="col h3 my-3 text-left">
            </div>
            <div class="col my-3 text-right">
                KETER Hungary Kft<br>
                H-4211 Ebes, Zsong Völgy 2.<br>
                Tel.: +36 52 565 900
                Fax: +36 52 565 998<br>
                E-mail: Jozsef.Dobrik@keter.com<br>
            </div>
        </div>
        <div class="row bg-light">
            <div class="col h3 text-center mt-5">
                Acceptance certificate about Mobil phone.
            </div>
        </div>
        <div class="row bg-light">
            <div class="col h3 text-center mb-5">
                Átvételi elismervény mobil telefonról.
            </div>
        </div>
        <table class="table table-light table-hover table-striped table-bordered">
            <tbody>
            <tr>
                <td>Phone User:</td>
                <td><?php echo $row['Nev']; ?></td>
            </tr>
            <tr>
                <td>Phone number:</td>
                <td><?php echo $row['Telefonszam']; ?></td>
            </tr>
            <tr>
                <td>Phone type:</td>
                <td><?php echo $row['Telefon_tipus']; ?></td>
            </tr>
            <tr>
                <td>Phone serial number:</td>
                <td><?php echo $row['imei']; ?></td>
            </tr>
            <tr>
                <td>Sim card serial number:</td>
                <td><?php echo $row['IMEI']; ?></td>
            </tr>
            <tr>
                <td>Internet:</td>
                <td><?php $x = ($row['Internet'] == 1) ? 'Yes' :  'No'; echo $x?></td>
            </tr>
            <tr>
                <td>Department:</td>
                <td><?php echo $row['Osztaly']; ?></td>
            </tbody>
        </table>
        <div class="row bg-light">
            <div class="col my-5 text-left">
                <?php echo date('l, F t Y'); ?>
            </div>
            <div class="col my-5 text-right">
                <hr>
                <div class="text-center">Signature</div>
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
</page>
</html>

