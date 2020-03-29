<!DOCTYPE html>
<html>
<head>
    <title>Check if DB exists</title>
</head>
<body>

<?php

//This file checks if museum database exists or not.

if (isset($_POST['db']) && !empty($_POST['db'])) { //It reads the value from the call of the AJAX function inside musei.html
    $action = $_POST['db'];
    switch ($action) {
        case 'isdb' :
            checkDB();
            break;
        case 'other' :
            echo "Error";
            break;
    }
}

function checkDB()
{

    $dbhost = 'localhost:3306';
    $dbuser = 'root';
    $dbpass = '';

    //I connect to db.
    $conn = @mysqli_connect($dbhost, $dbuser, $dbpass) or die ('Cannot connect to general DB');

    //This is a query that checks if musei DB exists.
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