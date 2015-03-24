
jQuery(function ($) {

    $('#add_project_form').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        onkeyup: false,
        rules: {
            project_manager: {
                required: true,
            },
            pname: {
                required: true,
                minlength: 5
            },
            cname: {
                required: false,
                minlength: 5
            },
            clnt_mail_id: {
                required: false,
                minlength: 6
            },
            clnt_number: {
                required: false,
                minlength: 10
            },
            start_date: {
                required: true,
                minlength: 6
            },
            end_date: {
                required: false,
                minlength: 6
            }
        },
        messages: {
            project_manager: {
                required: "Please provide a valid name."
            },
            pname: {
                required: "Please provide a valid name.",
                minlength: "name should be more than 5 characters"
            },
            cname: {
                required: "Please provide a valid name.",
                minlength: "name should be more than 5 characters"
            },
            clnt_mail_id: {
                required: "Please provide valid email id.",
                minlength: "employee id should be more than 3 characters"
            },
            clnt_number: {
                required: "Please provide mobile number.",
                minlength: "Number should be 10 characters"
            },
            start_date: {
                required: "Please provide start date.",
                minlength: "date should be 8 characters"
            },
            end_date: {
                required: "Please provide end date.",
                minlength: "date should be  8 characters"
            }
        },
        showErrors: function (errorMap, errorList) {
            if (errorList.length != 0)
            {
                console.log(errorList);
                $('#add_project_form .error-block').removeClass('hidden');
                $('#add_project_form .error-block .message').html(errorList[0].message);

            }
            else {
                $('#add_project_form .error-block').addClass('hidden');
            }
        },
        invalidHandler: function (event, validator) {
            $('#add_project_form .error-block').removeClass('hidden');
        },
        submitHandler: function (form) {

            var postData = $(form).serializeArray();
            $.ajax(
                    {
                        url: "project_val.php",
                        type: "POST",
                        data: postData,
                        success: function (data, textStatus, jqXHR)
                        {
                            //alert(data);
                            if ($.trim(data) == "New record created successfully.")
                            {
                                $('#add_project_anchor').click();
                                $('#add_project_form .alert-block').removeClass('hidden');
                                $('#add_project_form .alert-block .message').html(data);
                            }
                            else if ($.trim(data) == "fail")
                            {
                                $('#add_project_anchor').click();
                                $('#add_project_form .alert-block').removeClass('hidden');
                                $('#add_project_form .alert-block .message').html(data);
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
    $("#add_project_form button[type='reset']").click(function ()
    {
        console.log("resetting form..");
        $("#add_project_form .error-block").addClass('hidden');
    });
});