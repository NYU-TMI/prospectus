<?php

include 'include.php';

$usercode = $_SESSION["usercode"];
$comments = $_POST["comments"];

$stmt = mysqli_prepare($conn, "UPDATE user SET comments = ? WHERE uid = ?");
mysqli_stmt_bind_param($stmt, "ss", $comments, $usercode);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

session_destroy();

?>
