
<?php

include "connection.php";
require 'mail/phpmailer/class.phpmailer.php';

$project_id = $_POST["assign_project_id"];
$flag = 0;
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


// child employee's
if (empty($_POST['employee_id'])) {
    echo("You didn't select any employee to assign.");
    return;
} else {
    $i = 0;
    $child_employee_id = $_POST['employee_id'];
    $child_employee_role = $_POST['role'];
    $employee = $_POST['employee'];
    $N = count($employee);
    $M = count($child_employee_id);
    for ($i = 0, $j = 0; $i < $N, $j < $M; $i++) {
        if ($employee[$i] == $child_employee_id[$j]) {
            /* echo "id:".$child_employee_id[$j];
              echo "role:".$child_employee_role[$i].","; */
            try {
                $mail = new PHPMailer(true); //New instance, with exceptions enabled
                $query = mysqli_query($conn, "select * from employee where employee_id='" . $child_employee_id[$j] . "'");
                while ($r = mysqli_fetch_array($query)) {
                    $child_employee_name = $r['employee_name'];
                    $child_employee_email = $r['official_mail_id'];
                    if ($child_employee_email != NULL) {
                        $sql = "INSERT INTO project_employee (project_id,employee_id,role) VALUES ('" . $project_id . "',  '" . $child_employee_id[$j] . "', '" . $child_employee_role[$i] . "')";
                        if (mysqli_query($conn, $sql)) {

                            $sql2 = mysqli_query($conn, "SELECT designation from designation WHERE designation_id= '" . $child_employee_role[$i] . "'");
                            while ($r2 = mysqli_fetch_array($sql2)) {
                                $role = $r2['designation'];
                                $body = "Hello, " . $child_employee_name . "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br> <p>You have been assigned to <b>" . $project_name . " </b> project as a <b>" . $role . "</b>&nbsp; by <b>" . $parent_employee_name . "</b>. <br> <br> Please contact <b> " . $parent_employee_name . " </b> for further schedule.</p><br> <br><br> <br>Thanks & Regards <br> IDEABYTES Team.";

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

                                $mail->Subject = "Project Assignment";

                                $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                                $mail->WordWrap = 80; // set word wrap

                                $mail->MsgHTML($body);

                                $mail->IsHTML(true); // send as HTML

                                $mail->Send();

                                $flag = 1;

                                //return true;
                            }
                        } else {
                            $flag = 0;
                            echo "Error: No data has been recorded" . mysqli_error($conn);
                        }
                    } else {
                        echo "No mail ID has been found for the selected user";
                        return;
                    }
                }
                $j++;
            } catch (phpmailerException $e) {
                return false;
            }
        }
    }
    if (($i == $N) && ($flag == 1)) {
        echo "New record created successfully. Mail has been Sent.";
    }
    mysqli_close($conn);
}
?>


