jQuery(function ($) {

    $('#assign_project_task_id').on("change", function () {
        $.ajax(
                {
                    url: "get_empdata_project_task.php?pid=" + this.value,
                    datatype: "json",
                    success: function (data, textStatus, jqXHR)
                    {
                        $("#assign_task_id").empty();
                        $('#assign_task_id').append($("<option></option>").val("").text("Select"));
                        $('#dynamic_checkbox').empty();
                        if (data.length != 0)
                        {
                            $flag = 0;
                            //alert(data);
                            $.each($.parseJSON(data), function (idx, obj)
                            {
                                if (obj.check == "check")
                                {
                                    $flag = 1;
                                }
                                else if ($flag == 0)
                                {
                                    $('#assign_task_id').append($("<option></option>").val(obj.task_id).text(obj.task_name));
                                }
                                else if ($flag == 1)
                                {
                                    $('#dynamic_checkbox').append('<tr><td><input name="employee_id[]"  id="employee_id" class="checkbox  ace ace-checkbox-2"  type="checkbox" value="' + obj.employee_id + '" ><span class="lbl">' + obj.employee_name + '</span></td><td>' + obj.designation + '</td></tr>');
                                }
                            });
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Unable to fetch data");
                    }
                });
    });


    $('#assign_task_form').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        onkeyup: false,
        rules: {
            assign_project_task_id: {
                required: {
                    depends: function (element) {
                        return $("#assign_project_task_id").val() == '';
                    }
                }
            },
            assign_task_id: {
                required: {
                    depends: function (element) {
                        return $("#assign_task_id").val() == '';
                    }
                }
            }
        },
        messages: {
            assign_project_task_id: {
                required: "Please Select a Project."
            },
            assign_task_id: {
                required: "Please Select a Task."
            }
        },
        showErrors: function (errorMap, errorList) {
            if (errorList.length != 0)
            {
                console.log(errorList);
                $('#assign_task_form .error-block').removeClass('hidden');
                $('#assign_task_form .error-block .message').html(errorList[0].message);

            }
            else {
                $('#assign_task_form .error-block').addClass('hidden');
            }
        },
        invalidHandler: function (event, validator) {
            $('#assign_task_form .error-block').removeClass('hidden');
        },
        submitHandler: function (form) {
            //alert("ab");
            $('#spinning3').removeClass('hidden');
            var postData = $(form).serializeArray();
            $.ajax(
                    {
                        url: "task_employee_val.php",
                        type: "POST",
                        data: postData,
                        success: function (data, textStatus, jqXHR)
                        {
                            $('#spinning3').addClass('hidden');
                            //alert(data);
                            if ($.trim(data) == "New record created successfully. Mail has been Sent.")
                            {
                                $('#assign_task_user_anchor').click();
                                $('#assign_task_form .alert-block').removeClass('hidden');
                                $('#assign_task_form .alert-block .message').html(data);
                            }
                            else if ($.trim(data) == "You didn't select any employee to assign.")
                            {
                                $('#assign_task_form .error-block').removeClass('hidden');
                                $('#assign_task_form .error-block .message').html(data);
                            }
                            else
                            {
                                $('#assign_task_user_anchor').click();
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