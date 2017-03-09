<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'include.php';

$symbol = $_GET["symbol"];
$comments = array();
$query = "SELECT uid, symbol, answer1, answer2, answer3, answer4, answer5, answer6, answer7, answer8, answer9, answer10, answer11 FROM answer WHERE symbol = '$symbol' AND score IS NULL;";
if ($result = mysqli_query($conn, $query)) {
  while ($row = mysqli_fetch_row($result)) {
    $data = array(
      "uid" => $row[0],
      "symbol" => $row[1],
      "answer1" => $row[2],
      "answer2" => $row[3],
      "answer3" => $row[4],
      "answer4" => $row[5],
      "answer5" => $row[6],
      "answer6" => $row[7],
      "answer7" => $row[8],
      "answer8" => $row[9],
      "answer9" => $row[10],
      "answer10" => $row[11],
      "answer11" => $row[12],
    );
    array_push($comments, $data);
  }
}
echo json_encode($comments);

?>
