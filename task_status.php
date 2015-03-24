<?php

include "connection.php";
require 'mail/phpmailer/class.phpmailer.php';

$project_id = $_POST['project_id'];
$project_name = $_POST['project_name'];
$task_id = $_POST['task_id'];
$task_name = $_POST['task_name'];
$note = $_POST['note'];
$date = $_POST["date"];
$hours = $_POST["hours"];
$minutes = $_REQUEST["minutes"];
$type = $_POST["type"];
$status = $_POST["status"];
$employee_mail_password = $_POST["employee_mail_password"];
$time = $hours . ":" . $minutes;

$flag = 0;

//employee mail id
$employee_id = "";
SESSION_start();
if (isset($_SESSION['emp_id'])) {
    $employee_id = $_SESSION['emp_id'];
}
$employee_mail = "";
$que = mysqli_query($conn, "select * from employee where employee_id='" . $employee_id . "'");
while ($r = mysqli_fetch_array($que)) {
    $employee_mail = $r['official_mail_id'];
}
mysqli_free_result($que);


$sql = "INSERT INTO task_status (project_id, task_id, note, date, time, type, status) VALUES ('" . $project_id . "','" . $task_id . "', '" . $note . "','" . $date . "','" . $time . "', '" . $type . "', '" . $status . "')";
if (mysqli_query($conn, $sql)) {
    $sql1 = "UPDATE tasks SET  status='" . $status . "' WHERE task_id='" . $task_id . "' AND project_id='" . $project_id . "'";
    if (mysqli_query($conn, $sql1)) {

        if (trim($status) == "completed") {

            try {
                $mail = new PHPMailer(true); //New instance, with exceptions enabled
                $query = mysqli_query($conn, "select * from employee where employee_id in (select assigned_by from project_employee_task where task_id='" . $task_id . "')");

                while ($r = mysqli_fetch_array($query)) {
                    $flag = 1;
                    $TL_name = $r['employee_name'];
                    $TL_email = $r['official_mail_id'];

                    if ($TL_email != NULL) {
                        $body = "Hello, " . $TL_name . "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br> <p>status of <b>" . $task_name . "</b> from <b>" . $project_name . "</b> project is completed .</p><br> <br><br> <br>Thanks & Regards <br> IDEABYTES Team.";

                        $mail->IsSMTP();                              // tell the class to use SMTP
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = 'ssl';          // enable SMTP authentication
                        $mail->Port = 465;                      // set the SMTP server port
                        $mail->Host = "smtp.gmail.com";          // SMTP server
                        $mail->Username = $employee_mail;         // SMTP server username
                        $mail->Password = $employee_mail_password;            // SMTP server password
                        $mail->SMTPDebug = 1;

                        $mail->From = $employee_mail;
                        $mail->FromName = "IDEABYTES";

                        $to = $TL_email;

                        $mail->AddAddress($to);

                        $mail->Subject = "Task Status";

                        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                        $mail->WordWrap = 80; // set word wrap

                        $mail->MsgHTML($body);

                        $mail->IsHTML(true); // send as HTML

                        $mail->Send();
                        //return true;
                        echo "Task status updated and mail has been sent to Your Respective Mentor";
                    }
                }
                if ($flag == 0) {
                    echo "Task status updated but no mail ID has been found for the selected user";
                }
            } catch (phpmailerException $e) {

                //return false;
            }
        } else {
            echo "Task status updated.";
        }
    } else {
        echo "Error in Tasks table" . mysqli_error($conn);
    }
} else {
    echo "Error in Tasks status table" . mysqli_error($conn);
}
mysqli_close($conn);
?>


