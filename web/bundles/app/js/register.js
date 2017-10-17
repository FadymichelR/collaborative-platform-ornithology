$(function() {
    //color the given input border differently depending on the validity of its value
    function colorBorders(field, valid) {
        if(valid) {
            field.parent().removeClass('has-error').addClass('has-success');
        }
        else{
            field.parent().removeClass('has-success').addClass('has-error');
        }
    }

    function validateName(name) {
        //ok for 2+ caracters, including letters (+ strange ones) ans some symbols
        var re = /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,}$/;

        return re.test(name);
    }

    function validateEmail(email) {
        //Yes, I know. I didn't write this regex. But I studied it. And it's beautiful. So I'm keeping it.
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        return re.test(email);
    }

    function validatePassword(pass) {
        //ok for 2+ caracters, including letters (+ strange ones), numbers and symbols
        var re = /^[A-Za-z\dàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð\W_]{2,}$/i;

        return re.test(pass);
    }

    //attach a live checking event to every input
    function liveCheckInputs(inputObjects) {
        inputObjects.firstName.on('keyup', function() {
            //if the current value of the field is ok
            if (validateName(inputObjects.firstName.val())) {
                colorBorders(inputObjects.firstName, true);
            }
            else {
                colorBorders(inputObjects.firstName, false);
            }
        });

        inputObjects.surname.on('keyup', function() {
            //if the current value of the field is ok
            if (validateName(inputObjects.surname.val())) {
                colorBorders(inputObjects.surname, true);
            }
            else {
                colorBorders(inputObjects.surname, false);
            }
        });

        inputObjects.email.on('keyup', function() {
            //if the current value of the field is ok
            if (validateEmail(inputObjects.email.val())) {
                colorBorders(inputObjects.email, true);
            }
            else {
                colorBorders(inputObjects.email, false);
            }
        });

        inputObjects.password_first.on('keyup', function() {
            //if the current value of the field is ok
            if (validatePassword(inputObjects.password_first.val())) {
                colorBorders(inputObjects.password_first, true);
            }
            else {
                colorBorders(inputObjects.password_first, false);
            }
        });

        inputObjects.password_second.on('keyup', function() {
            //if the current value of the field is ok
            if (inputObjects.password_second.val() === inputObjects.password_first.val()) {
                colorBorders(inputObjects.password_second, true);
            }
            else {
                colorBorders(inputObjects.password_second, false);
            }
        });
    }







    //Manage everything form related
    function formManagement() {
        //For easy access to each input field
        var inputObjects = {
            'firstName': $('#fos_user_registration_form_firstName'),
            'surname': $('#fos_user_registration_form_surname'),
            'email': $('#fos_user_registration_form_email'),
            'password_first': $('#fos_user_registration_form_plainPassword_first'),
            'password_second': $('#fos_user_registration_form_plainPassword_second')
        };

        //We attach events to each inputs livechecking their status
        liveCheckInputs(inputObjects);
    }




    


    //Start it all on DOM load
    formManagement();
});
