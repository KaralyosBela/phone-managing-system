<?php
session_start();
include "Connection.php";

if ($_SESSION['loggedin'] == "no") {
    header('Location: index.php');
    exit;
}

$ascdesc = "";
$ascdesc = isset($_GET['ascdesc'])?$_GET['ascdesc']:'DESC';
switch(strtoupper($ascdesc))
{
    case 'DESC': $ascdesc = 'ASC'; break;
    case 'ASC': $ascdesc = 'DESC'; break;
    default: $ascdesc = 'DESC'; break;
}
echo $ascdesc;
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


<div class="table-responsive">

    <table class='table table-dark table-hover table-striped'>
        <tr class='thead-dark'>
            <th class='text-info'>ID</th>
            <th class='text-info'><a href='ascdesc.php?sort=nevszerint&ascdesc=<?php echo $ascdesc; ?>'>Név</a></th>
            <th colspan='2' class='text-center text-info'>Opciók</th>
        </tr>



        <?php
        include "Connection.php";
        $sql = "SELECT * FROM felhasznalok";

        if ($_GET) {

            if ($_GET['sort'] == 'nevszerint') {
                $sql .= " ORDER BY Nev $ascdesc";
            }
        }

        $result = $connection->query($sql);
        if ($result->num_rows == 0) {
            echo "<div class=\"container-fluid\"><div class=\"alert alert-info mt-3 text-center\" role=\"alert\">Nincs találat a keresési feltételre.</div></div>";
        } else {

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='eger'>";
                    echo "<td>" . $row['ID'] . "</td>" .
                        "<td>" . $row['Nev'] . "</td>" .
                        "<td>" . $row['Osztaly'] . "</td>" .
                        "<td>" . $row['Beosztas'] . "</td>";
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
