jQuery(function ($) {

    var grid_selector = "#employee-grid-table";
    var pager_selector = "#employee-grid-pager";

    jQuery(grid_selector).jqGrid({
        //direction: "rtl",
        defaults: {
            recordtext: "View {0} - {1} of {2}",
            emptyrecords: "No records to view",
            loadtext: "Loading...",
            pgtext: "Page {0} of {1}"
        },
        url: "get_employee_project_data.php",
        postData: {
            project_name: function () {
                return "";
            },
            priority: function () {
                return "";
            },
            start_date: function () {
                return "";
            },
            due_date: function () {
                return "";
            },
            status: function () {
                return "";
            }
        },
        datatype: "json",
        mtype: 'POST',
        height: 'auto',
        width: '100%',
        colNames: ['Project Name', 'Project ID', 'Task Name', 'Task ID', 'Priority', 'Start Date', 'End Date', 'Status'],
        colModel: [
            {name: 'project_name',
                index: 'project_name',
                search: false,
                stype: 'select',
                formatter: myOptions,
                searchoptions: {
                    clearSearch: true,
                    sopt: ['eq', 'ne', 'lt', 'le', 'gt', 'ge', 'bw', 'bn', 'in', 'ni', 'ew', 'en', 'cn', 'nc'],
                    value: '1:One;2:Two'
                },
                align: 'left'
            },
            {name: 'project_id',
                index: 'project_id',
                editrules: {
                    required: true,
                    edithidden: true
                },
                hidden: true
            },
            {name: 'task_name',
                index: 'task_name',
                search: false,
                searchoptions: {
                    clearSearch: true,
                    sopt: ['eq', 'ne', 'lt', 'le', 'gt', 'ge', 'bw', 'bn', 'in', 'ni', 'ew', 'en', 'cn', 'nc'],
                }
            },
            {name: 'task_id',
                index: 'task_id',
                editrules: {
                    required: true,
                    edithidden: true
                },
                hidden: true
            },
            {name: 'priority',
                index: 'priority',
                search: true,
                stype: 'select',
                searchoptions: {
                    sopt: ['eq', 'ne', 'lt', 'le', 'gt', 'ge', 'bw', 'bn', 'in', 'ni', 'ew', 'en', 'cn', 'nc'],
                    clearSearch: true,
                    value: ':All;Medium:Medium;Urgent:Urgent;High:High;Low:Low'
                }
            },
            {name: 'start_date',
                index: 'start_date',
                search: true,
                stype: 'text',
                searchoptions: {
                    dataInit: function (elem)
                    {
                        $(elem).datepicker({
                            autoclose: true,
                            gotoCurrent: true,
                            format: "yyyy-mm-dd",
                            todayHighlight: true
                        });
                    },
                    attr: {title: 'Select Date'},
                    sopt: ['eq', 'ne', 'lt', 'le', 'gt', 'ge', 'bw', 'bn', 'in', 'ni', 'ew', 'en', 'cn', 'nc'],
                    clearSearch: true
                }
            },
            {name: 'due_date',
                index: 'due_date',
                search: true,
                stype: 'text',
                searchoptions: {
                    dataInit: function (elem)
                    {
                        $(elem).datepicker({
                            autoclose: true,
                            gotoCurrent: true,
                            format: "yyyy-mm-dd",
                            todayHighlight: true
                        }).val();
                    },
                    searchOnEnter: false,
                    attr: {title: 'Select Date'},
                    sopt: ['eq', 'ne', 'lt', 'le', 'gt', 'ge', 'bw', 'bn', 'in', 'ni', 'ew', 'en', 'cn', 'nc'],
                    clearSearch: true
                }
            },
            {name: 'status',
                index: 'status',
                search: true,
                stype: 'select',
                searchoptions: {
                    sopt: ['eq', 'ne', 'lt', 'le', 'gt', 'ge', 'bw', 'bn', 'in', 'ni', 'ew', 'en', 'cn', 'nc'],
                    clearSearch: true,
                    value: ':All;pending:pending;working:working;new:new;completed:completed'
                }
            }
        ],
        rownumbers: true,
        gridview: true,
        shrinkToFit: true,
        loadonce: true,
        viewrecords: true,
        rowNum: 10,
        rowList: [10, 20, 30],
        pager: pager_selector,
        altRows: true,
        //toppager: true,
        //multiselect: true,
        //multikey: "ctrlKey",
        //multiboxonly: false, 
        //ignoreCase: true,
        loadComplete: function () {
            var table = this;

            var $this = $(this);
            if ($this.jqGrid("getGridParam", "datatype") !== "local") {
                setTimeout(function () {
                    $this.jqGrid("setGridParam", {rowNum: 10}); // the real value
                    $this.trigger("reloadGrid");
                }, 50);
            }

            setTimeout(function () {

                styleCheckbox(table);

                updateActionIcons(table);
                updatePagerIcons(table);
                enableTooltips(table);
            }, 0);
        },
        //editurl: "update_user.php",//nothing is saved

        //caption: "Project Task Details",



        //autowidth: true
    });

    $(grid_selector).jqGrid('setGridParam', {multiSort: true})
            .jqGrid('sortGrid', 'due_date', true, 'asc')
            .jqGrid('sortGrid', 'due_date', true, 'asc')
            .jqGrid('sortGrid', 'priority', true, 'desc')
            .jqGrid('sortGrid', 'priority', true, 'desc');

    /*jQuery(grid_selector).jqGrid('filterToolbar',{
     
     //searchOperators: true,
     stringResult: true, 
     searchOnEnter: false              
     //enableClear: true,
     //defaultSearch: 'cn', 
     //ignoreCase: true,
     //clearToolbar: true
     }
     );
     */

    $(document).on("click", ".task_status", function () {
        var data = $(this).data('todo');
        //alert(data.status);
        $('#task_status_form').trigger('reset');
        $('#error8').addClass('hidden');
        $('#success8').addClass('hidden');
        $('#project_id').val(data.project_id);
        $('#project_name').val(data.project_name);
        $('#task_id').val(data.task_id);
        $('#task_name').val(data.task_name);
        $('#status').val(data.status);
    });



    function myOptions(cellvalue, options, rowObject)
    {
        return "<a data-toggle='modal' class='task_status' id='task_status_anchor' href='#task_status' data-todo='{\"project_id\":" + rowObject.project_id + ",\"project_name\":\"" + rowObject.project_name + "\",\"task_id\":" + rowObject.task_id + ",\"task_name\":\"" + rowObject.task_name + "\",\"status\":\"" + rowObject.status + "\"}'>" + cellvalue + "</a>";
    }

    var timeoutHnd;
    var flAuto = false;

    function doSearch(ev) {
        if (!flAuto)
            return;
        //	var elem = ev.target||ev.srcElement;
        if (timeoutHnd)
            clearTimeout(timeoutHnd)
        timeoutHnd = setTimeout(function () {
            $('#employee_search').click()
        }, 500);
    }

    $('#employee_search').on('click', function () {

        //var employee_project_name = $("#employee_project_name").val();
        //var employee_priority = $("#employee_priority").val();               
        //var employee_status = $("#employee_status").val();        
        var arr = $("#date_range").val().split('~');
        var start_date = arr[0];
        var end_date = arr[1];
        //alert(start_date);
        $(grid_selector).jqGrid('setGridParam', {
            url: "get_employee_project_data.php",
            datatype: 'json',
            postData: {
                project_name: function () {
                    return $("#employee_project_name").val();
                },
                priority: function () {
                    return $("#employee_priority").val();
                },
                start_date: function () {
                    return start_date;
                },
                due_date: function () {
                    return end_date;
                },
                status: function () {
                    return $("#employee_status").val();
                }
            },
            page: 1

        }).trigger("reloadGrid");

    });

    $('#employee_search_clear').on('click', function () {

        $('#employee_project_name').val('');
        $('#employee_priority').val('');
        $('#date_range').val('');
        $('#employee_status').val('');
        $('#employee_search').click();

    });

    $('#autosearch').on('click', function () {

        if (this.checked)
        {
            flAuto = true;
            jQuery("#employee_search").attr("disabled", true);
        }
        else
        {
            flAuto = false;
            jQuery("#employee_search").removeAttr("disabled");
        }
    });

    $('#employee_project_name').on('change', function (arguments, event) {
        doSearch(arguments[0] || event)
    });
    $('#employee_priority').on('change', function (arguments, event) {
        doSearch(arguments[0] || event)
    });
    $('#date_range').on('change', function (arguments, event) {
        doSearch(arguments[0] || event)
    });
    $('#employee_status').on('change', function (arguments, event) {
        doSearch(arguments[0] || event)
    });

    //<a   href="#task_status" onclick="document.task_status_form.reset();document.getElementById('error8').classList.add('hidden');document.getElementById('success8').classList.add('hidden');">submit</a>
    //enable search/filter toolbar
    //jQuery(grid_selector).jqGrid('filterToolbar',{defaultSearch:true,stringResult:true})

    //switch element when editing inline
    function aceSwitch(cellvalue, options, cell) {
        setTimeout(function () {
            $(cell).find('input[type=checkbox]')
                    .wrap('<label class="inline" />')
                    .addClass('ace ace-switch ace-switch-5')
                    .after('<span class="lbl"></span>');
        }, 0);
    }
    //enable datepicker
    function pickDate(cellvalue, options, cell) {
        setTimeout(function () {
            $(cell).find('input[type=text]')
                    .datepicker({format: 'yyyy-mm-dd', autoclose: true});
        }, 0);
    }


    //navButtons
    jQuery(grid_selector).jqGrid('navGrid', pager_selector,
            {//navbar options
                edit: false,
                editicon: 'icon-pencil blue',
                add: false,
                addicon: 'icon-plus-sign purple',
                del: false,
                delicon: 'icon-trash red',
                search: false,
                searchicon: 'icon-search orange',
                refresh: false,
                refreshicon: 'icon-refresh green',
                view: false,
                viewicon: 'icon-zoom-in grey',
            },
            {
                //edit record form
                closeAfterEdit: true,
                recreateForm: true,
                beforeShowForm: function (e) {
                    var form = $(e[0]);
                    form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                    style_edit_form(form);
                },
                afterSubmit: function (resp)
                {
                    // you should return from server OK in sucess, any other message on error                               
                }
            },
    {
        //new record form
        closeAfterAdd: true,
        recreateForm: true,
        viewPagerButtons: false,
        beforeShowForm: function (e) {
            var form = $(e[0]);
            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
            style_edit_form(form);
        }
    },
    {
        //delete record form
        recreateForm: true,
        beforeShowForm: function (e) {
            var form = $(e[0]);
            if (form.data('styled'))
                return false;

            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
            style_delete_form(form);

            form.data('styled', true);
        },
        onClick: function (e) {
            alert(1);
        }
    },
    {
        //search form
        closeAfterSearch: true,
        recreateForm: true,
        afterShowSearch: function (e) {
            var form = $(e[0]);
            form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
            style_search_form(form);
        },
        afterRedraw: function () {
            style_search_filters($(this));
        },
        multipleSearch: true,
        multipleGroup: false,
        showQuery: true

    },
    {
        //view record form
        recreateForm: true,
        beforeShowForm: function (e) {
            var form = $(e[0]);
            form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
        }
    }
    )



    function style_edit_form(form) {
        //enable datepicker on "sdate" field and switches for "stock" field
        form.find('input[name=sdate]').datepicker({format: 'yyyy-mm-dd', autoclose: true})
                .end().find('input[name=stock]')
                .addClass('ace ace-switch ace-switch-5').wrap('<label class="inline" />').after('<span class="lbl"></span>');

        //update buttons classes
        var buttons = form.next().find('.EditButton .fm-button');
        buttons.addClass('btn btn-sm').find('[class*="-icon"]').remove();//ui-icon, s-icon
        buttons.eq(0).addClass('btn-primary').prepend('<i class="icon-ok"></i>');
        buttons.eq(1).prepend('<i class="icon-remove"></i>')

        buttons = form.next().find('.navButton a');
        buttons.find('.ui-icon').remove();
        buttons.eq(0).append('<i class="icon-chevron-left"></i>');
        buttons.eq(1).append('<i class="icon-chevron-right"></i>');
    }

    function style_delete_form(form) {
        var buttons = form.next().find('.EditButton .fm-button');
        buttons.addClass('btn btn-sm').find('[class*="-icon"]').remove();//ui-icon, s-icon
        buttons.eq(0).addClass('btn-danger').prepend('<i class="icon-trash"></i>');
        buttons.eq(1).prepend('<i class="icon-remove"></i>')
    }

    function style_search_filters(form) {
        form.find('.delete-rule').val('X');
        form.find('.add-rule').addClass('btn btn-xs btn-primary');
        form.find('.add-group').addClass('btn btn-xs btn-success');
        form.find('.delete-group').addClass('btn btn-xs btn-danger');
    }

    function style_search_form(form) {
        var dialog = form.closest('.ui-jqdialog');
        var buttons = dialog.find('.EditTable')
        buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'icon-retweet');
        buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'icon-comment-alt');
        buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'icon-search');
    }

    function beforeDeleteCallback(e) {
        var form = $(e[0]);
        if (form.data('styled'))
            return false;

        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
        style_delete_form(form);

        form.data('styled', true);
    }

    function beforeEditCallback(e) {
        var form = $(e[0]);
        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
        style_edit_form(form);
    }



    //it causes some flicker when reloading or navigating grid
    //it may be possible to have some custom formatter to do this as the grid is being created to prevent this
    //or go back to default browser checkbox styles for the grid
    function styleCheckbox(table) {
        /**
         $(table).find('input:checkbox').addClass('ace')
         .wrap('<label />')
         .after('<span class="lbl align-top" />')
         
         
         $('.ui-jqgrid-labels th[id*="_cb"]:first-child')
         .find('input.cbox[type=checkbox]').addClass('ace')
         .wrap('<label />').after('<span class="lbl align-top" />');
         */
    }


    //unlike navButtons icons, action icons in rows seem to be hard-coded
    //you can change them like this in here if you want
    function updateActionIcons(table) {
        /**
         var replacement = 
         {
         'ui-icon-pencil' : 'icon-pencil blue',
         'ui-icon-trash' : 'icon-trash red',
         'ui-icon-disk' : 'icon-ok green',
         'ui-icon-cancel' : 'icon-remove red'
         };
         $(table).find('.ui-pg-div span.ui-icon').each(function(){
         var icon = $(this);
         var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
         if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
         })
         */
    }

    //replace icons with FontAwesome icons like above
    function updatePagerIcons(table) {
        var replacement =
                {
                    'ui-icon-seek-first': 'icon-double-angle-left bigger-140',
                    'ui-icon-seek-prev': 'icon-angle-left bigger-140',
                    'ui-icon-seek-next': 'icon-angle-right bigger-140',
                    'ui-icon-seek-end': 'icon-double-angle-right bigger-140'
                };
        $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function () {
            var icon = $(this);
            var $class = $.trim(icon.attr('class').replace('ui-icon', ''));

            if ($class in replacement)
                icon.attr('class', 'ui-icon ' + replacement[$class]);
        })
    }

    function enableTooltips(table) {
        $('.navtable .ui-pg-button').tooltip({container: 'body'});
        $(table).find('.ui-pg-div').tooltip({container: 'body'});
    }

    //var selr = jQuery(grid_selector).jqGrid('getGridParam','selrow');


});
