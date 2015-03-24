jQuery(function ($) {

    $('#assign_project_form').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        onkeyup: false,
        rules: {
            assign_project_id: {
                required: {
                    depends: function (element) {
                        return $("#form-field-1").val() == '';
                    }
                }
            }
        },
        messages: {
            assign_project_id: {
                required: "Please select a Project."
            }
        },
        showErrors: function (errorMap, errorList) {
            if (errorList.length != 0)
            {
                console.log(errorList);
                $('#assign_project_form .error-block').removeClass('hidden');
                $('#assign_project_form .error-block .message').html(errorList[0].message);

            }
            else {
                $('#assign_project_form .error-block').addClass('hidden');
            }
        },
        invalidHandler: function (event, validator) {
            $('#assign_project_form .error-block').removeClass('hidden');
        },
        submitHandler: function (form) {
            $('#spinning2').removeClass('hidden');
            var postData = $(form).serializeArray();
            var content = $('#editable').html();
            postData[postData.length] = {name: "description", value: content};
            $.ajax(
                    {
                        url: "project_employee_val.php",
                        type: "POST",
                        data: postData,
                        success: function (data, textStatus, jqXHR)
                        {
                            $('#spinning2').addClass('hidden');
                            //alert(data);
                            if ($.trim(data) == "New record created successfully. Mail has been Sent.")
                            {
                                $('#assign_project_user_anchor').click();
                                $('#assign_project_form .alert-block').removeClass('hidden');
                                $('#assign_project_form .alert-block .message').html(data);
                            }
                            else if ($.trim(data) == "You didn't select any employee to assign.")
                            {
                                $('#assign_project_form .error-block').removeClass('hidden');
                                $('#assign_project_form .error-block .message').html(data);
                            }
                            else
                            {
                                $('#assign_project_form .error-block').removeClass('hidden');
                                $('#assign_project_form .error-block .message').html(data);
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