<?php

include "connection.php";
require 'mail/phpmailer/class.phpmailer.php';

$project_id = $_POST["assign_project_task_id"];
;
$task_id = $_POST['assign_task_id'];
$task_name = "";

$q = mysqli_query($conn, "select * from project where project_id='" . $project_id . "'");
while ($r = mysqli_fetch_array($q)) {
    $project_name = $r['project_name'];
}
mysqli_free_result($q);

// Parent Employee
$parent_employee_id = "";
SESSION_start();
if (isset($_SESSION['emp_id'])) {
    $parent_employee_id = $_SESSION['emp_id'];
}
$parent_employee_name = "";

$que = mysqli_query($conn, "select * from employee where employee_id='" . $parent_employee_id . "'");
while ($r = mysqli_fetch_array($que)) {
    $parent_employee_name = $r['employee_name'];
}
mysqli_free_result($que);

if (empty($_POST["assign_task_id"])) {
    echo("Please select a task.");
    return;
} else {
    $q = mysqli_query($conn, "select * from tasks where task_id='" . $task_id . "'");
    while ($r = mysqli_fetch_array($q)) {
        $task_name = $r['task_name'];
    }
    mysqli_free_result($q);
}
if (empty($_POST["employee_id"])) {
    echo("You didn't select any employee to assign.");
    return;
} else {

    $i = 0;
    $child_employee_id = $_POST['employee_id'];
    $N = count($child_employee_id);
    for ($i = 0; $i < $N; $i++) {
        try {
            $mail = new PHPMailer(true); //New instance, with exceptions enabled
            $query = mysqli_query($conn, "select * from employee where employee_id='" . $child_employee_id[$i] . "'");
            while ($r = mysqli_fetch_array($query)) {
                $child_employee_name = $r['employee_name'];
                $child_employee_email = $r['official_mail_id'];
                if ($child_employee_email != NULL) {
                    $sql = "INSERT INTO project_employee_task (project_id,task_id,employee_id,assigned_by) VALUES ('" . $project_id . "', '" . $task_id . "', '" . $child_employee_id[$i] . "','" . $parent_employee_id[$i] . "')";
                    $status = "Assigned";
                    $sql1 = "UPDATE tasks SET status='" . $status . "' WHERE task_id='" . $task_id . "' AND project_id='" . $project_id . "'";

                    if ((mysqli_query($conn, $sql)) && (mysqli_query($conn, $sql1))) {
                        $body = "Hello, " . $child_employee_name . "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br> <p>You have been given a task named <b>" . $task_name . "</b> from the  <b>" . $project_name . " </b> project assigned by <b>" . $parent_employee_name . "</b>. <br> <br> Please contact <b> " . $parent_employee_name . " </b> for further schedule.</p><br> <br><br> <br>Thanks & Regards <br> IDEABYTES Team.";

                        $mail->IsSMTP();                              // tell the class to use SMTP
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = 'ssl';          // enable SMTP authentication
                        $mail->Port = 465;                      // set the SMTP server port
                        $mail->Host = "smtp.gmail.com";          // SMTP server
                        $mail->Username = "princemahesh134@gmail.com";      // SMTP server username
                        $mail->Password = "9490934547143";              // SMTP server password
                        $mail->SMTPDebug = 1;

                        $mail->From = "princemahesh134@gmail.com";
                        $mail->FromName = "IDEABYTES";

                        $to = $child_employee_email;

                        $mail->AddAddress($to);

                        $mail->Subject = "Task Assignment";

                        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                        $mail->WordWrap = 80; // set word wrap

                        $mail->MsgHTML($body);

                        $mail->IsHTML(true); // send as HTML

                        $mail->Send();

                        $flag = 1;

                        //return true;
                    } else {
                        $flag = 0;
                        echo "Error: No data has been recorded" . mysqli_error($conn);
                    }
                } else {
                    echo "No mail ID has been found for the selected user";
                    return;
                }
            }
        } catch (phpmailerException $e) {
            return false;
        }
    }
    if (($i == $N) && ($flag == 1)) {
        echo "New record created successfully. Mail has been Sent.";
    }
    mysqli_close($conn);
}
?>