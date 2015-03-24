<?php

include "connection.php";

$project_id = $_GET['pid'];
$rows = array();
//$rows1 = array();
$query = "select * from tasks where project_id=" . $project_id;
if ($stmt = mysqli_query($conn, $query)) {
    while ($row = mysqli_fetch_array($stmt)) {
        $row_array['task_id'] = $row['task_id'];
        $row_array['task_name'] = $row['task_name'];

        array_push($rows, $row_array);
    }
    mysqli_free_result($stmt);
}

$temp['check'] = "check";
array_push($rows, $temp);

$query1 = "select employee_id from project_employee where project_id=" . $project_id;
if ($stmt1 = mysqli_query($conn, $query1)) {
    while ($row1 = mysqli_fetch_array($stmt1)) {
        $query2 = "select * from employee where employee_id=" . $row1['employee_id'];
        if ($stmt2 = mysqli_query($conn, $query2)) {
            while ($row2 = mysqli_fetch_array($stmt2)) {
                $row_array1['employee_name'] = $row2['employee_name'];
                $row_array1['employee_id'] = $row2['employee_id'];

                $query3 = 'select designation from designation where designation_id=' . $row2['designation_id'];

                if ($stmt3 = mysqli_query($conn, $query3)) {
                    while ($row3 = mysqli_fetch_array($stmt3)) {
                        $row_array1['designation'] = $row3['designation'];
                    }
                    mysqli_free_result($stmt3);
                }
                array_push($rows, $row_array1);
            }
            mysqli_free_result($stmt2);
        }
    }
    mysqli_free_result($stmt1);
}

echo json_encode($rows);
?>