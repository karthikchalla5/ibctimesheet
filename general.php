<?php
include"connection.php";
?>
<html>
    <head>
        <!-- Tesxt editior begins -->
        <meta name="robots" content="noindex, nofollow" />		
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script> 
        <script type="text/javascript" src="js/jquery.codify.min.js"></script>
        <script type="text/javascript" src="js/htmlbox.colors.js"></script>
        <script type="text/javascript" src="js/htmlbox.styles.js"></script>
        <script type="text/javascript" src="js/htmlbox.syntax.js"></script>
        <script type="text/javascript" src="js/htmlbox.undoredomanager.js"></script>
        <script type="text/javascript" src="js/htmlbox.min.js"></script>
        <!-- Tesxt editior ends -->

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
        <div>
            <br><br>
            <form method="post">				
                <div class="row">
                    <div class="col-sm-3" ></div>
                    <div class="col-sm-1" style="text-align:left"><label>Type</label></div>
                    <div class="col-sm-8" style="text-align:left" >
                        <select style="width:500px; height:31px;">
                            <option value="">Select   </option>
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
                <div class="row">
                    <div class="col-sm-3" ></div>					
                    <div class="col-sm-1" style="text-align:left"><label>Name</label></div>
                    <div class="col-sm-8" style="text-align:left" >
                        <input type="text" id="form-field-2"  style="width:500px; height:31px;" name="name" placeholder="Name " autocomplete="on"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3" ></div>						
                    <div class="col-sm-1" style="text-align:left"><label>Status</label></div>
                    <div class="col-sm-8" style="text-align:left" >
                        <select id="form-field-icon-3" style="width:190px; height:31px;" name="status">
                            <option value="">Select   </option>
                            <option value="Open">Open</option>
                            <option value="Close">Close</option>
                            <option value="Currently working">Currently working</option>																
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3" ></div>						
                    <div class="col-sm-1" style="text-align:left"><label>Priority</label></div>
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
                <div class="row">
                    <div class="col-sm-3" ></div>					
                    <div class="col-sm-1" style="text-align:left"><label>Assigned to</label></div>
                    <div class="col-sm-8" style="text-align:left" >
                        <textarea  id="form-field-5" style="width:190px; height:100px;" name="assigned to" placeholder="Assigned to ">
							<select style="width:500px; height:31px;">
								<option value="">Select   </option>
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
                        </textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3" ></div>						
                    <div class="col-sm-1" style="text-align:left"><label>Description</label></div>
                    <div class="col-sm-8" style="text-align:left" >							
                        <script type="text/javascript" src="<your installation path>/tinymce/tinymce.min.js"></script>
                        <script type="text/javascript">
                            tinymce.init({
                                selector: "textarea",
                                plugins: [
                                    "advlist autolink lists link image charmap print preview anchor",
                                    "searchreplace visualblocks code fullscreen",
                                    "insertdatetime media table contextmenu paste"
                                ],
                                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                            });
                        </script>

                        <form method="post" action="somepage">
                            <textarea name="content" style="width:100%"></textarea>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>