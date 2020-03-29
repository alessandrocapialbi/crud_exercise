$(document).ready(function () {


    $("#worktable").animate({right: '25%'}, 1500);
    $("#sculptable").animate({left: '68%'}, 1500);

    $('#my_select').prop('selectedIndex', 0);


    $("#my_select").change(function () {

        var type_value = $("#my_select option:selected").text();

        if (type_value == 'Museum') {

            $.ajax({
                url: '../php/phpquery.php',
                data: {action: 'museum'},
                type: 'post',
                success: function (output) {
                    $("#db_container").empty();
                    $("#db_container").append(output);
                }
            });

            $('[name = "mus_name"]').hide();
            $('[name = "museum_name"]').hide();
            $('[name = "artist_surname"]').show();
            $('[name = "a_surname"]').show();
        } else {

            $.ajax({
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

        $('[name = "par1"]').val(type_value);
        $('[name = "par3"]').val(type_value);

    });

    $("#workqueryform")[0].reset();
    $("#sculpqueryform")[0].reset();

});


    