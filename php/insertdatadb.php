<!DOCTYPE html>
<html>
<head>
    <title>Creating the database</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</head>
<body style="background-image: url('../images/primavera.jpg'); background-position: center center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;">

<?php

$query = '';

//These functions insert data into the four tables of the DB when the user submits the form of insertions.html.

function putIntoMuseums()
{

    $name = $_POST['name'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $man_name = $_POST['man_name'];
    $man_surname = $_POST['man_surname'];

    $sql = "INSERT INTO museums (museum_name, city, address, man_name, man_surname) VALUES ('$name', '$city', '$address', '$man_name', '$man_surname')";

    return $sql;
}

function putIntoArtists()
{

    $artistName = $_POST['art_name'];
    $artistSurname = $_POST['art_surname'];
    $country = $_POST['country'];
    $dateOfBirth = $_POST['dob'];
    $dateOfDeath = $_POST['dod'];

    if ($dateOfDeath == '') {

        $sql = "INSERT INTO artists (artist_name, artist_surname, country, date_of_birth) VALUES ('$artistName', '$artistSurname', '$country', '$dateOfBirth')";
    } else {

        $sql = "INSERT INTO artists (artist_name, artist_surname, country, date_of_birth, date_of_death) VALUES ('$artistName', '$artistSurname', '$country', '$dateOfBirth', '$dateOfDeath')";

    }

    return $sql;
}

function putIntoWorks()
{

    $workName = $_POST['work_name'];
    $museum_name = $_POST['mus_name'];
    $artist_name = $_POST['artist_name'];
    $artist_surname = $_POST['artist_surname'];
    $painting = $_POST['painting'];
    $size = $_POST['size'];

    $sql = "INSERT INTO works (work_name, mus_name, artist_name, artist_surname, painting_type, size) VALUES ('$workName', '$museum_name', '$artist_name', '$artist_surname', '$painting', '$size')";

    return $sql;
}

function putIntoSculptures()
{

    $sculptureName = $_POST['sculpture_name'];
    $mus_name = $_POST['museum_name'];
    $art_name = $_POST['a_name'];
    $art_surname = $_POST['a_surname'];
    $material = $_POST['material'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];

    $sql = "INSERT INTO sculptures (sculpture_name, museum_name, art_name, art_surname, material, height, weight) VALUES ('$sculptureName', '$mus_name', '$art_name', '$art_surname', '$material', '$height', '$weight')";

    return $sql;

}


$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = '';
$db = 'musei';
$conn = @mysqli_connect($dbhost, $dbuser, $dbpass, $db);


if (isset($_POST['putmuseum'])) {

    $query = putIntoMuseums();
} else if (isset($_POST['putartist'])) {

    $query = putIntoArtists();

} else if (isset($_POST['putwork'])) {


    $query = putIntoWorks();

} else {

    $query = putIntoSculptures();

}

if (@mysqli_query($conn, $query))
    echo "<h1 style='color: white'>Data pushed.</h1>";
else
    echo "<h1 style='color: white'> Error : " . mysqli_error($conn) . "</h1>";

@mysqli_close($conn);
?>

<br>
<button class="btn btn-warning" onClick="location.href = '../html/insertions.html'"> Go back</button>


</body>
</html>