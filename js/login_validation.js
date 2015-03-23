
jQuery(function ($) {
    //alert("AB");
    $('#login_form').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        onkeyup: false,
        rules: {
            uname: {
                required: true,
                minlength: 5
            },
            password: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            uname: {
                required: "Please provide a valid userID.",
                minlength: "User id should be more than 5 characters"
            },
            password: {
                required: "Please specify a password.",
                minlength: "Password must be more than 8 characters length."
            }

        },
        showErrors: function (errorMap, errorList) {

            if (errorList.length != 0)
            {
                console.log(errorList);
                $('#login_form .error-block').removeClass('hidden');
                $('#login_form .error-block .message').html(errorList[0].message);

            }
            else {
                $('#login_form .error-block').addClass('hidden');
            }
        },
        invalidHandler: function (event, validator) { //display error alert on form submit   
            //$('.alert-danger', $('.f1')).show();
            $('#login_form .error-block').removeClass('hidden');

        },
        submitHandler: function (form) {
            //alert(form.password.value);
            //form.p.value = hex_sha512(form.lpassword.value);
            //form.lpassword.value = "";
            var postData = $(form).serializeArray();
            //console.log(postData);
            $.ajax(
                    {
                        url: "sign_val.php",
                        type: "POST",
                        data: postData,
                        success: function (data, textStatus, jqXHR)
                        {
                            alert(data);
                            if ($.trim(data) == "Admin")
                            {
                                window.location = "home.php";
                            }
                            else if ($.trim(data) == "Manager")
                            {
                                window.location = "home.php";
                            }
                            else if ($.trim(data) == "password doesn't match")
                            {
                                window.location = "index.html";
                            }
                            else if ($.trim(data) == "reset password")
                            {
                                window.location = "reset_password.php";
                            }
                            else if ($.trim(data) == "No results found in database")
                            {
                                window.location = "index.html";
                            }
                            else
                            {
                                window.location = "employee.php";
                            }

                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            //if fails
                            alert("Unable to login due to network failure");
                        }
                    });
        }

    });
});