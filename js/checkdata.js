$(document).ready(function () {

    $("#musform")[0].reset();
    $("#artform")[0].reset();
    $("#workform")[0].reset();
    $("#sculpform")[0].reset();

    $("#mus_table").animate({right: '25%'}, 1500);
    $("#art_table").animate({left: '65%'}, 1500);
    $("#work_table").animate({right: '25%'}, 1500);
    $("#sculp_table").animate({left: '65%'}, 1500);


    $("input:text").keydown(function (e) {

        var key = e.keyCode;
        if (!((key == 8) || (key == 9) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
            e.preventDefault();
        }
    });

    $("#artform").submit(function (e) {

        var dateOfBirth = new Date($('[name = "dob"]').val());
        var dateOfDeath = new Date($('[name = "dod"]').val());

        if (dateOfBirth.getFullYear() >= dateOfDeath.getFullYear()) {

            swal({
                title: "Error!",
                text: "Date of birth cannot be bigger than date of death",
                icon: "error",
                button: "OK!",
            });
            e.preventDefault();
        }

    });

});



