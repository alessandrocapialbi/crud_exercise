<!DOCTYPE html>
<html>
<head>
    <title>Update Database</title>
</head>
<body>

<?php

if (isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch ($action) {
        case 'updateWork' :
            updateWork();
            break;
        case 'updateSculp' :
            updateSculp();
            break;

    }
}

function updateWork()
{

    $sql = "UPDATE works SET ";

    $conn = @mysqli_connect('localhost:3306', 'root', '', 'musei') or die ('Cannot connect to db');
    if (isset($_POST['workName'])) {

        $sql .= 'work_name = "' . $_POST['workName'] . '", ';
    }
    if (isset($_POST['musName'])) {

        $sql .= 'mus_name = "' . $_POST['musName'] . '", ';
    }
    if (isset($_POST['artName'])) {

        $sql .= 'artist_name = "' . $_POST['artName'] . '", ';
    }
    if (isset($_POST['artSurname'])) {

        $sql .= 'artist_surname = "' . $_POST['artSurname'] . '", ';
    }
    if (isset($_POST['painting'])) {

        $sql .= 'painting_type = "' . $_POST['painting'] . '", ';
    }

    $sql = rtrim($sql, ", ");

    $sql .= ' WHERE work_name = "' . $_POST['WorkId'] . '";';


    if (@mysqli_query($conn, $sql)) {
        echo "Update successful";
    } else
        echo "Error" . mysqli_error($conn);
}


function updateSculp()
{

    $sql = "UPDATE sculptures SET ";

    $conn = @mysqli_connect('localhost:3306', 'root', '', 'musei') or die ('Cannot connect to db');
    if (isset($_POST['sculpName'])) {

        $sql .= 'sculpture_name = "' . $_POST['sculpName'] . '", ';
    }
    if (isset($_POST['musName'])) {

        $sql .= 'museum_name = "' . $_POST['musName'] . '", ';
    }
    if (isset($_POST['artName'])) {

        $sql .= 'art_name = "' . $_POST['artName'] . '", ';
    }
    if (isset($_POST['artSurname'])) {

        $sql .= 'art_surname = "' . $_POST['artSurname'] . '", ';
    }
    if (isset($_POST['material'])) {

        $sql .= 'material = "' . $_POST['material'] . '", ';
    }
    if (isset($_POST['height'])) {

        $sql .= 'height = "' . $_POST['height'] . '", ';
    }
    if (isset($_POST['weight'])) {

        $sql .= 'weight = "' . $_POST['weight'] . '", ';
    }

    $sql = rtrim($sql, ", ");

    $sql .= ' WHERE sculpture_name = "' . $_POST['sculpId'] . '";';


    if (@mysqli_query($conn, $sql)) {
        echo "Update successful";
    } else
        echo "Error" . mysqli_error($conn);

    @mysqli_close($conn);
}

    
?>

</body>
</html>