<?php

include "connection.php";
require 'mail/phpmailer/class.phpmailer.php';

$project_id = $_POST["project_id"];
;
$task_id = 0;
$task_name = $_POST["name"];
$status = $_POST["status"];
$priority = $_POST["priority"];
$description = $_REQUEST["description"];
$estimated_time = $_POST["estimated_time"];
$start_date = $_POST["start_date"];
$due_date = $_POST["due_date"];
$progress = $_POST["progress"];
//$file=$_POST["file"];   

$flag = 0;
if ($_POST["project_id"] == 0) {
    echo("Please Select project name.");
    return;
}
if ($_POST["name"] == "") {
    echo("Please enter task name");
    return;
} else {
    $sql = "SELECT * FROM tasks";
    $result = $conn->query($sql);
    $task_id = ($result->num_rows) + 1;
    $sql = "INSERT INTO tasks (project_id, task_id, task_name, status, priority, description, estimated_time, start_date, due_date, progress) VALUES ('" . $project_id . "','" . $task_id . "', '" . $task_name . "','" . $status . "','" . $priority . "',  '" . $description . "','" . $estimated_time . "', '" . $start_date . "','" . $due_date . "','" . $progress . "')";
    if (mysqli_query($conn, $sql)) {
        echo "New task created successfully.";
    } else {
        echo "fail" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>


