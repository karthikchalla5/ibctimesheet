<?PHP
include"connection.php";
SESSION_start();
if (isset($_SESSION['emp_id'])) {
    $emp_id = $_SESSION['emp_id'];
    if (isset($_SESSION['designation'])) {
        if ($_SESSION['designation'] != 'Team leader') {
            header("location: ./error-404.php");
        }
    }
} else {
    header("location: ./error-500.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
        <meta charset="utf-8" />
        <title>IBC Timesheet</title>

        <meta name="description" content="Common UI Features &amp; Elements" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- basic styles -->

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />

        <!--[if IE 7]>
        <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
        <![endif]-->

        <!-- page specific plugin styles -->

        <link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css" />
        <link rel="stylesheet" href="assets/css/jquery.gritter.css" />		
        <link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.full.min.css" />
        <link rel="stylesheet" href="assets/css/datepicker.css" />
        <link rel="stylesheet" href="assets/css/ui.jqgrid.css" />        
        <link rel="stylesheet" href="assets/css/chosen.css" />		
        <link rel="stylesheet" href="assets/css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="assets/css/daterangepicker.css" />
        <link rel="stylesheet" href="assets/css/colorpicker.css" />
        <link rel="stylesheet" href="assets/css/dropzone.css" />

        <!-- fonts -->

        <link rel="stylesheet" href="assets/css/ace-fonts.css" />

        <!-- ace styles -->

        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="assets/css/ace-skins.min.css" />


        <!--[if lte IE 8]>
        <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
        <![endif]-->

        <!-- inline styles related to this page -->

        <style>
            .spinner-preview {
                width:100px;
                height:100px;
                text-align:center;
                margin-top:60px;
            }
            .dropdown-preview {
                margin:0 5px;
                display:inline-block;
            }
            .dropdown-preview  > .dropdown-menu {
                display: block;
                position: static;
                margin-bottom: 5px;
            }
            .sidebar:before{
                position: relative;
                background-color: #FFFFFF;
                border: 0px solid #FFF; 
                border-right-width: 0px;
            } 
            .header {           
                border-bottom: 0px solid #CCC;
            }			
        </style>

        <!-- ace settings handler -->

        <script src="assets/js/ace-extra.min.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.js"></script>
        <script src="assets/js/respond.min.js"></script>
<![endif]-->               

    </head>

    <body>
        <div class="navbar navbar-default" id="navbar">
            <script type="text/javascript">
                try {
                    ace.settings.check('navbar', 'fixed')
                } catch (e) {
                }
            </script>
            <div class="navbar-container" id="navbar-container">
                <div class="navbar-header pull-left">
                    <a href="#" class="navbar-brand">
                        <small>
                            <img src="images/g3_logo.png" style="height:50px"> </img>
                        </small>
                    </a><!-- /.brand -->
                </div><!-- /.navbar-header -->
                <div class="navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
                        <li >
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <img class="nav-user-photo" src="assets/avatars/user.jpg" alt="Jason's Photo" />
                                <span class="user-info">
                                    <small>Welcome,</small>
                                    <?PHP
                                    $que = mysqli_query($conn, "select * from employee where employee_id='" . $emp_id . "'");
                                    while ($r = mysqli_fetch_array($que)) {
                                        echo $r['employee_name'];
                                    }
                                    mysqli_free_result($que);
                                    ?>
                                </span>
                                <i class="icon-caret-down"></i>
                            </a>
                            <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

                                <li>
                                    <a id="employee_profile" href="employee_profile.php">
                                        <i class="icon-user"></i>
                                        Profile
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="logout.php">
                                        <i class="icon-off"></i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul><!-- /.ace-nav -->
                </div><!-- /.navbar-header -->
            </div><!-- /.container -->
        </div>

        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try {
                    ace.settings.check('main-container', 'fixed')
                } catch (e) {
                }
            </script>
            <div class="main-container-inner">	
                <div class="page-content">	
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->
                            <div class="row">
                                <div class="col">
                                    <div class="tabbable">
                                        <!-- tab names begins -->
                                        <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab" style="">
                                            <!-- Home tag -->
                                            <li class="active">
                                                <a data-toggle="tab" id="employee_home_anchor" href="#employee_home">
                                                    <i class="green icon-home bigger-110"></i>
                                                    Home                                                                                                                                                            
                                                </a>
                                            </li>	
                                            <!-- Task tag -->
                                            <li class="dropdown">
                                                <a data-toggle="dropdown" class="dropdown-toggle" href="">
                                                    <i class="green icon-user bigger-110"></i>
                                                    Tasks &nbsp;
                                                    <i class="icon-caret-down bigger-110 width-auto"></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-info">
                                                    <li>
                                                        <a data-toggle="modal" id="add_task_user_anchor" href="#add_task" onclick="document.add_task_form.reset();
                                                                document.getElementById('error3').classList.add('hidden');
                                                                document.getElementById('success3').classList.add('hidden');">Add Task</a>
                                                    </li>

                                                    <li>
                                                        <a data-toggle="tab" id="manage_task_user_anchor" href="#manage_task" onclick="document.assign_project_form.reset();
                                                                document.getElementById('error7').classList.add('hidden');
                                                                document.getElementById('success7').classList.add('hidden');">Manage Tasks</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" id="assign_task_user_anchor" href="#assign_task" onclick="document.assign_task_form.reset();
                                                                document.getElementById('error4').classList.add('hidden');
                                                                document.getElementById('success4').classList.add('hidden');">Assign Task to user</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>

                                        <!-- tab names ends -->
                                        <!-- tab content begins -->
                                        <div class="tab-content">
                                            <!-- Home tag content begins -->
                                            <div id="employee_home" class="tab-pane in active" align="center">                                                 
                                                <div class="row">
                                                    <div class="col-sm-3" >
                                                        <div class="widget-box" >

                                                            <div class="widget-header">
                                                                <h4>
                                                                    Search Filters
                                                                </h4>
                                                                <div class="widget-toolbar no-border">
                                                                    <label>
                                                                        AutoSearch<input type="checkbox" id="autosearch" class="ace ace-switch ace-switch-3">
                                                                        <span class="lbl"></span>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="widget-body"> 

                                                                <div class="widget-main" id="project_employee_form" style="text-align:left;">                                                                    
                                                                    <label>Project Name:</label>
                                                                    <div class="row">
                                                                        <div class="col-xs-8 col-sm-11">
                                                                            <select class="form-control" id="employee_project_name" name="employee_project_name">
                                                                                <option value="">All</option>
                                                                            </select>
                                                                        </div>    
                                                                    </div>

                                                                    <hr>

                                                                    <label>Priority:</label>
                                                                    <div class="row">
                                                                        <div class="col-xs-8 col-sm-11">
                                                                            <select class="form-control" id="employee_priority" name="employee_priority">
                                                                                <option value="">All</option>
                                                                                <option value="Low">Low</option>
                                                                                <option value="Medium">Medium</option>
                                                                                <option value="High">High</option>
                                                                                <option value="Urgent">Urgent</option>
                                                                            </select>																		
                                                                        </div>
                                                                    </div>                                                                    

                                                                    <hr>

                                                                    <label>Date range</label>
                                                                    <div class="row">																	
                                                                        <div class="col-xs-8 col-sm-11">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon">
                                                                                    <i class="icon-calendar bigger-110"></i>
                                                                                </span>
                                                                                <input class="form-control" type="text" name="date_range" id="date_range">
                                                                            </div>
                                                                        </div>                                                                    
                                                                    </div>

                                                                    <hr>


                                                                    <label>Status:</label> 
                                                                    <div class="row">                                                                    
                                                                        <div class="col-xs-8 col-sm-11">
                                                                            <select class="form-control" id="employee_status" name="employee_status">
                                                                                <option value="">All</option>
                                                                                <option value="unassigned">Unassigned</option>
                                                                                <option value="assigned">Assigned</option>
                                                                                <option value="inprogress">Inprogress</option>
                                                                                <option value="completed">Completed</option>
                                                                                <option value="onhold">Onhold</option>
                                                                            </select>																		
                                                                        </div>
                                                                    </div>

                                                                    <hr>

                                                                    <div class="center">
                                                                        <button id="employee_search" class="btn btn-sm btn-success">
                                                                            Search
                                                                            <i class="icon-arrow-right icon-on-right bigger-110"></i>
                                                                        </button>
                                                                        <button type="reset" id="employee_search_clear" class="btn btn-sm btn-success">
                                                                            Reset
                                                                            <i class="icon-undo icon-on-undo bigger-110"></i>
                                                                        </button>
                                                                    </div>                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="widget-box">
                                                            <div class="widget-header widget-header-flat">
                                                                <h4 class="smaller">
                                                                    Project Task Details
                                                                </h4>
                                                            </div>

                                                            <div class="widget-body">
                                                                <div class="widget-main no-padding">
                                                                    <table id="employee-grid-table"></table>
                                                                    <div id="employee-grid-pager"></div>                                                        
                                                                    <script type="text/javascript">
                                                                        var $path_base = "/";//this will be used in gritter alerts containing images
                                                                    </script>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                                    
                                            </div>
                                            <!-- Home tag content ends -->											
                                            <!-- Modal Content Begins-->
                                            <div id="task_status" class="modal fade" tabindex="-1">
                                                <form id="task_status_form" name="task_status_form" method="POST" style="text-align:center">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="blue bigger" style="align:center"><b>Task Status</b></h4>
                                                            </div>
                                                            <div class="modal-body overflow-visible">
                                                                <div class="row">
                                                                    <div class="col-sm-2" ></div>
                                                                    <div class="col-sm-4" style="text-align:left"><label><b>Project Name<span class="red">*</span>:</b></label>
                                                                        <br>
                                                                        <input type="text" id="project_name" style="width:370px;"  value=""  name="project_name" readonly autocomplete="on"/>
                                                                        <input type="hidden" id="project_id"   value="" name="project_id"/>
                                                                    </div>
                                                                </div>
                                                                <div class="space-4"></div>
                                                                <div class="row">
                                                                    <div class="col-sm-2" ></div>
                                                                    <div class="col-sm-4" style="text-align:left"><label><b>Task Name<span class="red">*</span>:</b></label>
                                                                        <br>
                                                                        <textarea type="text" style="width:370px;" id="task_name" value="" name="task_name" readonly autocomplete="on"></textarea>
                                                                        <input type="hidden" id="task_id" value="" name="task_id"/>
                                                                    </div>
                                                                    <div class="col-sm-2" ></div>
                                                                </div>						
                                                                <div class="space-4"></div>
                                                                <div class="row">
                                                                    <div class="col-sm-2" ></div>
                                                                    <div class="col-sm-8" style="text-align:left"><label><b>Note</b></label>
                                                                        <br>
                                                                        <textarea  id="note"  style="width:370px;"  name="note" value="" placeholder="Note" autocomplete="on"></textarea>
                                                                    </div>
                                                                    <div class="col-sm-2" ></div>
                                                                </div>						
                                                                <div class="space-4"></div>
                                                                <div class="row">
                                                                    <div class="col-sm-2" ></div>
                                                                    <div class="col-sm-3" style="text-align:left"><label><b>Date<span class="red">*</span>:</b></label>
                                                                        <br>
                                                                        <input type="text" id="date"   name="date" value="<?PHP echo date("Y-m-d") ?>" style="width:100px;" readonly autocomplete="on"/>
                                                                    </div>
                                                                    <div class="col-sm-1" ></div>
                                                                    <div class="col-sm-4" style="text-align:left"><label><b>Time<span class="red">*</span>:</b></label>
                                                                        <br>
                                                                        <select id="hours"   name="hours" autocomplete="on"/>
                                                                        <option value="">HH   </option>
                                                                        <?PHP
                                                                        for ($i = 0; $i <= 24; $i = $i + 1) {
                                                                            $value = $i;
                                                                            ?>
                                                                            <option value="<?PHP echo $value ?>"><?PHP echo $i ?></option>
                                                                            <?PHP
                                                                        }
                                                                        ?>															
                                                                        </select>

                                                                        <select id="minutes"   name="minutes" autocomplete="on"/>
                                                                        <option value="00">MM   </option>
                                                                        <?PHP
                                                                        for ($i = 0; $i <= 60; $i = $i + 5) {
                                                                            if ($i < 10) {
                                                                                $value = $i = "0" . $i;
                                                                            } else {
                                                                                $value = $i;
                                                                            }
                                                                            ?>
                                                                            <option value="<?PHP echo $value ?>"><?PHP echo $i ?></option>
                                                                            <?PHP
                                                                        }
                                                                        ?>															
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-2" ></div>
                                                                </div>
                                                                <div class="space-4"></div>
                                                                <div class="row">
                                                                    <div class="col-sm-2" ></div>
                                                                    <div class="col-sm-4" style="text-align:left"><label><b>Type<span class="red">*</span>:</b></label>
                                                                        <br>
                                                                        <select id="type" name="type" autocomplete="on">
                                                                            <option value="">Select</option>
                                                                            <option value="coding">Coding</option>
                                                                            <option value="analysis">Analysis</option>
                                                                            <option value="testing">Testing</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-4" style="text-align:left" id="status"><label><b>Status</b></label>
                                                                        <br>
                                                                        <select id="status" name="status" autocomplete="on">
                                                                            <option value="inprogress">Inprogress</option>
                                                                            <option value="completed">Completed</option>																			
                                                                            <option value="onhold">Onhold</option>																			
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-4" ></div>																	
                                                                </div>
                                                                <div class="space-12"></div>
                                                                <div class="row">
                                                                    <div class="col-sm-2" ></div>
                                                                    <div class="col-sm-10" style="text-align:left">
                                                                        <div id="mail_password" class="hidden" ><label><b>Official mail id Password<span class="red">*</span>:</b></label>
                                                                            <input type="password" id="employee_mail_password"   value="" name="employee_mail_password" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="space-4"></div>
                                                                <div id="spinning" class="row hidden">
                                                                    <h3 class="header smaller lighter grey">
                                                                        Processing Request. . 
                                                                        <i class="icon-spinner icon-spin orange bigger-125"></i>                                                            
                                                                    </h3>
                                                                </div>                                                            
                                                                <div class="space-4"></div>
                                                                <div id="error8" class="error-block alert alert-danger hidden">
                                                                    <i class="icon-remove"></i> <span class="message">  </span>
                                                                </div> 
                                                                <div id="success8" class="alert alert-block alert-success hidden">
                                                                    <button type="button" class="close" data-dismiss="alert">
                                                                        <i class="icon-remove"></i>
                                                                    </button>

                                                                    <p>
                                                                        <span class="message">  </span>
                                                                    </p>                                                       
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">  
                                                                <button class="btn btn-sm" data-dismiss="modal">
                                                                    <i class="icon-remove"></i>
                                                                    Cancel
                                                                </button>
                                                                <button class="btn btn-sm btn-primary">
                                                                    <i class="icon-ok"></i>
                                                                    Save
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- Modal Content Ends-->
                                            <!-- Task tag content begins -->
                                            <!-- add_task begins-->
                                            <div class="tab-pane">
                                                <!-- modal begins-->
                                                <div id="add_task" class="modal fade" tabindex="-1">
                                                    <form id="add_task_form" name="add_task_form" method="POST" style="text-align:center">
                                                        <div class="modal-dialog" style="width:100%;">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h3 class="blue bigger"><b>New Task</b></h3>
                                                                </div>
                                                                <div class="modal-body overflow-visible">
                                                                    <!-- Modal Tab begins -->        
                                                                    <div class="row">                                                                    
                                                                        <div class="col-sm-1" style="text-align:left"><label><b>Project<span class="red">*</span>: </b></label></div>
                                                                        <div class="col-sm-8" style="text-align:left" >
                                                                            <select style="width:500px; height:31px;" id="project_id" name="project_id">
                                                                                <option value="">Select</option>
                                                                                <?PHP
                                                                                $query = "select * from project where project_id IN (select project_id from project_employee WHERE role = 2 AND employee_id = " . $emp_id . ")";
                                                                                if ($stmt = mysqli_query($conn, $query)) {
                                                                                    while ($row = mysqli_fetch_array($stmt)) {
                                                                                        $project_value = $row['project_id'];
                                                                                        $project_name = $row['project_name'];
                                                                                        ?>
                                                                                        <option value="<?PHP echo $project_value ?>"><?PHP echo $project_name ?></option>
                                                                                        <?PHP
                                                                                    }
                                                                                    mysqli_free_result($stmt);
                                                                                } else {
                                                                                    echo mysqli_error($conn);
                                                                                }
                                                                                ?>															
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="space-4"></div>
                                                                    <div class="row">
                                                                        <div class="tabbable">
                                                                            <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab">
                                                                                <li class="active">
                                                                                    <a data-toggle="tab" href="#general">
                                                                                        <i class="green icon-edit bigger-110"></i>
                                                                                        General
                                                                                    </a>
                                                                                </li>

                                                                                <li>
                                                                                    <a data-toggle="tab" href="#time">
                                                                                        <i class="green icon-time"></i>
                                                                                        Time                                                                                    
                                                                                    </a>
                                                                                </li>

                                                                                <!--<li>
                                                                                    <a data-toggle="tab" href="#attachments">
                                                                                        <i class="green icon-file"></i>
                                                                                        Attachments                                                                                    
                                                                                    </a> 
                                                                                </li> -->
                                                                            </ul>
                                                                            <div class="tab-content">
                                                                                <div id="general" class="tab-pane in active">
                                                                                    <!-- General Content begins -->                                                                                       
                                                                                    <div class="space-4"></div>
                                                                                    <div class="row">
                                                                                        <div class="col-sm-3" ></div>					
                                                                                        <div class="col-sm-1" style="text-align:left"><label><b>Name<span class="red">*</span>:</b> </label></div>
                                                                                        <div class="col-sm-8" style="text-align:left" >
                                                                                            <input type="text" id="form-field-2"  style="width:300px; height:31px;" name="name" placeholder="Name " autocomplete="on"/>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="space-4"></div>
                                                                                    <div class="row">
                                                                                        <div class="col-sm-3" ></div>						
                                                                                        <div class="col-sm-1" style="text-align:left"><label><b>Status:</b></label></div>
                                                                                        <div class="col-sm-8" style="text-align:left" >
                                                                                            <input type="text" id="form-field-3"  style="width:190px; height:31px;" name="status" value="Unassigned" placeholder="Unassigned " autocomplete="on" readonly/>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="space-4"></div>
                                                                                    <div class="row">
                                                                                        <div class="col-sm-3" ></div>						
                                                                                        <div class="col-sm-1" style="text-align:left"><label><b>Priority:</b></label></div>
                                                                                        <div class="col-sm-8" style="text-align:left" >
                                                                                            <select id="form-field-icon-4" style="width:190px; height:31px;" name="priority">
                                                                                                <option value="Unknown">Unknown   </option>
                                                                                                <option value="Low">Low</option>
                                                                                                <option value="Medium">Medium</option>
                                                                                                <option value="High">High</option>																
                                                                                                <option value="Urgent">Urgent</option>																
                                                                                            </select>				
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="space-4"></div>                                                                                       
                                                                                    <div class="row">
                                                                                        <div class="col-sm-3" ></div>						
                                                                                        <div class="col-sm-1" style="text-align:left"><label><b>Description:</b></label></div>
                                                                                        <div class="col-sm-8" style="text-align:left" >	
                                                                                            <!-- wysiwyg begins -->                                                                                                                                                                                   

                                                                                            <div class="wysiwyg-editor" id="editor1" name="description"></div>

                                                                                            <!-- wysiwyg ends -->
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- General Content ends -->
                                                                                </div>
                                                                                <div id="time" class="tab-pane">
                                                                                    <!-- Time Content ends -->
                                                                                    <div class="row">
                                                                                        <div class="col-sm-3" ></div>
                                                                                        <div class="col-sm-1" style="text-align:left"><label><b>Estimated Time:</b></label></div>
                                                                                        <div class="col-sm-8" style="text-align:left" >
                                                                                            <input type="text" id="form-field-7"  style="width:150px; height:31px;" name="estimated_time" placeholder="Estimated Time" autocomplete="on"/>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="space-4"></div>
                                                                                    <div class="row">
                                                                                        <div class="col-sm-3" ></div>
                                                                                        <div class="col-sm-1" style="text-align:left"><label><b>Start Date:</b></label></div>
                                                                                        <div class="col-sm-8" style="text-align:left" >
                                                                                            <input type=date id="form-field-8" style="width:150px; height:31px;" name="start_date" data-date-format="yyyy-mm-dd"> 
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="space-4"></div>
                                                                                    <div class="row">
                                                                                        <div class="col-sm-3" ></div>
                                                                                        <div class="col-sm-1" style="text-align:left"><label><b>Due Date:</b></label></div>
                                                                                        <div class="col-sm-8" style="text-align:left" >
                                                                                            <input type=date id="form-field-9" style="width:150px; height:31px;" name="due_date" data-date-format="yyyy-mm-dd">                                                                                                   
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="space-4"></div>
                                                                                    <div class="row">
                                                                                        <div class="col-sm-3" ></div>
                                                                                        <div class="col-sm-1" style="text-align:left"><label><b>Progress:</b></label></div>
                                                                                        <div class="col-sm-8" style="text-align:left" >
                                                                                            <select style="width:150px; height:31px;" id="form-field-10" name="progress">
                                                                                                <option value="">Select   </option>
<?PHP
for ($i = 0; $i <= 100; $i = $i + 5) {
    $value = $i;
    ?>
                                                                                                    <option value="<?PHP echo $value ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?PHP echo $i . "%" ?></option>
                                                                                                    <?PHP
                                                                                                }
                                                                                                ?>															
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- Time Content ends -->
                                                                                </div>
                                                                                <div id="attachments" class="tab-pane">
                                                                                    <!-- Attachments Content Begins -->
                                                                                    <div class="dropzone" id="dropzone" name="dropzone">
                                                                                        <div class="fallback">
                                                                                            <input name="file" type="file" multiple=""/>  
                                                                                        </div>                            
                                                                                    </div>
                                                                                    <!-- Attachments Content ends -->
                                                                                </div>                                                                                      
                                                                            </div>
                                                                        </div> 
                                                                    </div>
                                                                    <div class="space-4"></div>
                                                                    <div id="error3" class="error-block alert alert-danger hidden">
                                                                        <i class="icon-remove"></i> <span class="message">  </span>
                                                                    </div> 
                                                                    <div id="success3" class="alert alert-block alert-success hidden">
                                                                        <button type="button" class="close" data-dismiss="alert">
                                                                            <i class="icon-remove"></i>
                                                                        </button>

                                                                        <p>
                                                                            <span class="message">  </span>
                                                                        </p>                                                       
                                                                    </div>
                                                                    <!-- Modal Tab ends -->
                                                                </div>                                                                
                                                                <div class="modal-footer">  
                                                                    <button class="btn btn-sm" data-dismiss="modal">
                                                                        <i class="icon-remove"></i>
                                                                        Cancel
                                                                    </button>
                                                                    <button class="btn btn-sm btn-primary">
                                                                        <i class="icon-ok"></i>
                                                                        Save
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- modal ends-->
                                            </div> 
                                            <!-- add_task ends-->
                                            <!-- manage_task begins-->
                                            <div id="manage_task" class="tab-pane">
                                                <br>
                                                <div class="row" style="text-align:center">
                                                    <div id="error7" class="error-block alert alert-danger hidden">
                                                        <i class="icon-remove"></i> <span class="message">  </span>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row" style="text-align:center">
                                                    <div id="success7" class="alert alert-block alert-success hidden">
                                                        <button type="button" class="close" data-dismiss="alert">
                                                            <i class="icon-remove"></i>
                                                        </button>

                                                        <p>
                                                            <span class="message">  </span>
                                                        </p>                                                       
                                                    </div>	
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <table id="task-grid-table"></table>
                                                        <div id="task-grid-pager"></div>                                                        
                                                        <script type="text/javascript">
                                                            var $path_base = "/";//this will be used in gritter alerts containing images
                                                        </script>                                                                                                    
                                                    </div>
                                                </div>
                                            </div> 
                                            <!-- manage task ends-->
                                            <!-- Assign Task begins -->
                                            <div id="assign_task" class="tab-pane">
                                                <form id="assign_task_form" name="assign_task_form" method="post" style="text-align:center" >
                                                    <div id="task_det" class="control-group" >
                                                        <div class="row">
                                                            <h3 align="center"><b>Asign Task To Employee</b></h3>
                                                        </div>														
                                                        <br>
                                                        <div class="row" >
                                                            <div class="col-sm-3" ></div>
                                                            <div class="col-sm-1"style="text-align:left" ><label><b>Project :</b></label></div>
                                                            <div class="col-sm-5" style="text-align:left" >
                                                                <select style="width:100%; height:31px;" id="assign_project_task_id" name="assign_project_task_id" >
                                                                    <option value="">Select</option>
<?PHP
$query = "select * from project where project_id IN (select project_id from project_employee WHERE role = 2 AND employee_id = " . $emp_id . ")";
if ($stmt = mysqli_query($conn, $query)) {
    while ($row = mysqli_fetch_array($stmt)) {
        $project_value = $row['project_id'];
        $project_name = $row['project_name'];
        ?>
                                                                            <option value="<?PHP echo $project_value ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?PHP echo $project_name ?></option>
                                                                            <?PHP
                                                                        }
                                                                        mysqli_free_result($stmt);
                                                                    }
                                                                    ?>															
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-3" ></div>
                                                        </div>
                                                        <div class="space-4"></div>
                                                        <div class="row" >
                                                            <div class="col-sm-3" ></div>
                                                            <div class="col-sm-1"style="text-align:left" ><label><b>Task :</b></label></div>
                                                            <div class="col-sm-5" style="text-align:left" >
                                                                <select style="width:100%; height:31px;" id="assign_task_id" name="assign_task_id" >																																															
                                                                    <option value="">Select   </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-3" ></div>
                                                        </div>	
                                                        <br>
                                                        <div class="space-4"></div> 
                                                        <div class="row" >
                                                            <div class="col-sm-4"></div>
                                                            <div class="col-sm-4" style="text-align:center">
                                                                <button class="btn btn-info" type="submit">
                                                                    <i class="icon-ok bigger-110"></i>
                                                                    Submit
                                                                </button>	
                                                            </div>
                                                            <div class="col-sm-4"></div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-sm-3"></div>
                                                            <div class="col-sm-6" style="text-align:left">
                                                                <div class="widget-box">
                                                                    <div style="text-align:center" class="widget-header header-color-blue">
                                                                        <h5 class="bigger lighter">Employee Details</h5>	
                                                                    </div> 
                                                                    <div class="widget-body">
                                                                        <div class="widget-main no-padding">
                                                                            <table class="table table-striped table-bordered table-hover">
                                                                                <thead class="thin-border-bottom">
                                                                                    <tr>
                                                                                        <th style="text-align:center"><b>Name</b></th>
                                                                                        <th style="text-align:center"><b>Designation</b></th>																						
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody  id="dynamic_checkbox"></tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>	
                                                            <div class="col-sm-3"></div>
                                                        </div>
                                                        <br>
                                                        <div class="space-4"></div> 
                                                        <div class="row" >
                                                            <div class="col-sm-4"></div>
                                                            <div class="col-sm-4" style="text-align:center">
                                                                <button class="btn btn-info" type="submit">
                                                                    <i class="icon-ok bigger-110"></i>
                                                                    Submit
                                                                </button>	
                                                            </div>
                                                            <div class="col-sm-4"></div>
                                                        </div>
                                                    </div>
                                                    <div class="space-4"></div>
                                                    <div id="spinning3" class="row hidden">
                                                        <h3 class="header smaller lighter grey">
                                                            Processing Request. . 
                                                            <i class="icon-spinner icon-spin orange bigger-125"></i>                                                            
                                                        </h3>
                                                    </div>
                                                    <br>                                                    
                                                    <div id="error4" class="error-block alert alert-danger hidden">
                                                        <i class="icon-remove"></i> <span class="message">  </span>
                                                    </div> 
                                                    <div id="success4" class="alert alert-block alert-success hidden">
                                                        <button type="button" class="close" data-dismiss="alert">
                                                            <i class="icon-remove"></i>
                                                        </button>

                                                        <p>
                                                            <span class="message">  </span>
                                                        </p>                                                       
                                                    </div> <!-- project detc -->
                                                </form>
                                            </div> 
                                            <!-- Assign Task Ends -->
                                            <!-- tab content ends -->
                                        </div><!-- tab content -->								
                                    </div> <!-- tabbable -->								 
                                </div><!-- /cols -->
                            </div><!-- /row -->
                            <!-- PAGE CONTENT ENDS -->						
                        </div><!-- col -->						
                    </div> <!-- row -->				
                </div><!-- page-content -->				
            </div><!-- page-content -->	
            <div class="footer " align="right">
                <div class="footer-inner">
                    <div class="footer-content">
                        <span class="bigger">
                            <span class="blue bolder">Ideabytes Credential TimeSheet</span>
                            Application © 2015-2016
                        </span>                   
                    </div>
                </div>
            </div>
        </div><!-- main-container-inner -->
    </div><!-- /.main-container -->
    <!-- basic scripts -->
    <!--[if !IE]> -->
    <script type="text/javascript">
        window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>" + "<" + "/script>");
    </script>
    <!-- <![endif]-->
    <!--[if IE]>
            <script type="text/javascript">
            window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
            </script>
    <![endif]-->
    <script type="text/javascript">
        if ("ontouchend" in document)
            document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
    </script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/typeahead-bs2.min.js"></script>

    <!-- page specific plugin scripts -->

    <script src="assets/js/date-time/bootstrap-datepicker.min.js"></script>
    <script src="assets/js/jqGrid/jquery.jqGrid.min.js"></script>
    <script src="assets/js/jqGrid/i18n/grid.locale-en.js"></script>
    <!--[if lte IE 8]>
            <script src="assets/js/excanvas.min.js"></script>
    <![endif]-->
    <script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
    <script src="assets/js/bootbox.min.js"></script>
    <script src="assets/js/jquery.easy-pie-chart.min.js"></script>
    <script src="assets/js/jquery.gritter.min.js"></script>
    <script src="assets/js/spin.min.js"></script>
    <script src="assets/js/markdown/markdown.min.js"></script>
    <script src="assets/js/markdown/bootstrap-markdown.min.js"></script>
    <script src="assets/js/jquery.hotkeys.min.js"></script>
    <script src="assets/js/bootstrap-wysiwyg.min.js"></script>
    <script src="assets/js/dropzone.min.js"></script>
    <script src="assets/js/date-time/moment.min.js"></script>
    <script src="assets/js/date-time/daterangepicker.min.js"></script>


    <!-- ace scripts -->

    <script src="assets/js/ace-elements.min.js"></script>
    <script src="assets/js/ace.min.js"></script>

    <!-- inline scripts related to this page -->

    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="js/employee_jqgrid.js"></script>
    <script src="js/task_status.js"></script>
    <script src="js/ajax_calls_all.js"></script>    
    <script src="js/task_form_validations.js"></script>
    <script src="js/tl_tasks_jqgrid.js"></script>
    <script src="js/task_modal.js"></script>
    <script src="js/task_employee.js"></script>
    <script src="js/jquery.multi-select.js"></script>     
    <!-- end basic script code -->

</body>
</html>
