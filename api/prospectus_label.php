<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'include.php';

$symbol = $_GET["symbol"];

$stmt = mysqli_prepare($conn, "SELECT name, fees, abbreviation, recommendation, description FROM fund WHERE symbol = ?");
mysqli_stmt_bind_param($stmt, "s", $symbol);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $name, $fees, $abbrev, $rec, $desc);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

echo json_encode(array($name, $fees, $abbrev, $rec, $desc));

?>
