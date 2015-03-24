jQuery(function ($) {

    $('#add_employee_form').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        onkeyup: false,
        rules: {
            name: {
                required: true,
                minlength: 5
            },
            designation: {
                required: {
                    depends: function (element) {
                        return $("#form-field-icon-2").val() == '';
                    }
                }
            },
            empid: {
                required: true,
                minlength: 4
            },
            off_mail_id: {
                required: false,
                minlength: 6
            },
            prsnl_mail_id: {
                required: true,
                minlength: 6
            },
            number: {
                required: true,
                minlength: 10
            },
            address: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            name: {
                required: "Please provide a valid name.",
                minlength: "name should be more than 5 characters"
            },
            designation: {
                required: "Please select a designation.",
            },
            empid: {
                required: "Please provide employee id.",
                minlength: "employee id should be more than 3 characters"
            },
            off_mail_id: {
                required: "Please provide official mail ID.",
                minlength: "off_mail_id should be more than 5 characters"
            },
            prsnl_mail_id: {
                required: "Please provide personal mail ID.",
                minlength: "prsnl_mail_id should be more than 5 characters"
            },
            number: {
                required: "Please provide mobile number.",
                minlength: "Number should be 10 characters"
            },
            address: {
                required: "Please provide address.",
                minlength: "Address should be more than 5 characters"
            }
        },
        showErrors: function (errorMap, errorList) {
            if (errorList.length != 0)
            {
                console.log(errorList);
                $('#add_employee_form .error-block').removeClass('hidden');
                $('#add_employee_form .error-block .message').html(errorList[0].message);

            }
            else {
                $('#add_employee_form .error-block').addClass('hidden');
            }
        },
        invalidHandler: function (event, validator) {
            $('#add_employee_form .error-block').removeClass('hidden');
        },
        submitHandler: function (form) {

            $('#spinning').removeClass('hidden');
            var postData = $(form).serializeArray();
            $.ajax(
                    {
                        url: "user_val.php",
                        type: "POST",
                        data: postData,
                        success: function (data, textStatus, jqXHR)
                        {
                            $('#spinning').addClass('hidden');
                            $('#add_employee_form .alert-block').addClass('hidden');
                            //alert(data);
                            if ($.trim(data) == "New record created successfully. Official Mail has been updated and an email has been Sent to recipient regarding login details")
                            {

                                $('#add_employee_anchor').click();
                                $('#add_employee_form .alert-block').removeClass('hidden');
                                $('#add_employee_form .alert-block .message').html(data);
                            }
                            else if ($.trim(data) == "Please Update official mail ID ASAP. Mail has been sent.")
                            {
                                $('#add_employee_anchor').click();
                                $('#add_employee_form .alert-block').removeClass('hidden');
                                $('#add_employee_form .alert-block .message').html(data);
                            }
                            else
                            {
                                $('#add_employee_anchor').click();
                                $('#add_employee_form .alert-block').removeClass('hidden');
                                $('#add_employee_form .alert-block .message').html(data);
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
    $("#add_employee_form button[type='reset']").click(function ()
    {
        console.log("resetting form..");
        $("#add_employee_form .error-block").addClass('hidden');
    });
});