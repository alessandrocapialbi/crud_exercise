$(document).ready(function () {


    $("#worktable").animate({right: '25%'}, 1500); //These lines animate the two tables of the page.
    $("#sculptable").animate({left: '68%'}, 1500);

    $('#my_select').prop('selectedIndex', 0); //This one sets the select index to 0, so you can choose freely.


    $("#my_select").change(function () { /*This function is called when the select with options museum and artist
        changes to understand if the user wants to run a query by a museum or an artist.*/

        var type_value = $("#my_select option:selected").text();

        if (type_value == 'Museum') {

            $.ajax({ /*If the user chooses by museum, this AJAX request prints a new select with all the museumus
            that are inside the museum database. */
                url: '../php/phpquery.php',
                data: {action: 'museum'},
                type: 'post',
                success: function (output) {
                    $("#db_container").empty();
                    $("#db_container").append(output);
                }
            });

            $('[name = "mus_name"]').hide(); //It hides all the fields with the musuem name and shows artist's surnames.
            $('[name = "museum_name"]').hide();
            $('[name = "artist_surname"]').show();
            $('[name = "a_surname"]').show();
        } else {

            $.ajax({ //Second case, if the user chooses to run a query by artists.
                url: '../php/phpquery.php',
                data: {action: 'artist'},
                type: 'post',
                success: function (output) {
                    $("#db_container").empty();
                    $("#db_container").append(output);
                }
            });
            $('[name = "mus_name"]').show();
            $('[name = "museum_name"]').show();
            $('[name = "artist_surname"]').hide();
            $('[name = "a_surname"]').hide();

        }

        $('[name = "par1"]').val(type_value); //It saves the type value in order to get them inside phpquery.php.
        $('[name = "par3"]').val(type_value);

    });

    $("#workqueryform")[0].reset(); //All the form fields are being reset.
    $("#sculpqueryform")[0].reset();

});


    