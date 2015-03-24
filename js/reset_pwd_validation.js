jQuery(function ($) {
    //alert("AB");
    $('#resetpwd1').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        onkeyup: false,
        rules: {
            cpwd: {
                required: true

            },
            npwd: {
                required: true

            },
            rnpwd: {
                required: true

            }
        },
        messages: {
            cpwd: {
                required: "Please provide current password."
            },
            npwd: {
                required: "Please provide a new password."
            },
            rnpwd: {
                required: "Please provide a re enter password."
            }
        },
        showErrors: function (errorMap, errorList) {

            if (errorList.length != 0)
            {
                console.log(errorList);
                $('#resetpwd1 .error-block').removeClass('hidden');
                $('#resetpwd1 .error-block .message').html(errorList[0].message);

            }
            else {
                $('#resetpwd1 .error-block').addClass('hidden');
            }
        },
        invalidHandler: function (event, validator) { //display error alert on form submit   
            //$('.alert-danger', $('.f1')).show();
            $('#resetpwd1 .error-block').removeClass('hidden');

        },
        submitHandler: function (form) {
            //alert(form.password.value);
            //form.p.value = hex_sha512(form.lpassword.value);
            //form.lpassword.value = "";
            var postData = $(form).serializeArray();
            //console.log(postData);
            $.ajax(
                    {
                        url: "reset_pwd_val.php",
                        type: "POST",
                        data: postData,
                        success: function (data, textStatus, jqXHR)
                        {
                            alert(data);
                            if ($.trim(data) == "Your reset password sucessfully updated")
                            {
                                window.location = "index.html";
                            }
                            else if ($.trim(data) == "new password and re enter password aren't equal") {
                                window.location = "#";
                            }
                            else if ($.trim(data) == "Current password You enterd is incorrect.")
                            {
                                window.location = "#";
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