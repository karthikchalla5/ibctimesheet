<?php

include "connection.php";

$project_id = $_POST["project_id"];
$task_id = $_POST["task_id"];
$task_name = $_POST["task_name"];
$status = $_POST["status"];
$priority = $_POST["priority"];
$description = $_POST["description"];
$estimated_time = $_POST["estimated_time"];
$start_date = $_POST["start_date"];
$progress = $_POST["progress"];

switch ($_POST["oper"]) {
    case "edit":
        $sql = "UPDATE tasks SET task_name='" . $task_name . "' , status='" . $status . "', priority='" . $priority . "',  description='" . $description . "', estimated_time='" . $estimated_time . "', start_date='" . $start_date . "', progress='" . $progress . "' WHERE task_id='" . $task_id . "' AND project_id='" . $project_id . "'";
        if (mysqli_query($conn, $sql)) {
            echo "Update Success.";
        } else {
            echo "Update Fail.";
        }
        break;
}
mysqli_close($conn);
?>





