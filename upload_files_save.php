<?PHP

include "connection.php";

$task_id = 1; //$_SESSION['task_id'];
$ds = DIRECTORY_SEPARATOR;
$upload_dir = 'uploads';

$file_id = 0;

$sql = "SELECT * FROM files";

$result = $conn->query($sql);
$count = 0;

$file_id = ($result->num_rows) + 1;

if (!empty($_FILES)) {
    $tempFile = $_FILES['file']['tmp_name'];

    // using DIRECTORY_SEPARATOR constant is a good practice, it makes your code portable.
    $targetPath = dirname(__FILE__) . DIRECTORY_SEPARATOR . $upload_dir . DIRECTORY_SEPARATOR;

    // Adding timestamp with image's name so that files with same name can be uploaded easily.
    $fname = $targetPath . time() . '-' . $_FILES['file']['name'];
    $file_name = time() . '-' . $_FILES['file']['name'];
    $ftype = "" . $_FILES["file"]["type"];
    $fsize = ($_FILES["file"]["size"] / 1024);
    $tmpname = $_FILES["file"]["tmp_name"];

    // Change $flink path to your folder where you want to upload images.
    $flink = dirname(__FILE__) . $ds . $upload_dir;

    $arr = array('task_id' => $task_id, 'fid' => $file_id, 'fname' => $file_name, 'fsize' => $fsize, 'flink' => $flink, 'ftype' => $ftype, 'fdate' => date('Y-m-d'));
    $key = "(task_id, file_id, file_name, file_size, file_link, file_type, file_date)";
    $val = "('{$arr['task_id']}', '{$arr['fid']}', '{$arr['fname']}', '{$arr['fsize']}','{$arr['flink']}','{$arr['ftype']}','{$arr['fdate']}')";
    $query = "INSERT INTO files " . $key . " VALUES " . $val;
    echo $query;
    if (mysqli_query($conn, $query)) {
        echo "New record created successfully.";
        //mysqli_close($obj->con);
    } else {
        echo mysqli_error($conn);
    }
    move_uploaded_file($tempFile, $fname);
} else {
    echo "No files found. . ";
}
?>   