$(document).ready(function () {

    $("#musform")[0].reset(); //Every time the page is refreshed, each form field is being reset.
    $("#artform")[0].reset();
    $("#workform")[0].reset();
    $("#sculpform")[0].reset();

    $("#mus_table").animate({right: '25%'}, 1500); //These commands animate the tables.
    $("#art_table").animate({left: '65%'}, 1500);
    $("#work_table").animate({right: '25%'}, 1500);
    $("#sculp_table").animate({left: '65%'}, 1500);


    $("input:text").keydown(function (e) { /*This is a function that checks if you are typing the right characters
    inside form fields. For example, you cannot type numbers inside a textfield.
    */
        var key = e.keyCode;
        if (!((key == 8) || (key == 9) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
            e.preventDefault(); //It prevents to load the action of the form when the user submits.
        }
    });

    $("#artform").submit(function (e) {

        var dateOfBirth = new Date($('[name = "dob"]').val()); /*It's an object Date, in order to call some methods later
        in the if statement.*/
        var dateOfDeath = new Date($('[name = "dod"]').val());

        if (dateOfBirth.getFullYear() >= dateOfDeath.getFullYear()) { /*This function checks if the date of birth is
         smaller than the date of death, because no one can die before he borns.
        */
            swal({ //This is a plugin to print a customized alert, which is prettier.
                title: "Error!",
                text: "Date of birth cannot be bigger than date of death",
                icon: "error",
                button: "OK!",
            });
            e.preventDefault();
        }

    });

});



