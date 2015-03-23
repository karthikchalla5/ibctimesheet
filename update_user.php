<?php

include "connection.php";
require 'mail/phpmailer/class.phpmailer.php';

$name = $_POST["employee_name"];
$designation = $_POST["designation_id"];
$employee_id = $_POST["employee_id"];
$official_mail_id = $_POST["official_mail_id"];
$personal_mail_id = $_POST["personal_mail_id"];
$number = $_POST["contact_number"];
$address = $_POST["address"];
// A - update employee table, B - sending mail, C - update signin
switch ($_POST["oper"]) {
    case "edit":
        $sql = "UPDATE employee SET employee_name='" . $name . "' , designation_id='" . $designation . "', official_mail_id='" . $official_mail_id . "', personal_mail_id='" . $personal_mail_id . "', contact_number='" . $number . "', address='" . $address . "' WHERE employee_id='" . $employee_id . "'";

        if (mysqli_query($conn, $sql)) {
            echo "A";
        }

        $sql = "SELECT username FROM signin WHERE employee_id = '" . $employee_id . "'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if (($row["username"] != $official_mail_id) && ($official_mail_id != "")) {

                    $rad_pass = md5(uniqid(rand(), true));
                    $password = substr($rad_pass, 0, 6);
                    $today = date("ymdhis");
                    $random_salt = hash('sha512', $today, true);
                    $pwd = hash('sha512', $password . $random_salt);
                    $mail = new PHPMailer(true);
                    $email = $official_mail_id;
                    $status = 0;

                    $body = "Hello, " . $name . "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br> <p>Wellcome to IDEABYTES Family.<br> <br>Username:  " . $official_mail_id . "<br>Password:  " . $password . " </p><br> <br><br> <br>Thanks & Regards <br> IDEABYTES Team.";
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

                    $to = $email;

                    $mail->AddAddress($to);

                    $mail->Subject = "IDEABYTES_Login_Details";

                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                    $mail->WordWrap = 80; // set word wrap

                    $mail->MsgHTML($body);

                    $mail->IsHTML(true); // send as HTML

                    $mail->Send();

                    echo "B";

                    $sql1 = "UPDATE signin SET username='" . $official_mail_id . "', password='" . $pwd . "', salt='" . $random_salt . "' WHERE employee_id='" . $employee_id . "'";

                    if (mysqli_query($conn, $sql1)) {
                        echo "C";
                    }
                } else {
                    $sql1 = "UPDATE signin SET username='" . $official_mail_id . "', password=' ' WHERE employee_id='" . $employee_id . "'";
                    if (mysqli_query($conn, $sql1)) {
                        echo "C";
                    }
                }
            }
        } else {
            echo "No results found in database";
        }
        break;
}
mysqli_close($conn);
?>





