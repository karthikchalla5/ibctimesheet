<?php

include "connection.php";
//require 'mail/phpmailer/class.phpmailer.php';

$project_id = $_POST['project_id'];
$task_id = $_POST['task_id'];
$note = $_POST['note'];
$date = $_POST["date"];
$hours = $_POST["hours"];
$minutes = $_REQUEST["minutes"];
$type = $_POST["type"];
$status = $_POST["status"];
$time = $hours . ":" . $minutes;

$sql = "INSERT INTO task_status (project_id, task_id, note, date, time, type, status) VALUES ('" . $project_id . "','" . $task_id . "', '" . $note . "','" . $date . "','" . $time . "', '" . $type . "', '" . $status . "')";
if (mysqli_query($conn, $sql)) {
    $sql1 = "UPDATE tasks SET  status='" . $status . "' WHERE task_id='" . $task_id . "' AND project_id='" . $project_id . "'";
    if (mysqli_query($conn, $sql1)) {
        echo "Task status updated.";
    } else {
        echo "Error in Tasks table" . mysqli_error($conn);
    }
} else {
    echo "Error in Tasks status table" . mysqli_error($conn);
}
mysqli_close($conn);
?>


