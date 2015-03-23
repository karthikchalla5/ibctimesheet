<?php

include 'connection.php';

SESSION_start();
$employee_id = $_SESSION['emp_id'];

$rows = array();

$query = mysqli_query($conn, "select * from project_employee where employee_id=" . $employee_id);

if ($query === FALSE) {
    die(mysqli_error()); // TODO: better error handling
}

while ($r = mysqli_fetch_array($query, MYSQL_ASSOC)) {
    $query1 = mysqli_query($conn, "select project_id,project_name from project WHERE project_id=" . $r['project_id']);      //." AND ".$wh

    if ($query1 === FALSE) {
        die(mysqli_error()); // TODO: better error handling
    }

    while ($row = mysqli_fetch_array($query1, MYSQL_ASSOC)) {
        $row_array['project_name'] = $row['project_name'];
        $row_array['project_id'] = $row['project_id'];
    }

    array_push($rows, $row_array);
}

echo json_encode($rows);
?>