jQuery(function ($) {

    /*$("#project_id").on("change", function() {        
     $.ajax(
     {
     url : "get_empdata_task.php?pid="+this.value,            
     datatype: "json",
     success:function(data, textStatus, jqXHR) 
     {    
     $("#assigned_to").empty();
     if(data.length != 0)
     {
     $.each($.parseJSON(data), function(idx, obj)
     {                    
     $('#assigned_to').multiSelect('addOption', { value: obj.employee_id, text: obj.employee_name });
     });
     }                                                    
     },
     error: function(jqXHR, textStatus, errorThrown) 
     {
     //if fails
     alert("Unable to fetch data");
     }
     });  
     });*/

    $('#add_task').appendTo("body");

    $('#id-input-file-3').ace_file_input({
        style: 'well',
        btn_choose: 'Drop files here or click to choose',
        btn_change: null,
        no_icon: 'icon-cloud-upload',
        droppable: true,
        thumbnail: 'small'//large | fit
                //,icon_remove:null//set null, to hide remove/reset button
                /**,before_change:function(files, dropped) {
                 //Check an example below
                 //or examples/file-upload.html
                 return true;
                 }*/
                /**,before_remove : function() {
                 return true;
                 }*/
        ,
        preview_error: function (filename, error_code) {
            //name of the file that failed
            //error_code values
            //1 = 'FILE_LOAD_FAILED',
            //2 = 'IMAGE_LOAD_FAILED',
            //3 = 'THUMBNAIL_FAILED'
            //alert(error_code);
        }
    }).on('change', function () {
        //console.log($(this).data('ace_input_files'));
        //console.log($(this).data('ace_input_method'));
    });
    $('#id-file-format').removeAttr('checked').on('change', function () {
        var before_change
        var btn_choose
        var no_icon
        if (this.checked) {
            btn_choose = "Drop images here or click to choose";
            no_icon = "icon-picture";
            before_change = function (files, dropped) {
                var allowed_files = [];
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    if (typeof file === "string") {
                        //IE8 and browsers that don't support File Object
                        if (!(/\.(jpe?g|png|gif|bmp)$/i).test(file))
                            return false;
                    }
                    else {
                        var type = $.trim(file.type);
                        if ((type.length > 0 && !(/^image\/(jpe?g|png|gif|bmp)$/i).test(type))
                                || (type.length == 0 && !(/\.(jpe?g|png|gif|bmp)$/i).test(file.name))//for android's default browser which gives an empty string for file.type
                                )
                            continue;//not an image so don't keep this file
                    }

                    allowed_files.push(file);
                }
                if (allowed_files.length == 0)
                    return false;

                return allowed_files;
            }
        }
        else {
            btn_choose = "Drop files here or click to choose";
            no_icon = "icon-cloud-upload";
            before_change = function (files, dropped) {
                return files;
            }
        }
        var file_input = $('#id-input-file-3');
        file_input.ace_file_input('update_settings', {'before_change': before_change, 'btn_choose': btn_choose, 'no_icon': no_icon})
        file_input.ace_file_input('reset_input');
    });

    $('.date-picker').datepicker({autoclose: true}).next().on(ace.click_event, function () {
        $(this).prev().focus();
    });

    //$('#editor1').ace_wysiwyg();//this will create the default editor will all buttons

    //but we want to change a few buttons colors for the third style
    $('#editor1').ace_wysiwyg({
        toolbar:
                [
                    'font',
                    null,
                    'fontSize',
                    null,
                    {name: 'bold', className: 'btn-info'},
                    {name: 'italic', className: 'btn-info'},
                    {name: 'strikethrough', className: 'btn-info'},
                    {name: 'underline', className: 'btn-info'},
                    null,
                    {name: 'insertunorderedlist', className: 'btn-success'},
                    {name: 'insertorderedlist', className: 'btn-success'},
                    {name: 'outdent', className: 'btn-purple'},
                    {name: 'indent', className: 'btn-purple'},
                    null,
                    {name: 'justifyleft', className: 'btn-primary'},
                    {name: 'justifycenter', className: 'btn-primary'},
                    {name: 'justifyright', className: 'btn-primary'},
                    {name: 'justifyfull', className: 'btn-inverse'},
                    null,
                    {name: 'createLink', className: 'btn-pink'},
                    {name: 'unlink', className: 'btn-pink'},
                    null,
                    {name: 'insertImage', className: 'btn-success'},
                    null,
                    'foreColor',
                    null,
                    {name: 'undo', className: 'btn-grey'},
                    {name: 'redo', className: 'btn-grey'}
                ],
        'wysiwyg': {
            fileUploadError: showErrorAlert
        }
    }).prev().addClass('wysiwyg-style2');

    $('[data-toggle="buttons"] .btn').on('click', function (e) {
        var target = $(this).find('input[type=radio]');
        var which = parseInt(target.val());
        var toolbar = $('#editor1').prev().get(0);
        $(toolbar).addClass('wysiwyg-style2');
    });

    //Add Image Resize Functionality to Chrome and Safari
    //webkit browsers don't have image resize functionality when content is editable
    //so let's add something using jQuery UI resizable
    //another option would be opening a dialog for user to enter dimensions.
    if (typeof jQuery.ui !== 'undefined' && /applewebkit/.test(navigator.userAgent.toLowerCase())) {

        var lastResizableImg = null;
        function destroyResizable() {
            if (lastResizableImg == null)
                return;
            lastResizableImg.resizable("destroy");
            lastResizableImg.removeData('resizable');
            lastResizableImg = null;
        }

        var enableImageResize = function () {
            $('.wysiwyg-editor')
                    .on('mousedown', function (e) {
                        var target = $(e.target);
                        if (e.target instanceof HTMLImageElement) {
                            if (!target.data('resizable')) {
                                target.resizable({
                                    aspectRatio: e.target.width / e.target.height,
                                });
                                target.data('resizable', true);

                                if (lastResizableImg != null) {//disable previous resizable image
                                    lastResizableImg.resizable("destroy");
                                    lastResizableImg.removeData('resizable');
                                }
                                lastResizableImg = target;
                            }
                        }
                    })
                    .on('click', function (e) {
                        if (lastResizableImg != null && !(e.target instanceof HTMLImageElement)) {
                            destroyResizable();
                        }
                    })
                    .on('keydown', function () {
                        destroyResizable();
                    });
        }

        enableImageResize();

        /**
         //or we can load the jQuery UI dynamically only if needed
         if (typeof jQuery.ui !== 'undefined') enableImageResize();
         else {//load jQuery UI if not loaded
         $.getScript($path_assets+"/js/jquery-ui-1.10.3.custom.min.js", function(data, textStatus, jqxhr) {
         if('ontouchend' in document) {//also load touch-punch for touch devices
         $.getScript($path_assets+"/js/jquery.ui.touch-punch.min.js", function(data, textStatus, jqxhr) {
         enableImageResize();
         });
         } else	enableImageResize();
         });
         }
         */
    }

    function showErrorAlert(reason, detail) {
        var msg = '';
        if (reason === 'unsupported-file-type') {
            msg = "Unsupported format " + detail;
        }
        else {
            console.log("error uploading file", reason, detail);
        }
        $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
    }
});