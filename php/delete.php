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
        case 'deleteWork' :
            deleteWork();
            break;
        case 'deleteSculp' :
            deleteSculp();
            break;

    }
}

function deleteWork()
{

    $conn = @mysqli_connect('localhost:3306', 'root', '', 'musei') or die ('Cannot connect to db');

    $workName = $_POST['workName'];

    $sql = "DELETE FROM works WHERE work_name = '$workName'";

    if (@mysqli_query($conn, $sql)) {
        echo "Delete successful";
    } else
        echo "Error" . mysqli_error($conn);
}

function deleteSculp()
{

    $conn = @mysqli_connect('localhost:3306', 'root', '', 'musei') or die ('Cannot connect to db');

    $sculpName = $_POST['sculpName'];

    $sql = "DELETE FROM sculptures WHERE sculpture_name = '$sculpName'";

    if (@mysqli_query($conn, $sql)) {
        echo "Delete successful";
    } else
        echo "Error" . mysqli_error($conn);


    @mysqli_close($conn);
}

?>

</body>
</html>