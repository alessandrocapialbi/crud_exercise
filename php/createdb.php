<!DOCTYPE html>
<html>
<head>
    <title>Creating the database</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

</head>
<body style="background-image: url('../images/ultimacena.jpg'); background-position: center center;
	background-repeat: no-repeat;
	background-attachment: fixed;
	background-size: cover;">

<?php

$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = '';
$db = 'musei';


//These four lines creates the tables inside db.

$museums = "CREATE TABLE museums (museum_name varchar(40), city varchar(30) NOT NULL, address varchar(30) NOT NULL, man_name varchar(30), man_surname varchar(30), PRIMARY KEY(museum_name))";
$artists = "CREATE TABLE artists (artist_name varchar(30), artist_surname varchar(30), country varchar(20) NOT NULL, date_of_birth date NOT NULL, date_of_death date, PRIMARY KEY(artist_name, artist_surname))";
$works = "CREATE TABLE works (work_name varchar(40), mus_name varchar(40), artist_name varchar(30), artist_surname varchar(30), painting_type varchar(20), size varchar (20), FOREIGN KEY(mus_name) REFERENCES museums(museum_name), FOREIGN KEY(artist_name) REFERENCES artists(artist_name), FOREIGN KEY(artist_surname) REFERENCES artists(artist_surname), PRIMARY KEY(work_name))";
$sculptures = "CREATE TABLE sculptures (sculpture_name varchar(40), museum_name varchar(40), art_name varchar(30), art_surname varchar(30), material varchar (20), height int, weight int, FOREIGN KEY(museum_name) REFERENCES museums(museum_name), FOREIGN KEY(art_name) REFERENCES artists(artist_name), FOREIGN KEY(art_surname) REFERENCES artists(artist_surname), PRIMARY KEY(sculpture_name))";

$tables = [
    'museums' => $museums,
    'artists' => $artists,
    'works' => $works,
    'sculptures' => $sculptures
]; //This is an associative array to save all the commands to create the tables.

$conn = @mysqli_connect($dbhost, $dbuser, $dbpass);

if (!$conn) {
    echo 'Connected failure<br>';
}

$sql = "CREATE DATABASE musei";
if (@mysqli_query($conn, $sql))
    echo "<h1 style='color: white'>Database created successfully!</h1>";
else
    echo "<h2 style='color: white'>Error creating database: " . mysqli_error($conn) . "</h2>";


$conn = @mysqli_connect($dbhost, $dbuser, $dbpass, $db);

foreach ($tables as $k => $sql) { //This loop runs a query for each array value (that are the instructions to create tables).
    $key = array_search($sql, $tables);
    if (@mysqli_query($conn, $sql))
        echo "<h3 style='color: white'>Table $key created </h3>";
    else
        echo "<h3 style= 'color: white'> Table $key not created or already exists. </h3>";
}

@mysqli_close($conn);
?>
<br>


<button class="btn btn-warning" onClick="location.href = '../html/musei.html'">Go back</button>


</body>
</html>