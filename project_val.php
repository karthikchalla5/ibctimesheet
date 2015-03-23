<?php

include "connection.php";

$project_manager = $_POST["project_manager"];
$pname = $_POST["pname"];
$cname = $_POST["cname"];
$client_mail_id = $_POST["clnt_mail_id"];
$client_number = $_POST["clnt_number"];
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];
$project_id = 0;

$sql = "SELECT * FROM project";

$result = $conn->query($sql);
$count = 0;

$project_id = ($result->num_rows) + 1;

$sql = "INSERT INTO project (project_id, project_name,project_manager,client_name,client_mail_id,client_number,start_date,end_date) VALUES ('" . $project_id . "','" . $pname . "', '" . $project_manager . "','" . $cname . "','" . $client_mail_id . "','" . $client_number . "',  '" . $start_date . "',  '" . $end_date . "')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully.";
} else {
    echo "fail" . mysqli_error($conn);
}

mysqli_close($conn);
?>


