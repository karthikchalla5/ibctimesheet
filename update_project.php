<?php

include "connection.php";

$project_id = $_POST["project_id"];
$project_name = $_POST["project_name"];
$project_manager = $_POST["project_manager"];
$client_name = $_POST["client_name"];
$client_mail_id = $_POST["client_mail_id"];
$client_number = $_POST["client_number"];
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];

switch ($_POST["oper"]) {
    case "edit":
        $sql = "UPDATE project SET project_name='" . $project_name . "' , project_manager='" . $project_manager . "',client_name='" . $client_name . "', client_mail_id='" . $client_mail_id . "', client_number='" . $client_number . "', start_date='" . $start_date . "', end_date='" . $end_date . "' WHERE project_id='" . $project_id . "'";
        if (mysqli_query($conn, $sql)) {
            echo "Update Success.";
        } else {
            echo "Update Fail.";
        }
        break;
}
mysqli_close($conn);
?>





