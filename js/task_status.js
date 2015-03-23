jQuery(function ($) {

    $('#task_status').appendTo("body");

    $('#task_status_form').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        onkeyup: false,
        rules: {
            date: {
                required: {
                    depends: function (element) {
                        return $("#date").val() == '';
                    }
                }
            },
            hours: {
                required: {
                    depends: function (element) {
                        return $("#hours").val() == '';
                    }
                }
            },
            type: {
                required: {
                    depends: function (element) {
                        return $("#type").val() == '';
                    }
                }
            }
        },
        messages: {
            date: {
                required: "Please provide a Date."
            },
            hours: {
                required: "Please provide a time."

            },
            type: {
                required: "Please provide a type of work."

            }

        },
        showErrors: function (errorMap, errorList) {
            if (errorList.length != 0)
            {
                console.log(errorList);
                $('#task_status_form .error-block').removeClass('hidden');
                $('#task_status_form .error-block .message').html(errorList[0].message);

            }
            else {
                $('#task_status_form .error-block').addClass('hidden');
            }
        },
        invalidHandler: function (event, validator) {
            $('#task_status_form .error-block').removeClass('hidden');
        },
        submitHandler: function (form) {

            var postData = $(form).serializeArray();
            var content = $('#editable').html();
            postData[postData.length] = {name: "description", value: content};
            $.ajax(
                    {
                        url: "task_status.php",
                        type: "POST",
                        data: postData,
                        success: function (data, textStatus, jqXHR)
                        {
                            //alert(data);		
                            if ($.trim(data) == "Task status updated.")
                            {
                                $('#employee_home_anchor').click();
                                $('#task_status_anchor').click();

                                $('#task_status_form .alert-block').removeClass('hidden');
                                $('#task_status_form .alert-block .message').html(data);
                            }
                            else
                            {
                                $('#task_status_anchor').click();
                                $('#task_status_form .error-block').removeClass('hidden');
                                $('#task_status_form .error-block .message').html(data);
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