<?php

function generateWeightedList($list, $weight) {
  $weighted_list = array();
  for ($i = 0; $i < count($weight); $i++) {
    $multiples = $weight[$i] * 100;
    for ($j = 0; $j < $multiples; $j++) {
      array_push($weighted_list, $list[$i]);
    }
  }
  return $weighted_list;
}
// 1 -> Prospectus Stock - SFN
// 2 -> Prospectus Stock - SFQ
// 3 -> Prospectus Stock - SFR
// 4 -> Prospectus Bond - BFA
// 5 -> Prospectus Bond - BFE
// 6 -> Prospectus Bond - BFG
// 7 -> Prospectus Lifecycle - LC4
// 8 -> Prospectus Lifecycle - LC6
// 9 -> Prospectus Lifecycle - LCB

$list   = array( 1,  2,  3,  4,  5,  6,  7,  8,  9);
$weight = array( 0,  0,  0,  0,  0,  0,  0,  1,  0);
$weighted_list = generateWeightedList($list, $weight);
$random_num = rand(0, count($weighted_list)-1);
$weighted_groupid = $weighted_list[$random_num];
?>
