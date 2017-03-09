<?php

$symbol = $_GET["symbol"];
$comment = $_GET["comment"];

session_start();

$conn = mysqli_connect("localhost", "root", "BAgowan13sql", "retire4");

if (mysqli_connect_errno()) {
  die('Unable to connect to database [' . mysqli_connect_error() . ']');
}

$query = "SELECT symbol, name, fees, recommendation, description FROM fund WHERE symbol = '$symbol'";

$name = "";
$fees = 0;
$rec = "";
$desc = "";

if ($result = mysqli_query($conn, $query)) {
  while ($row = mysqli_fetch_row($result)) {
    $symbol = $row[0];
    $name = $row[1];
    $fees = floatval($row[2]);
    $rec = $row[3];
    $desc = $row[4];
  }
}

$test_ret = 1.05;
$test_val = array(10000);
$test_fees = array($fees * 10000);
$cum_test_fees = array(0, $test_fees[0]); // Cumulative fees for the first 0-10 years
for ($year = 1; $year < 10; ++$year) {
  $test_val[] = $test_val[$year - 1] * $test_ret;
  $test_fees[] = $test_val[$year] * $fees;
  $cum_test_fees[] = $cum_test_fees[$year] + $test_fees[$year];
}

?>
