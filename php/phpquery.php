<!DOCTYPE html>
<html>
<head>
    <title>PHP Query</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>

<?php


if (isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch ($action) {
        case 'museum' :
            getMuseums();
            break;
        case 'artist':
            getArtists();
            break;
    }
}

/*These two functions get the db values, museums or artist. These are called when the main select of query.html
changes, so when the user choose between Museum or Artist.*/
function getMuseums()
{

    $conn = @mysqli_connect('localhost:3306', 'root', '', 'musei') or die ('Cannot connect to db');
    echo "<select id = mus_select>"; //It prints a new select with the db museums values.
    echo "<option></option>";
    $result = @mysqli_query($conn, "SELECT museum_name FROM museums");
    if (!$result)
        echo "Error: " . mysqli_error($conn) . "<br><br>";
    else {

        if (mysqli_num_rows($result) != 0) {

            while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                echo '<option value="' . $row[0] . '">' . $row[0] . '</option>';
            }
            echo "</select>";
        }
    }
    @mysqli_close($conn);
}

function getArtists()
{

    $conn = @mysqli_connect('localhost:3306', 'root', '', 'musei') or die ('Cannot connect to db');
    echo "<select id = art_select>"; //It prints a new select with the db artists values.
    echo "<option></option>";
    $result = @mysqli_query($conn, "SELECT artist_surname FROM artists");
    if (!$result)
        echo "Error: " . mysqli_error($conn) . "<br><br>";
    else {

        if (mysqli_num_rows($result) != 0) {

            while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                echo '<option value="' . $row[0] . '">' . $row[0] . '</option>';
            }
            echo "</select>";
        }
    }
    @mysqli_close($conn);
}

?>

<script type="text/javascript">

    $("#mus_select").change(function () {

        var mus_value = $("#mus_select option:selected").text();
        $('[name = "par2"]').val(mus_value);
        $('[name = "par4"]').val(mus_value); //These ones saves the museum's value (like Louvre, Uffizi...).

    });

    $("#art_select").change(function () {

        var art_value = $("#art_select option:selected").text();
        $('[name = "par2"]').val(art_value);
        $('[name = "par4"]').val(art_value); //These ones saves the artist's value (like Da Vinci, Buonarroti...).

    })
</script>

</body>
</html>