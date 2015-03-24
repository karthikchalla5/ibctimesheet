<?php

include "connection.php";

$uname = $_POST["uname"];
$password = $_POST["password"];

$sql = "SELECT employee_id, salt, password, status FROM signin WHERE username = '" . $uname . "'";
$result = $conn->query($sql);
$user_designation = "";
$user_role = "";

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $sql1 = "SELECT designation_id from employee where employee_id='" . $row["employee_id"] . "'";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            // output data of each row
            while ($row1 = $result1->fetch_assoc()) {
                $sql2 = "SELECT designation from designation where designation_id='" . $row1["designation_id"] . "'";
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    // output data of each row
                    while ($row2 = $result2->fetch_assoc()) {
                        $user_designation = $row2["designation"];
                        $sql3 = "SELECT role from project_employee where employee_id='" . $row["employee_id"] . "'";
                        $result3 = $conn->query($sql3);
                        if ($result3->num_rows > 0) {
                            // output data of each row
                            while ($row3 = $result3->fetch_assoc()) {
                                $user_role = $row3["role"];
                            }
                        }
                    }
                }
            }
        }
        $random_salt = $row["salt"];
        $pwd = hash('sha512', $password . $random_salt);

        if (($row["status"] == '1') && ($pwd == $row["password"])) {
            //header("Location: add_user.php");
            session_start();
            $_SESSION['emp_id'] = $row["employee_id"];
            $_SESSION['designation'] = $user_designation;
            if (($user_designation == "Admin") OR ( $user_designation == "Manager")) {
                echo $user_designation;
            } else {
                if (($user_role == "2") OR ( $user_designation == "Team leader")) {
                    $user_designation = "Team leader";
                    echo $user_designation;
                    $_SESSION['designation'] = $user_designation;
                } else {
                    echo $user_designation;
                }
            }
            break;
        } else if (($row["status"] == '0') && ($pwd == $row["password"])) {
            echo "reset password";
        } else {
            echo "password doesn't match";
        }
    }
} else {
    echo "No results found in database";
}

mysqli_close($conn);
?>
