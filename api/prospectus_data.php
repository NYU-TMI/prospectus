<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'include.php';

$name = $_GET["name"];
$fees = $_GET["fees"];

function readCSV($csvFile){
	$line_hash = array();
	$file_handle = fopen($csvFile, 'r', true);
    $i = 0;
	while (!feof($file_handle) ) {
		$line_array = fgetcsv($file_handle, 1024);
        $i++;
		$line_key = $i;
		$line_hash[$line_key] = $line_array;
	}
	fclose($file_handle);
	return $line_hash;
}

$hash = readCSV('../data/label.csv');

$fundtype = 0;
if (strpos($name, 'Lifecycle') !== false) {
  $fundtype = 1;
} else if (strpos($name, 'Stock') !== false) {
  $fundtype = 2;
} else if (strpos($name, 'Bond') !== false) {
  $fundtype = 3;
}

$monthly_fees = array(0,0);
$cumulative_fees = array(0,0);
$final_price = array(0,1);
$change = array(0,0);

for ($i = 2; $i < count($hash); $i++) {
  if ($fundtype == 1) {
    $monthly_fees[] = $fees / 12 * $hash[$i][7]; 
    $cumulative_fees[] = $cumulative_fees[$i-1] + $monthly_fees[$i]; 
    $final_price[] = $hash[$i][7] - $cumulative_fees[$i];
    $change[] = $final_price[$i] / $final_price[$i-1] - 1;    
  } else if ($fundtype == 2) {
    $monthly_fees[] = $fees / 12 * $hash[$i][3]; 
    $cumulative_fees[] = $cumulative_fees[$i-1] + $monthly_fees[$i]; 
    $final_price[] = $hash[$i][3] - $cumulative_fees[$i];
    $change[] = $final_price[$i] / $final_price[$i-1] - 1;    
  } else if ($fundtype == 3) {
    $monthly_fees[] = $fees / 12 * $hash[$i][4]; 
    $cumulative_fees[] = $cumulative_fees[$i-1] + $monthly_fees[$i]; 
    $final_price[] = $hash[$i][4] - $cumulative_fees[$i];
    $change[] = $final_price[$i] / $final_price[$i-1] - 1;    
  }
} 

$invest = 10000;

$test_ret = 1.05;
$test_val = array($invest);
$test_fees = array($fees * 10000);
$cum_test_fees = array(0, $test_fees[0]); // Cumulative fees for the first 0-10 years
for ($year = 1; $year < 10; ++$year) {
  $test_val[] = $test_val[$year - 1] * $test_ret;
  $test_fees[] = $test_val[$year] * $fees;
  $cum_test_fees[] = $cum_test_fees[$year] + $test_fees[$year];
}

$year_start = 2006;
$year_end = 2015;
$year_diff = $year_end - $year_start + 1;
$year = array();
$year_return = array();
$fundyear_feb_return = array();
$fundyear_aug_return = array();
$fundyear_mar_return = array();

$highest_quarter_date = "";
$highest_quarter_pct = -999;
$lowest_quarter_date = "";
$lowest_quarter_pct = 999;

for ($i = 0; $i < $year_diff; $i++) {
  $init = 314;
  $row = $i * 12 + $init; // End of the year

  $year[] = $year_start + $i;
  $year_return[] = ($final_price[$row] / $final_price[$row - 12] - 1) * 100;
  if ($i != $year_diff - 1) {
    $fundyear_feb_return[] = ($final_price[$row + 2] / $final_price[$row - 10] - 1) * 100;
    $fundyear_aug_return[] = ($final_price[$row + 9] / $final_price[$row - 3] - 1) * 100;
    $fundyear_mar_return[] = ($final_price[$row + 3] / $final_price[$row - 9] - 1) * 100;
  }
  
  for ($quarter = 3; $quarter > -1; --$quarter) {
    $quarter_end = $row - 3 * $quarter;
    $quarter_begin = $quarter_end - 3;
    $quarter_pct = ($final_price[$quarter_end] / $final_price[$quarter_begin] - 1) * 100;
    if ($quarter_pct > $highest_quarter_pct) {
      $highest_quarter_pct = $quarter_pct;
      $highest_quarter_date = date('F d, Y', strtotime($hash[$quarter_end][0]));
    }
    if ($quarter_pct < $lowest_quarter_pct) {
      $lowest_quarter_pct = $quarter_pct;
      $lowest_quarter_date = date('F d, Y', strtotime($hash[$quarter_end][0]));
    }
  }
}

$final_row = 422;
$final_quarter_date = date('F d, Y', strtotime($hash[$final_row][0]));
$final_quarter_pct = ($final_price[$final_row] / $final_price[$final_row - 3] - 1) * 100;

echo json_encode(array($cum_test_fees, $year, $year_return, $highest_quarter_pct, $highest_quarter_date, 
$lowest_quarter_pct, $lowest_quarter_date, $final_quarter_pct, $final_quarter_date, $fundyear_feb_return, $fundyear_aug_return, $fundyear_mar_return));

?>
