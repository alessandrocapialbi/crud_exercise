<!DOCTYPE html>
<html>
<head>
    <title>Query Response</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</head>
<body style="background-image: url('../images/moon.jpg'); background-position: center center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;">

<div class="container">
    <div class="col-sm-15">

        <?php

        //When one of the two forms of query.html is submitted one of these two function are called.

        if (isset($_POST['workquery'])) {

            $conn = @mysqli_connect('localhost:3306', 'root', '', 'musei') or die ('Cannot connect to db');
            $type_value = $_POST['par1'];
            $workName = $_POST['work_name'];
            $artistName = $_POST['artist_name'];
            $paintingType = $_POST['painting'];
            $sql = "SELECT * FROM works WHERE ";

            /*In the next lines, if statements check what the user typed inside the form fields.
            If the user typed something, it is being added to the SELECT.*/

            switch ($type_value) {
                case 'Museum':
                    $musName = $_POST['par2'];
                    if ($musName != '') {
                        $sql .= 'mus_name = "' . $musName . '" AND ';
                    }
                    $artSurname = $_POST['artist_surname'];
                    if ($artSurname != '') {
                        $sql .= 'artist_surname = "' . $artSurname . '" AND ';
                    }
                    break;
                case 'Artist':
                    $musName = $_POST['mus_name'];
                    if ($musName != '') {
                        $sql .= 'mus_name = "' . $musName . '" AND ';
                    }
                    $artSurname = $_POST['par2'];
                    if ($artSurname != '') {
                        $sql .= 'artist_surname = "' . $artSurname . '" AND ';
                    }
                    break;
            }
            if ($workName != '') {
                $sql .= 'work_name = "' . $workName . '" AND ';
            }
            if ($artistName != '') {
                $sql .= 'artist_name = "' . $artistName . '" AND ';
            }
            if ($paintingType != '') {
                $sql .= 'painting_type = "' . $paintingType . '" AND ';
            }

            $sql = rtrim($sql, 'AND '); //This function delete the final AND to avoid errors.
            $sql .= ";";

            //It prints the work table, which will contain all the query's values.

            echo '<table class="table table-hover" cellpadding="10" id = "workTable">';
            echo '<th colspan="15" style="color: white;">RESULT</th>';
            echo '<tr class="table-primary" style="font-weight: bold;">';
            echo '<td>Work name</td>';
            echo '<td>Museum Name</td>';
            echo '<td>Artist Name</td>';
            echo '<td>Artist surname</td>';
            echo '<td>Painting type</td>';
            echo '<th colspan="2">Actions</th>';
            echo '</tr>';


            $result = @mysqli_query($conn, $sql);
            if (!$result)
                echo "Error: " . mysqli_error($conn) . "<br><br>";
            else {

                if (mysqli_num_rows($result) != 0) {

                    $c = 0;

                    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                        echo '<tr class="table-success" id="workTable"><td>' . $row[0] . '</td>' . '<td>' . $row[1] . '</td>' . '<td>' . $row[2] . '</td>' . '<td>' . $row[3] . '</td>' . '<td>' . $row[4] . '</td>' . '<td><button class="btn btn-primary" onclick = "editWork(this);" id="edit ' . $c . '">EDIT</button></td><td><button class="btn btn-primary" onclick = "deleteWork(this);" id="delete ' . $c . '" >DELETE</button></td></tr>';

                        $c++;
                    }
                    echo "</table>";
                }
            }
            @mysqli_close($conn);

        } else {

            //Same thing for sculptures.

            $conn = @mysqli_connect('localhost:3306', 'root', '', 'musei') or die ('Cannot connect to db');
            $type_value = $_POST['par3'];
            $sculptureName = $_POST['sculpture_name'];
            $artName = $_POST['a_name'];
            $material = $_POST['material'];
            $sql = "SELECT * FROM sculptures WHERE ";


            switch ($type_value) {
                case 'Museum':
                    $mus_name = $_POST['par4'];
                    if ($mus_name != '') {
                        $sql .= 'museum_name = "' . $mus_name . '" AND ';
                    }
                    $artistSurname = $_POST['a_surname'];
                    if ($artistSurname != '') {
                        $sql .= 'art_surname = "' . $artistSurname . '" AND ';
                    }
                    break;
                case 'Artist':
                    $mus_name = $_POST['museum_name'];
                    if ($mus_name != '') {
                        $sql .= 'museum_name = "' . $mus_name . '" AND ';
                    }
                    $artSurname = $_POST['par4'];
                    if ($artSurname != '') {
                        $sql .= 'art_surname = "' . $artSurname . '" AND ';
                    }
                    break;
            }

            if ($sculptureName != '') {
                $sql .= 'sculpture_name = "' . $sculptureName . '" AND ';
            }
            if ($artName != '') {
                $sql .= 'art_name = "' . $artName . '" AND ';
            }
            if ($material != '') {
                $sql .= 'material = "' . $material . '" AND ';
            }

            $sql = rtrim($sql, 'AND ');
            $sql .= ";";

            echo '<table class="table table-hover" cellpadding="10" id="sculpTable">';
            echo '<th colspan="5" style="color: white;">RESULT</th>';
            echo '<tr class="table-danger" style="font-weight: bold;">';
            echo '<td>Sculpture name</td>';
            echo '<td>Museum Name</td>';
            echo '<td>Artist Name</td>';
            echo '<td>Artist surname</td>';
            echo '<td>Material</td>';
            echo '<td>Height</td>';
            echo '<td>Weight</td>';
            echo '<th colspan="2">Actions</th>';
            echo '</tr>';


            $result = @mysqli_query($conn, $sql);
            if (!$result)
                echo "Error: " . mysqli_error($conn) . "<br><br>";

            else {


                if (mysqli_num_rows($result) != 0) {

                    $c = 0;

                    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                        echo '<tr class="table-success"><td>' . $row[0] . '</td>' . '<td>' . $row[1] . '</td>' . '<td>' . $row[2] . '</td>' . '<td>' . $row[3] . '</td>' . '<td>' . $row[4] . '</td>' . '<td>' . $row[5] . '</td>' . '<td>' . $row[6] . '</td>' . '<td><button class="btn btn-primary" onclick = "editSculpture(this);" id="edit ' . $c . '">EDIT</button></td><td><button class="btn btn-primary" onclick = "deleteSculp(this);" id="delete ' . $c . '" >DELETE</button></td></tr>';

                        $c++;
                    }
                    echo "</table>";
                }
            }
            @mysqli_close($conn);

        }


        ?>
    </div>
    <button class="btn btn-warning" onClick="location.href = '../html/query.html'"> Go back</button>
</div>


<script type="text/javascript">

    var orig_work_name;
    var orig_sculp_name;

    var workEdits = {workName: false, musName: false, artName: false, artSurname: false, painting: false};
    var sculpEdits = {
        sculpName: false,
        musName: false,
        artName: false,
        artSurname: false,
        material: false,
        height: false,
        weight: false
    }; //These two arrays let you know if the user changes query's fields.

    function editWork(b) {

        var index = Number(b.id.split(" ")[1]);
        index += 2;
        var x = document.getElementById("workTable").rows[index].cells; //You get the rows of the table.
        var f0 = x[0].innerHTML; //These are the fields of the table. 0 is work name, 1 is museum name...
        var f1 = x[1].innerHTML;
        var f2 = x[2].innerHTML;
        var f3 = x[3].innerHTML;
        var f4 = x[4].innerHTML;
        orig_work_name = f0;

        x[0].innerHTML = '<input type = "text" id = "workName" onchange = "changeWork(this);" name = "input" value ="' + f0 + '">';
        x[1].innerHTML = '<input type = "text" id = "musName"  onchange = "changeWork(this);" name = "input" value ="' + f1 + '">';
        x[2].innerHTML = '<input type = "text" id = "artName"  onchange = "changeWork(this);" name = "input" value ="' + f2 + '">';
        x[3].innerHTML = '<input type = "text" id = "artSurname" onchange = "changeWork(this);" name = "input" value ="' + f3 + '">';
        x[4].innerHTML = '<input type = "text" id = "painting" onchange = "changeWork(this);" name = "input" value ="' + f4 + '">';
        x[5].innerHTML = '<button class="btn btn-success" id = "confirm" name = "input">CONFIRM</button>';

        $('#confirm').click(function () {

            var values = {action: 'updateWork', WorkId: orig_work_name};

            for (key in workEdits) {

                if (workEdits[key]) {

                    values[key] = document.getElementById(key).value; /*If the user changed something, these new
                    values are added.*/
                }
            }
            $.ajax({
                url: '../php/update.php',
                data: values,
                type: 'post',
            }); //It sends all the values to update.php in order to update the work table.

            window.location.reload(); //To see the new changes the page is reloaded.
        });

    }

    function changeWork(input) { /*When the user types something new in the fields, the relative value inside the array
     is set to true.*/
        workEdits[input.id] = true;

    }


    function editSculpture(b) {

        //Same thing for sculptures.

        var index = Number(b.id.split(" ")[1]);
        index += 2;
        var x = document.getElementById("sculpTable").rows[index].cells;
        var f0 = x[0].innerHTML;
        var f1 = x[1].innerHTML;
        var f2 = x[2].innerHTML;
        var f3 = x[3].innerHTML;
        var f4 = x[4].innerHTML;
        var f5 = x[5].innerHTML;
        var f6 = x[6].innerHTML;

        orig_sculp_name = f0;

        x[0].innerHTML = '<input type = "text" id = "sculpName" onchange = "changeSculp(this);" name = "input" value ="' + f0 + '">';
        x[1].innerHTML = '<input type = "text" id = "musName"  onchange = "changeSculp(this);" name = "input" value ="' + f1 + '">';
        x[2].innerHTML = '<input type = "text" id = "artName"  onchange = "changeSculp(this);" name = "input" value ="' + f2 + '">';
        x[3].innerHTML = '<input type = "text" id = "artSurname" onchange = "changeSculp(this);" name = "input" value ="' + f3 + '">';
        x[4].innerHTML = '<input type = "text" id = "material" onchange = "changeSculp(this);" name = "input" value ="' + f4 + '">';
        x[5].innerHTML = '<input type = "text" id = "height" onchange = "changeSculp(this);" name = "input" value ="' + f5 + '">';
        x[6].innerHTML = '<input type = "text" id = "weight" onchange = "changeSculp(this);" name = "input" value ="' + f6 + '">';

        x[7].innerHTML = '<button class="btn btn-success" id = "conf" name = "input" >CONFIRM</button>';

        $('#conf').click(function () {

            var values = {action: 'updateSculp', sculpId: orig_sculp_name};

            for (key in sculpEdits) {

                if (sculpEdits[key]) {

                    values[key] = document.getElementById(key).value;

                }
            }
            $.ajax({
                url: '../php/update.php',
                data: values,
                type: 'post',
            });

            window.location.reload();

        });

    }

    function changeSculp(input) {

        sculpEdits[input.id] = true;

    }

    function deleteWork(b) { //These two last functions delete a selected row of the table from the database.

        var index = Number(b.id.split(" ")[1]);
        index += 2;
        var x = document.getElementById("workTable").rows[index].cells;
        var f0 = x[0].innerHTML;

        $.ajax({
            url: '../php/delete.php',
            data: {action: 'deleteWork', workName: f0},
            type: 'post',
        });

        window.location.reload();
    }

    function deleteSculp(b) {

        var index = Number(b.id.split(" ")[1]);
        index += 2;
        var x = document.getElementById("sculpTable").rows[index].cells;
        var f0 = x[0].innerHTML;

        $.ajax({
            url: '../php/delete.php',
            data: {action: 'deleteSculp', sculpName: f0},
            type: 'post',
        });

        window.location.reload();
    }


</script>

</body>
</html>