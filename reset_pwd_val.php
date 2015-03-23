
<?php

include "connection.php";

$currentpassword = $_POST["cpwd"];
$newpassword = $_POST["npwd"];
$renewpassword = $_POST["rnpwd"];
//echo "mahesh";
$sql = "SELECT * FROM signin ";
$result = $conn->query($sql);
$flag = 0;

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $random_salt = $row["salt"];
        $pwd = hash('sha512', $currentpassword . $random_salt);
        if ($row["password"] == $pwd) {
            $currentpassword = $pwd;
        }
    }
} else {
    echo "Current password You enterd is incorrect.";
}
if ($currentpassword != $_POST["cpwd"]) {
    $sql1 = "SELECT * FROM signin where password= '" . $currentpassword . "' ";
    $result1 = $conn->query($sql1);

    if ($result1->num_rows == 1) {
        // output data of each row
        while ($row1 = $result1->fetch_assoc()) {
            if ($newpassword == $renewpassword) {
                $today = date("ymdhis");
                $random_salt = hash('sha512', $today, true);
                $pwd = hash('sha512', $newpassword . $random_salt);
                $status = 1;
                $sql2 = "UPDATE signin SET password='" . $pwd . "' ,salt='" . $random_salt . "', status='" . $status . "' WHERE username='" . $row1["username"] . "'";
                if (mysqli_query($conn, $sql2)) {
                    $flag = 1;
                }
            } else {
                echo "new password and re enter password aren't equal";
            }
        }
    }
    if ($flag == 1) {
        echo "Your reset password sucessfully updated";
    }
} else {
    echo "Error:" . mysqli_error($conn);
}
mysqli_close($conn);
?>
