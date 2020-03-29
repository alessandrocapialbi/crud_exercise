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
        case 'deleteWork' : //If the user is deleting a work row.
            deleteWork();
            break;
        case 'deleteSculp' :
            deleteSculp(); //If the user is deleting a sculpture row.
            break;

    }
}

function deleteWork()
{

    $conn = @mysqli_connect('localhost:3306', 'root', '', 'musei') or die ('Cannot connect to db');

    $workName = $_POST['workName']; //This is the PRIMARY KEY of db.

    $sql = "DELETE FROM works WHERE work_name = '$workName'"; /*It deletes the row where the PRIMARY KEY is what is
    inside the table field of query.html*/
    if (@mysqli_query($conn, $sql)) {
        echo "Delete successful";
    } else
        echo "Error" . mysqli_error($conn);
}

function deleteSculp()
{

    //Same process for sculptures.

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