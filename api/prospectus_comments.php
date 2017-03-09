<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'include.php';

$symbol = $_GET["symbol"];
$document = $_GET["documentName"];

$answers = array("");

for ($numAnswer = 1; $numAnswer < 12; ++$numAnswer) {
  $query = "SELECT answer$numAnswer
            FROM answer JOIN user USING(uid)
            WHERE answer$numAnswer != '' AND symbol = ? AND document = ?
            ORDER BY completed DESC
            LIMIT 0,1;";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "ss", $symbol, $document);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $answer);
  if (mysqli_stmt_fetch($stmt)) {
    mysqli_stmt_close($stmt);
    $answers[] = $answer;
  } else {
    mysqli_stmt_close($stmt);
    $query = "SELECT answer$numAnswer
              FROM answer JOIN user USING(uid)
              WHERE answer$numAnswer != '' AND document = 'Spartan Index Funds' 
              ORDER BY completed DESC
              LIMIT 0,1;";

    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_array($result)) {
      $answers[] = $row[0];
    }
  }
}

echo json_encode($answers);

?>
