<?php

include "connection.php";
require 'mail/phpmailer/class.phpmailer.php';

$name = $_POST["name"];
$designation = $_POST["designation"];
$employee_id = $_POST["empid"];
$official_mail_id = $_POST["off_mail_id"];
$personal_mail_id = $_POST["prsnl_mail_id"];
$number = $_POST["number"];
$address = $_POST["address"];
$status = 0;
$flag = 0;

$sql = "INSERT INTO employee (employee_name, designation_id, employee_id, official_mail_id, personal_mail_id,  contact_number, address) VALUES ('" . $name . "', '" . $designation . "', '" . $employee_id . "',  '" . $official_mail_id . "',  '" . $personal_mail_id . "',  '" . $number . "',  '" . $address . "')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully.";

    try {
        $mail = new PHPMailer(true); //New instance, with exceptions enabled
        $email = $official_mail_id;
        $body = "";
        if ($email == "") {
            $email = $personal_mail_id;
            $sql = "INSERT INTO signin (employee_id, username, password, salt, status) VALUES ('" . $employee_id . "',  '" . $employee_id . "',  '',  '',  '" . $status . "')";
            if (mysqli_query($conn, $sql)) {
                $body = "Hello, " . $name . "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br> <p>Wellcome to IDEABYTES Family.<br> <br>Please contact admin for your official mail id. Untill You get Official mail id You can't access your Ideabytes A/c.</p><br> <br><br> <br>Thanks & Regards <br> IDEABYTES Team.";
                $flag = 1;
            } else {
                echo "Error: No data has been recorded" . mysqli_error($conn);
            }
        } else {
            $rad_pass = md5(uniqid(rand(), true));
            $password = substr($rad_pass, 0, 6);
            $today = date("ymdhis");
            $random_salt = hash('sha512', $today, true);
            $pwd = hash('sha512', $password . $random_salt);
            $sql1 = "INSERT INTO signin (employee_id, username, password, salt, status) VALUES ('" . $employee_id . "',  '" . $official_mail_id . "',  '" . $pwd . "',  '" . $random_salt . "','" . $status . "')";
            if (mysqli_query($conn, $sql1)) {
                $body = "Hello, " . $name . "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br> <p>Wellcome to IDEABYTES Family.<br> <br>Username:  " . $official_mail_id . "<br>Password:  " . $password . " </p><br> <br><br> <br>Thanks & Regards <br> IDEABYTES Team.";
                $flag = 0;
            } else {
                echo "Error: No data has been recorded at Sign in table" . mysqli_error($conn);
            }
        }
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

        if ($flag == 0) {
            echo " Official Mail has been updated and an email has been Sent to recipient regarding login details";
        } else if ($flag == 1) {
            echo "Please Update official mail ID ASAP. Mail has been sent.";
        }

        return true;
    } catch (phpmailerException $e) {

        return false;
    }
} else {
    echo "Error: No data has been recorded" . mysqli_error($conn);
}

mysqli_close($conn);
?>


