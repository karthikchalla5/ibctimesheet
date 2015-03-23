<?PHP
include"connection.php";
SESSION_start();
if (isset($_SESSION['emp_id'])) {
    $emp_id = $_SESSION['emp_id'];
    $desg = $_SESSION['designation'];
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
        <link rel="stylesheet" href="assets/css/bootstrap-editable.css" />          
        <link rel="stylesheet" href="assets/css/select2.css" />
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

                        <li class="light-blue">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <img class="nav-user-photo" src="assets/avatars/user.jpg" alt="Jason's Photo" />
                                <span class="user-info">
                                    <small>Welcome,</small>
                                    <?PHP
                                    $que = mysqli_query($conn, "select * from employee where employee_id='" . $emp_id . "'");
                                    while ($r = mysqli_fetch_array($que)) {
                                        echo $r['employee_name'];
                                        ?>
                                    </span>

                                    <i class="icon-caret-down"></i>
                                </a>

                                <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                    
                                    <li>
                                        <a href="<?php print_r($_SERVER['HTTP_REFERER']); ?>">
                                            <i class="icon-home"></i>
                                            Home
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
                        <div class="page-header">

                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->
                                <div class="row">
                                    <div>
                                        <div id="user-profile-1" class="user-profile row">
                                            <div class="col-xs-12 col-sm-3 center">
                                                <div>
                                                    <span class="profile-picture">
                                                        <img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="assets/avatars/profile-pic.jpg" />
                                                    </span>

                                                    <div class="space-4"></div>

                                                    <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                                                        <div class="inline position-relative">

                                                            <i class="icon-circle light-green middle"></i>
                                                            &nbsp;
                                                            <span class="white"><?php echo $r['employee_name']; ?></span>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="space-12"></div>

                                            <div class="col-xs-12 col-sm-9">
                                                <div class="profile-user-info profile-user-info-striped">
                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Employee ID </div>

                                                        <div class="profile-info-value">
                                                            <span id="employee_id"><?php echo $r['employee_id']; ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Employee Name </div>

                                                        <div class="profile-info-value">
                                                            <span id="employee_name"><?php echo $r['employee_name']; ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Designation </div>

                                                        <div class="profile-info-value">
                                                            <span id="designation"><?php echo $desg; ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Official mail ID </div>

                                                        <div class="profile-info-value">
                                                            <span id="official_mail_id"><?php echo $r['official_mail_id']; ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Personal Mail ID </div>

                                                        <div class="profile-info-value">
                                                            <span id="personal_mail_id"><?php echo $r['personal_mail_id']; ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Phone </div>

                                                        <div class="profile-info-value">
                                                            <span id="contact_number"><?php echo $r['contact_number']; ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Address </div>

                                                        <div class="profile-info-value">
                                                            <span id="address"><?php echo $r['address']; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        mysqli_free_result($que);
                                        ?>
                                    </div>

                                    <div class="hr hr16 dotted"></div>

                                </div>
                            </div>
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
    <script src="assets/js/date-time/moment.min.js"></script>
    <script src="assets/js/date-time/daterangepicker.min.js"></script>
    <script src="assets/js/x-editable/bootstrap-editable.min.js"></script>
    <script src="assets/js/x-editable/ace-editable.min.js"></script>    

    <!-- ace scripts -->

    <script src="assets/js/ace-elements.min.js"></script>
    <script src="assets/js/ace.min.js"></script>

    <!-- inline scripts related to this page -->

    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="js/employee_jqgrid.js"></script>
    <script src="js/task_status.js"></script>
    <script src="js/ajax_calls_all.js"></script>    
    <!-- end basic script code -->

</body>
</html>
