
jQuery(function ($) {
    Dropzone.autoDiscover = false;
    try {
        var myDropzone = new Dropzone("div#dropzone",
                {
                    url: "./upload_files_save.php",
                    paramName: "file", // The name that will be used to transfer the file
                    maxFilesize: 0.5, // MB        
                    droppable: true,
                    maxFiles: 10,
                    parallelUploads: 10,
                    autoProcessQueue: false,
                    addRemoveLinks: true,
                    dictDefaultMessage:
                            '<span class="bigger-150 bolder"><i class="icon-caret-right red"></i> Drop files</span> to upload \
                <span class="smaller-80 grey">(or click)</span> <br /> \
                <i class="upload-icon icon-cloud-upload blue icon-3x"></i>',
                    dictResponseError: 'Error while uploading file!',
                    dictMaxFilesExceeded: 'Error Maximum size reached. Maximum = 10 Files',
                    //change the previewTemplate to use Bootstrap progress bars
                    previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-details\">\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n    <div class=\"dz-size\" data-dz-size></div>\n    <img data-dz-thumbnail />\n  </div>\n  <div class=\"progress progress-small progress-striped active\"><div class=\"progress-bar progress-bar-success\" data-dz-uploadprogress></div></div>\n  <div class=\"dz-success-mark\"><span></span></div>\n  <div class=\"dz-error-mark\"><span></span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n</div>",
                    init: function ()
                    {
                    },
                    /*removedfile: function(file) {
                     var name = file.name;        
                     $.ajax({
                     type: 'POST',
                     url: 'delete_files_save.php',
                     data: "file_name="+name,
                     dataType: 'html'
                     });
                     var _ref;
                     return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                     },*/
                    uploadprogress: function (file, progress, bytesSent) {
                        //alert(bytesSent);                
                    },
                    accept: function (file, done) {
                        done();
                    },
                    sending: function (file, xhr, form) {
                        //console.log('Sent File');
                    }
                });
    }
    catch (e) {
        alert('Dropzone.js does not support older browsers!');
    }

    $('#add_task_form').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        onkeyup: false,
        rules: {
            project_id: {
                required: {
                    depends: function (element) {
                        return $("#project_id").val() == '';
                    }
                }
            },
            name: {
                required: true,
                minlength: 3
            }

        },
        messages: {
            project_id: {
                required: "Please provide a Project name."
            },
            name: {
                required: "Please provide a name for task."

            }

        },
        showErrors: function (errorMap, errorList) {
            if (errorList.length != 0)
            {
                console.log(errorList);
                $('#add_task_form .error-block').removeClass('hidden');
                $('#add_task_form .error-block .message').html(errorList[0].message);

            }
            else {
                $('#add_task_form .error-block').addClass('hidden');
            }
        },
        invalidHandler: function (event, validator) {
            $('#add_task_form .error-block').removeClass('hidden');
        },
        submitHandler: function (form) {

            var postData = $(form).serializeArray();
            var content = $('#editable').html();
            postData[postData.length] = {name: "description", value: content};
            $.ajax(
                    {
                        url: "task_val.php",
                        type: "POST",
                        data: postData,
                        success: function (data, textStatus, jqXHR)
                        {
                            //alert(data);		
                            if ($.trim(data) == "New task created successfully.")
                            {
                                myDropzone.processQueue();
                                $('#add_task_user_anchor').click();
                                $('#add_task_form .alert-block').removeClass('hidden');
                                $('#add_task_form .alert-block .message').html(data);
                            }
                            else if ($.trim(data) == "New task created successfully.")
                            {
                                $('#add_task_user_anchor').click();
                                $('#add_task_form .error-block').removeClass('hidden');
                                $('#add_task_form .error-block .message').html(data);
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