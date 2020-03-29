<!DOCTYPE html>
<html>
<head>
    <title>Check if DB exists</title>
</head>
<body>

<?php


if (isset($_POST['db']) && !empty($_POST['db'])) {
    $action = $_POST['db'];
    switch ($action) {
        case 'isdb' :
            checkDB();
            break;
        case 'other' :
            echo "Nothing";
            break;
    }
}

function checkDB()
{

    $dbhost = 'localhost:3306';
    $dbuser = 'root';
    $dbpass = '';

    $conn = @mysqli_connect($dbhost, $dbuser, $dbpass) or die ('Cannot connect to general DB');

    $result = @mysqli_query($conn, "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'musei'");

    if (!$result)
        echo "Error: " . mysqli_error($conn) . "<br><br>";
    else {

        if (mysqli_num_rows($result) != 0)

            echo "true";

        else

            echo "false";
    }

    @mysqli_close($conn);

}


?>
</body>
</html>