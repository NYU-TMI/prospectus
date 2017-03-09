<?php

include 'include.php';
include 'ip.inc';
include 'groupid.php';

session_unset();
$locStr = implode(", ", getClientLocByIP());

$groupid = $weighted_groupid;

function get_client_ip() {
  $ipaddress = '';
  if (getenv('HTTP_CLIENT_IP'))
    $ipaddress = getenv('HTTP_CLIENT_IP');
  else if(getenv('HTTP_X_FORWARDED_FOR'))
    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
  else if(getenv('HTTP_X_FORWARDED'))
    $ipaddress = getenv('HTTP_X_FORWARDED');
  else if(getenv('HTTP_FORWARDED_FOR'))
    $ipaddress = getenv('HTTP_FORWARDED_FOR');
  else if(getenv('HTTP_FORWARDED'))
    $ipaddress = getenv('HTTP_FORWARDED');
  else if(getenv('REMOTE_ADDR'))
    $ipaddress = getenv('REMOTE_ADDR');
  else
    $ipaddress = 'UNKNOWN';
  return $ipaddress;
}

$usercode = uniqid(true);
$ip = get_client_ip();
$location = $locStr;

$experience = isset($_POST["experience"]) ?  intval($_POST["experience"]) : 0;
$hasretire = isset($_POST["hasretire"]) ?  intval($_POST["hasretire"]) : 0;

$stmt = mysqli_prepare($conn, "INSERT INTO user (uid, groupid, experience, hasretire, ip, location, created) VALUES (?, ?, ?, ?, ?, ?, now());");
mysqli_stmt_bind_param($stmt, "siiiss", $usercode, $groupid, $experience, $hasretire, $ip, $location);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$_SESSION["usercode"] = $usercode;
$_SESSION["groupid"] = $groupid;
echo $groupid;

?>
