<?php

include 'include.php';

$document = isset($_POST["documentName"])? $_POST["documentName"] : "Error"; 
$symbol = isset($_POST["symbol"])? $_POST["symbol"] : "Error";

$usercode = $_SESSION["usercode"];

$answer1 = isset($_POST["answer1"]) ?  $_POST["answer1"] : "Empty";
$answer2 = isset($_POST["answer2"]) ?  $_POST["answer2"] : "Empty";
$answer3 = isset($_POST["answer3"]) ?  $_POST["answer3"] : "Empty";
$answer4 = isset($_POST["answer4"]) ?  $_POST["answer4"] : "Empty";
$answer5 = isset($_POST["answer5"]) ?  $_POST["answer5"] : "Empty";
$answer6 = isset($_POST["answer6"]) ?  $_POST["answer6"] : "Empty";
$answer7 = isset($_POST["answer7"]) ?  $_POST["answer7"] : "Empty";
$answer8 = isset($_POST["answer8"]) ?  $_POST["answer8"] : "Empty";
$answer9 = isset($_POST["answer9"]) ?  $_POST["answer9"] : "Empty";
$answer10 = isset($_POST["answer10"]) ?  $_POST["answer10"] : "Empty";
$answer11 = isset($_POST["answer11"]) ?  $_POST["answer11"] : "Empty";

$stmt = mysqli_prepare($conn, "INSERT INTO prospectus.answer (uid, document, symbol, answer1, answer2, answer3, answer4, answer5, answer6, answer7, answer8, answer9, answer10, answer11) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
mysqli_stmt_bind_param($stmt, "ssssssssssssss", $usercode, $document, $symbol, $answer1, $answer2, $answer3, $answer4, $answer5, $answer6, $answer7, $answer8, $answer9, $answer10, $answer11);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$stmt = mysqli_prepare($conn, "UPDATE user SET completed = now() WHERE uid = ?");
mysqli_stmt_bind_param($stmt, "s", $usercode);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

?>
