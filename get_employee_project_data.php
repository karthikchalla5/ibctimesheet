<?php

include 'connection.php';

//$sidx = $_REQUEST['sidx'];
//$sord = $_REQUEST['sord'];
//$searchon = $_REQUEST['_search'];
$wh = "";

SESSION_start();
$employee_id = $_SESSION['emp_id'];

$rows = array();

$page = $_POST['page'];
$project_name = "";
$priority = "";
$start_date = "";
$due_date = "";
$status = "";
$project_query = "";
$task_query = "";

if (isset($_POST['project_name']))
    $project_name = $_POST['project_name'];
else
    $project_name = "";

if (isset($_POST['priority']))
    $priority = $_POST['priority'];
else
    $priority = "";

if (isset($_POST['start_date']))
    $start_date = $_POST['start_date'];
else
    $start_date = "";

if (isset($_POST['due_date']))
    $due_date = $_POST['due_date'];
else
    $due_date = "";

if (isset($_POST['status']))
    $status = $_POST['status'];
else
    $status = "";

$sql = "select t.*,p.project_name from tasks t,project p where t.task_id IN ( select task_id from project_employee_task where employee_id=" . $employee_id . ") AND p.project_id=t.project_id";

if ($project_name != "") {
    $wh .= " AND t.project_id=" . $project_name;
    $sql .= $wh;
}
if ($priority != "") {
    $wh .= " AND t.priority='" . $priority . "'";
    $sql .= $wh;
}
if ($start_date != "") {
    $wh .= " AND t.start_date>='" . $start_date . "'";
    $sql .= $wh;
}
if ($due_date != "") {
    $wh .= " AND t.due_date<='" . $due_date . "'";
    $sql .= $wh;
}
if ($status != "") {
    $wh .= " AND t.status='" . $status . "'";
    $sql .= $wh;
}

$query = mysqli_query($conn, $sql);

if ($query === FALSE) {
    echo mysqli_error($conn);
    die(mysqli_error()); // TODO: better error handling
}

while ($row = mysqli_fetch_array($query, MYSQL_ASSOC)) {
    $row_array['project_name'] = $row['project_name'];
    $row_array['project_id'] = $row['project_id'];
    $row_array['task_name'] = $row['task_name'];
    $row_array['task_id'] = $row['task_id'];
    $row_array['status'] = $row['status'];
    $row_array['priority'] = $row['priority'];
    $row_array['start_date'] = $row['start_date'];
    $row_array['due_date'] = $row['due_date'];

    array_push($rows, $row_array);
}

echo json_encode($rows);
?>