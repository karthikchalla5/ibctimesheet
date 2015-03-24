jQuery(function ($) {

    $('#task_status').appendTo("body");

    $('#status').on('change', function () {
        //alert($( "#status option:selected" ).val());
        if ($("#status option:selected").val() == "completed") {
            $('#mail_password').removeClass('hidden');
        }
        else {
            $('#mail_password').addClass('hidden')
        }
    });


    //editables on first profile page
    $.fn.editable.defaults.mode = 'inline';
    $.fn.editableform.loading = "<div class='editableform-loading'><i class='light-blue icon-2x icon-spinner icon-spin'></i></div>";
    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="icon-ok icon-white"></i></button>' +
            '<button type="button" class="btn editable-cancel"><i class="icon-remove"></i></button>';

    // *** editable avatar *** //
    try {//ie8 throws some harmless exception, so let's catch it

        //it seems that editable plugin calls appendChild, and as Image doesn't have it, it causes errors on IE at unpredicted points
        //so let's have a fake appendChild for it!
        if (/msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()))
            Image.prototype.appendChild = function (el) {
            }

        var last_gritter
        $('#avatar').editable({
            type: 'image',
            name: 'avatar',
            value: null,
            image: {
                //specify ace file input plugin's options here
                btn_choose: 'Change Avatar',
                droppable: true,
                /**
                 //this will override the default before_change that only accepts image files
                 before_change: function(files, dropped) {
                 return true;
                 },
                 */

                //and a few extra ones here
                name: 'avatar', //put the field name here as well, will be used inside the custom plugin
                max_size: 614400, //~100Kb
                on_error: function (code) {//on_error function will be called when the selected file has a problem
                    if (last_gritter)
                        $.gritter.remove(last_gritter);
                    if (code == 1) {//file format error
                        last_gritter = $.gritter.add({
                            title: 'File is not an image!',
                            text: 'Please choose a jpg|gif|png image!',
                            class_name: 'gritter-error gritter-center'
                        });
                    } else if (code == 2) {//file size rror
                        last_gritter = $.gritter.add({
                            title: 'File too big!',
                            text: 'Image size should not exceed 600Kb!',
                            class_name: 'gritter-error gritter-center'
                        });
                    }
                    else {//other error
                    }
                },
                on_success: function () {
                    $.gritter.removeAll();
                }
            },
            url: function (params) {
                // ***UPDATE AVATAR HERE*** //
                //You can replace the contents of this function with examples/profile-avatar-update.js for actual upload


                var deferred = new $.Deferred

                //if value is empty, means no valid files were selected
                //but it may still be submitted by the plugin, because "" (empty string) is different from previous non-empty value whatever it was
                //so we return just here to prevent problems
                var value = $('#avatar').next().find('input[type=hidden]:eq(0)').val();
                if (!value || value.length == 0) {
                    deferred.resolve();
                    return deferred.promise();
                }


                //dummy upload
                setTimeout(function () {
                    if ("FileReader" in window) {
                        //for browsers that have a thumbnail of selected image
                        var thumb = $('#avatar').next().find('img').data('thumb');
                        if (thumb)
                            $('#avatar').get(0).src = thumb;
                    }

                    deferred.resolve({'status': 'OK'});

                    if (last_gritter)
                        $.gritter.remove(last_gritter);
                    last_gritter = $.gritter.add({
                        title: 'Avatar Updated!',
                        text: 'Uploading to server can be easily implemented. A working example is included with the template.',
                        class_name: 'gritter-info gritter-center'
                    });

                }, parseInt(Math.random() * 800 + 800))

                return deferred.promise();
            },
            success: function (response, newValue) {
            }
        })
    } catch (e) {
    }

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
                            alert(data);		
                            if ($.trim(data) == "Task status updated.")
                            {
                                $('#employee_home_anchor').click();
                                $('#task_status_form .alert-block').removeClass('hidden');
                                $('#task_status_form .alert-block .message').html(data);
                            }
                            else if ($.trim(data) == "Task status updated and mail has been sent to Your Respective Mentor")
                            {
                                $('#employee_home_anchor').click();
                                $('#task_status_form .alert-block').removeClass('hidden');
                                $('#task_status_form .alert-block .message').html(data);
                            }
                            else if ($.trim(data) == "Task status updated but no mail ID has been found for the selected user")
                            {
                                $('#employee_home_anchor').click();
                                $('#task_status_form .alert-block').removeClass('hidden');
                                $('#task_status_form .alert-block .message').html(data);
                            }
                            else
                            {
                                $('#employee_home_anchor').click();
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