<?PHP

session_start();
session_unset();
session_destroy();
$newURL = "index.html";
header('Location: ' . $newURL);
?>