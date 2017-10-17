$(function() {
    function colorBorders(field, valid) {
        if(valid) {
            field.parent().removeClass('has-error').addClass('has-success');
        }
        else{
            field.parent().removeClass('has-success').addClass('has-error');
        }

        console.log(valid);
    }

    function validateName(name) {
        var re = /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,}$/;
        console.log(re.test(name));
        return re.test(name);
    }

    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    function validatePassword(pass) {
        var re = /^[A-Za-z\dàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð\W_]{2,}$/i;

        return re.test(pass);
    }

    function liveCheckInputs(inputObjects) {
        inputObjects.name.on('keyup', function() {
            if (validateName(inputObjects.name.val())) {
                colorBorders(inputObjects.name, true);
            }
            else {
                colorBorders(inputObjects.name, false);
            }
            console.log(inputObjects.name.val());
        });

        inputObjects.message.on('keyup', function() {
            if (validateName(inputObjects.message.val())) {
                colorBorders(inputObjects.message, true);
            }
            else {
                colorBorders(inputObjects.message, false);
            }
        });

        inputObjects.email.on('keyup', function() {

            if (validateEmail(inputObjects.email.val())) {
                colorBorders(inputObjects.email, true);
            }
            else {
                colorBorders(inputObjects.email, false);
            }
        });
    }

    function formManagement() {
        var inputObjects = {
            'name': $('#contact_name'),
            'email': $('#contact_email'),
            'subject': $('#contact_subject'),
            'message': $('#contact_message')
        };
        liveCheckInputs(inputObjects);
    }
    formManagement();
});