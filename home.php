<?PHP
include"connection.php";
SESSION_start();
if (isset($_SESSION['emp_id'])) {
    $emp_id = $_SESSION['emp_id'];
    if (isset($_SESSION['designation'])) {
        if ($_SESSION['designation'] != 'Admin') {
            if ($_SESSION['deignation'] != 'Manager') {
                header("location: ./error-404.php");
            }
        }
    }
} else {
    echo "mahesh";
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
                            <img src="images/g3_logo.png" style="height:70px"> </img>
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
                                                <a data-toggle="tab" href="#home">
                                                    <i class="green icon-home bigger-110"></i>
                                                    Home                                                                                                                                                            
                                                </a>
                                            </li>
                                            <!-- User tag -->
                                            <li class="dropdown">
                                                <a data-toggle="dropdown" class="dropdown-toggle" href="">
                                                    <i class="green icon-user bigger-110"></i>
                                                    Users &nbsp;
                                                    <i class="icon-caret-down bigger-110 width-auto"></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-info">
                                                    <li>
                                                        <a data-toggle="tab" id="add_employee_anchor" href="#add_employee" onclick="document.add_employee_form.reset();
                                                                document.getElementById('error').classList.add('hidden');
                                                                document.getElementById('success').classList.add('hidden');">Add User</a>
                                                    </li>

                                                    <li>
                                                        <a data-toggle="tab" id="manage_employee_anchor" href="#manage_employee" onclick="document.getElementById('error6').classList.add('hidden');
                                                                document.getElementById('success6').classList.add('hidden');">Manage Users</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <!-- Project tag -->
                                            <li class="dropdown">
                                                <a data-toggle="dropdown" class="dropdown-toggle" href="">
                                                    <i class="green icon-user bigger-110"></i>
                                                    Project &nbsp;
                                                    <i class="icon-caret-down bigger-110 width-auto"></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-info">
                                                    <li>
                                                        <a data-toggle="tab" id="add_project_anchor" href="#add_project" onclick="document.add_project_form.reset();
                                                                document.getElementById('error1').classList.add('hidden');
                                                                document.getElementById('success1').classList.add('hidden');">Add Project</a>
                                                    </li>

                                                    <li>
                                                        <a data-toggle="tab" id="manage_project_anchor" href="#manage_project" onclick="document.getElementById('error5').classList.add('hidden');
                                                                document.getElementById('success5').classList.add('hidden');">Manage Projects</a>
                                                    </li>

                                                    <li>
                                                        <a data-toggle="tab" id="assign_project_user_anchor" href="#assign_project" onclick="document.assign_project_form.reset();
                                                                document.getElementById('error2').classList.add('hidden');
                                                                document.getElementById('success2').classList.add('hidden');">Assign project to user</a>
                                                    </li>
                                                </ul>
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
                                            <div id="home" class="tab-pane in active" align="center"> 
                                            <!-- <img src="images/logo.jpg" > </img>                                            -->
                                            </div> 
                                            <!-- Home tag content ends -->
                                            <!-- User tag content begins -->
                                            <!-- add_employee begins-->
                                            <div id="add_employee" class="tab-pane">
                                                <form id="add_employee_form" name="add_employee_form" method="post" style="text-align:center">
                                                    <div id="Emp_det" class="control-group" >
                                                        <h3 align="center"><b>User Details</b></h3>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-sm-2" style="text-align:left"><label class="control-label" ><b> Employee Name <span class="red">*</span>: </b></label></div>
                                                            <div class="col-sm-2" style="text-align:left"><input type="text" id="form-field-1"  name="name" placeholder="Employee Name " autocomplete="on"/></div>
                                                            <div class="col-sm-2" style="text-align:left"><label class="control-label"><b>Designation <span class="red">*</span>: </b></label></div>
                                                            <div class="col-sm-2" style="text-align:left"><select id="form-field-icon-2" style="width:168px; height:31px;" name="designation">
                                                                    <option value="">Select   </option>
<?PHP
$query = "select * from designation ";
if ($stmt = mysqli_query($conn, $query)) {
    while ($row = mysqli_fetch_array($stmt)) {
        $desg_value = $row['designation_id'];
        $desg_name = $row['designation'];
        ?>
                                                                            <option value="<?PHP echo $desg_value ?>"><?PHP echo $desg_name ?></option>
                                                                            <?PHP
                                                                        }
                                                                        mysqli_free_result($stmt);
                                                                    }
                                                                    ?>															
                                                                </select></div>
                                                            <div class="col-sm-2" style="text-align:left"><label class="control-label"> <b>Employee ID <span class="red" >*</span>:</b> </label></div>
                                                            <div class="col-sm-2" style="text-align:left"><input type="text" id="form-field-3"  name="empid" placeholder="Employee ID " autocomplete="on"/></div>

                                                        </div>
                                                        <div class="space-4"></div> 
                                                        <div class="row">
                                                            <div class="col-sm-2" style="text-align:left"><label class="control-label"><b> Official Email :</b> </label></div>
                                                            <div class="col-sm-2" style="text-align:left"><input type="email" id="form-field-4"  name="off_mail_id" placeholder="Official Email ID " /></div>
                                                            <div class="col-sm-2" style="text-align:left"><label class="control-label"><b> Personal Email <span class="red">*</span>:</b> </label>                                                            </div>
                                                            <div class="col-sm-2" style="text-align:left"><input type="email" id="form-field-5" name="prsnl_mail_id" placeholder="Personal Email ID "/></div>
                                                            <div class="col-sm-2" style="text-align:left"><label class="control-label"><b> Phone Number <span class="red">*</span>: </b></label>                                                            </div>
                                                            <div class="col-sm-2" style="text-align:left"><input type="number" id="form-field-6" name="number" placeholder="Employee Number " /></div>
                                                        </div>
                                                        <div class="space-4"></div> 
                                                        <div class="row">
                                                            <div class="col-sm-2" style="text-align:left"><label class="control-label"><b> Address <span class="red">*</span>:</b> </label> </div>
                                                            <div class="col-sm-2" style="text-align:left"><textarea  id="form-field-7"  name="address" placeholder="Employee Address "></textarea></div>
                                                        </div>
                                                        <div class="space-4"></div> 
                                                        <div class="row" style="text-align:center">
                                                            <button class="btn btn-info" type="submit">
                                                                <i class="icon-ok bigger-110"></i>
                                                                ADD
                                                            </button>
                                                            <button class="btn" type="reset">
                                                                <i class="icon-undo bigger-110"></i>
                                                                Reset
                                                            </button>
                                                        </div>														
                                                    </div>  <!-- Emp_det -->
                                                    <br>
                                                    <div class="space-4"></div>
                                                    <div id="spinning" class="row hidden">
                                                        <h3 class="header smaller lighter grey">
                                                            Processing Request. . 
                                                            <i class="icon-spinner icon-spin orange bigger-125"></i>                                                            
                                                        </h3>
                                                    </div>
                                                    <br>  
                                                    <div id="error" class="error-block alert alert-danger hidden">
                                                        <i class="icon-remove"></i> <span class="message">  </span>
                                                    </div> 
                                                    <div id="success" class="alert alert-block alert-success hidden">
                                                        <button type="button" class="close" data-dismiss="alert">
                                                            <i class="icon-remove"></i>
                                                        </button>

                                                        <p>
                                                            <span class="message">  </span>
                                                        </p>                                                       
                                                    </div>	
                                                </form>
                                            </div> 
                                            <!-- add_employee ends-->
                                            <!-- manage employee begins -->
                                            <div id="manage_employee" class="tab-pane">
                                                <br>
                                                <div class="row" style="text-align:center">
                                                    <div id="error6" class="error-block alert alert-danger hidden">
                                                        <i class="icon-remove"></i> <span class="message">  </span>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row" style="text-align:center">
                                                    <div id="success6" class="alert alert-block alert-success hidden">
                                                        <button type="button" class="close" data-dismiss="alert">
                                                            <i class="icon-remove"></i>
                                                        </button>

                                                        <p>
                                                            <span class="message">  </span>
                                                        </p>                                                       
                                                    </div>	
                                                </div>		
                                                <br>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table id="grid-table"></table>
                                                        <div id="grid-pager"></div>                                                        
                                                        <script type="text/javascript">
                                                            var $path_base = "/";//this will be used in gritter alerts containing images
                                                        </script>                                                                                                    
                                                    </div>
                                                </div>
                                            </div> 
                                            <!-- manage employee ends -->												
                                            <!-- Project tag content begins -->
                                            <!-- add_project begins-->
                                            <div id="add_project" class="tab-pane">
                                                <form id="add_project_form" name="add_project_form" method="post" style="text-align:center" >
                                                    <div id="Project_det" class="control-group" >
                                                        <h3 align="center"><b>Project Details</b></h3>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-sm-2" style="text-align:left"><label class="control-label" ><b> Project Manager <span class="red">*</span>: </b></label></div>
                                                            <div class="col-sm-2" style="text-align:left">
                                                                <select id="form-field-icon-7" style="width:168px; height:31px;" name="project_manager">
                                                                    <option value="">Select   </option>
<?PHP
$query = "select * from employee where designation_id='3' OR designation_id='4'";
if ($stmt = mysqli_query($conn, $query)) {
    while ($row = mysqli_fetch_array($stmt)) {
        $emp_value = $row['employee_id'];
        $emp_name = $row['employee_name'];
        ?>
                                                                            <option value="<?PHP echo $emp_value ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?PHP echo $emp_name ?></option>
                                                                            <?PHP
                                                                        }
                                                                        mysqli_free_result($stmt);
                                                                    }
                                                                    ?>															
                                                                </select></div>
                                                        </div>
                                                        <div class="space-12"></div> 														
                                                        <div class="row">
                                                            <div class="col-sm-2" style="text-align:left"><label class="control-label" ><b> Project Name <span class="red">*</span>: </b></label></div>
                                                            <div class="col-sm-2" style="text-align:left"><input type="text" id="form-field-1" name="pname" placeholder="Project Name "/></div>
                                                            <div class="col-sm-2" style="text-align:left"><label class="control-label"> <b>Client Name :</b> </label></div>
                                                            <div class="col-sm-2" style="text-align:left"><input type="text" id="form-field-2" name="cname" placeholder="Client Name "/></div>
                                                            <div class="col-sm-2" style="text-align:left"><label class="control-label"><b> Client Email :</b> </label></div>
                                                            <div class="col-sm-2" style="text-align:left"><input type="email" id="form-field-3" name="clnt_mail_id" placeholder="Client Email ID " /></div>
                                                        </div>
                                                        <div class="space-4"></div> 
                                                        <div class="row">
                                                            <div class="col-sm-2" style="text-align:left"><label class="control-label"><b> Client Phone Number : </b></label></div>
                                                            <div class="col-sm-2" style="text-align:left"><input type="number" id="form-field-4" name="clnt_number" placeholder="Client Number " /></div>
                                                            <div class="col-sm-2" style="text-align:left"><label class="control-label"><b> Start Date <span class="red">*</span>:</b> </label></div>
                                                            <div class="col-sm-2" style="text-align:left"><input type=date id="form-field-5" name="start_date" jan=1 min=2015-01-01 /></div>
                                                            <div class="col-sm-2" style="text-align:left"><label class="control-label"><b> End Date :</b> </label></div>
                                                            <div class="col-sm-2" style="text-align:left"><input type=date id="form-field-6" name="end_date" jan=1 min=2015-01-01></div>
                                                        </div>
                                                        <div class="space-12"></div> 
                                                        <div class="row" style="text-align:center">
                                                            <button class="btn btn-info" type="submit">
                                                                <i class="icon-ok bigger-110"></i>
                                                                ADD
                                                            </button>																
                                                            <button class="btn" type="reset">
                                                                <i class="icon-undo bigger-110"></i>
                                                                Reset
                                                            </button>
                                                        </div>
                                                    </div>  
                                                    <br>
                                                    <div id="error1" class="error-block alert alert-danger hidden">
                                                        <i class="icon-remove"></i> <span class="message">  </span>
                                                    </div> 
                                                    <div id="success1" class="alert alert-block alert-success hidden">
                                                        <button type="button" class="close" data-dismiss="alert">
                                                            <i class="icon-remove"></i>
                                                        </button>

                                                        <p>
                                                            <span class="message">  </span>
                                                        </p>                                                       
                                                    </div> <!-- project detc -->
                                                </form>
                                            </div> 
                                            <!-- add_project ends-->
                                            <!-- manage_project begins-->
                                            <div id="manage_project" class="tab-pane">
                                                <br>
                                                <div class="row" style="text-align:center">
                                                    <div id="error5" class="error-block alert alert-danger hidden">
                                                        <i class="icon-remove"></i> <span class="message">  </span>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row" style="text-align:center">
                                                    <div id="success5" class="alert alert-block alert-success hidden">
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
                                                        <table id="project-grid-table"></table>
                                                        <div id="project-grid-pager"></div>                                                        
                                                        <script type="text/javascript">
                                                            var $path_base = "/";//this will be used in gritter alerts containing images
                                                        </script>                                                                                                    
                                                    </div>
                                                </div>
                                            </div> 
                                            <!-- manage project ends-->
                                            <!-- asign_project begins-->
                                            <div id="assign_project" class="tab-pane">
                                                <form id="assign_project_form" name="assign_project_form" method="post" style="text-align:center" >
                                                    <div id="Project_det" class="control-group" >
                                                        <div class="row">
                                                            <h3 align="center"><b>Asign Project To Employee</b></h3>
                                                        </div>														
                                                        <br>
                                                        <div class="row" >
                                                            <div class="col-sm-3" ></div>
                                                            <div class="col-sm-1"style="text-align:left" ><label><b>Project :</b></label></div>
                                                            <div class="col-sm-5" style="text-align:left" >
                                                                <select style="width:100%; height:31px;" id="form-field-1" name="assign_project_id" >
                                                                    <option value="">Select   </option>
<?PHP
$query = "select * from project ";
if ($stmt = mysqli_query($conn, $query)) {
    while ($row = mysqli_fetch_array($stmt)) {
        $project_value = $row['project_id'];
        $project_name = $row['project_name'];
        ?>
                                                                            <option value="<?PHP echo $project_value ?>"><?PHP echo $project_name ?></option>
                                                                            <?PHP
                                                                        }
                                                                        mysqli_free_result($stmt);
                                                                    }
                                                                    ?>															
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
                                                                    <div style="text-align:center" class="widget-header header-color-blue background-blue">
                                                                        <h5 class="bigger lighter">Employee Details</h5>	
                                                                    </div> 
                                                                    <div class="widget-body">
                                                                        <div class="widget-main no-padding">
                                                                            <table class="table table-striped table-bordered table-hover">
                                                                                <thead class="thin-border-bottom">
                                                                                    <tr>
                                                                                        <th style="text-align:center"><b>Name</b></th>
                                                                                        <th style="text-align:center"><b>Designation</b></th>
                                                                                        <th style="text-align:center"><b>Role</b></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
<?PHP
$query = "select * from employee ";
if ($stmt = mysqli_query($conn, $query)) {
    while ($row = mysqli_fetch_array($stmt)) {
        ?>
                                                                                            <tr>
                                                                                            <?php
                                                                                            $employee_value = $row['employee_id'];
                                                                                            $employee_name = $row['employee_name'];
                                                                                            ?>

                                                                                                <td>
                                                                                                    <input name="employee[]" id="form-field-2" class=hidden  value="<?PHP echo $employee_value ?>">
                                                                                                    <input name="employee_id[]" id="form-field-2" class="checkbox  ace ace-checkbox-2" type="checkbox" value="<?PHP echo $employee_value ?>">
                                                                                                    <span class="lbl"> <?php echo $employee_name ?></span>
                                                                                                </td>																								
        <?php
        $sql1 = "select designation from designation where designation_id='" . $row['designation_id'] . "'";
        $employee_designation = "";
        if ($stmt1 = mysqli_query($conn, $sql1)) {
            while ($row1 = mysqli_fetch_array($stmt1)) {
                $employee_designation = $row1["designation"];
                ?>
                                                                                                        <td>
                                                                                                            <label>
                <?php echo $employee_designation ?></label>
                                                                                                        </td>
                                                                                                                <?php
                                                                                                            }
                                                                                                            mysqli_free_result($stmt1);
                                                                                                        }
                                                                                                        ?>	
                                                                                                <td align="center">
                                                                                                    <select style="width:100%; height:31px;" id="form-field-3" name="role[]" >
                                                                                                        <option value="0"> Select</option>
        <?php
        $query2 = "select * from designation where designation_id=1 OR designation_id=2 ";
        $role_value = "";
        $role_name = "";
        if ($stmt2 = mysqli_query($conn, $query2)) {
            while ($row2 = mysqli_fetch_array($stmt2)) {
                $role_value = $row2['designation_id'];
                $role_name = $row2['designation'];
                ?>
                                                                                                                <option value="<?php echo $role_value ?>">
                                                                                                                <?php echo $role_name ?></option>

                                                                                                                    <?php
                                                                                                                }
                                                                                                                mysqli_free_result($stmt2);
                                                                                                            }
                                                                                                            ?>	
                                                                                                    </select>
                                                                                                </td>
                                                                                            </tr>
        <?php
    }
    mysqli_free_result($stmt);
}
?>
                                                                                </tbody>
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
                                                        <div class="space-4"></div>
                                                        <div id="spinning2" class="row hidden">
                                                            <h3 class="header smaller lighter grey">
                                                                Processing Request. . 
                                                                <i class="icon-spinner icon-spin orange bigger-125"></i>                                                            
                                                            </h3>
                                                        </div>
                                                        <br>
                                                    </div>  
                                                    <br>                                                    
                                                    <div id="error2" class="error-block alert alert-danger hidden">
                                                        <i class="icon-remove"></i> <span class="message">  </span>
                                                    </div> 
                                                    <div id="success2" class="alert alert-block alert-success hidden">
                                                        <button type="button" class="close" data-dismiss="alert">
                                                            <i class="icon-remove"></i>
                                                        </button>

                                                        <p>
                                                            <span class="message">  </span>
                                                        </p>                                                       
                                                    </div> <!-- project detc -->
                                                </form>
                                            </div> 
                                            <!-- asign_project ends-->											
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
$query = "select * from project ";
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
$query = "select * from project ";
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


        <!-- ace scripts -->

        <script src="assets/js/ace-elements.min.js"></script>
        <script src="assets/js/ace.min.js"></script>

        <!-- inline scripts related to this page -->

        <script src="assets/js/jquery.validate.min.js"></script>
        <script src="js/user_form_validations.js"></script>
        <script src="js/project_form_validations.js"></script>
        <script src="js/task_form_validations.js"></script>
        <script src="js/project_employee.js"></script>
        <script src="js/users_jqgrid.js"></script>
        <script src="js/project_jqgrid.js"></script>
        <script src="js/tasks_jqgrid.js"></script>
        <script src="js/task_modal.js"></script>
        <script src="js/task_employee.js"></script>
        <script src="js/jquery.multi-select.js"></script>        
        <!-- end basic script code -->

    </body>
</html>
