<?php

session_start();

if (!isset($_SESSION["usercode"])) {
  header("Location: index.php");
}

$usercode = $_SESSION["usercode"];

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">  
  <link rel="stylesheet" type="text/css" href="css/completed.css">
  <title>Retirement portfolio simulator</title>
</head>
<body>
  <div class="container" id="completeMsg">
  <h1>Thank you for completing this study.</h1>
  <div class="cond8-hide" style="display: none;">
    <p>Your final amount is: $<span id="finalAmount"></span>. Your goal was: $<span id="goalAmount"></span>.</p>
    <p>Your Mechanical Turk bonus is: $<span id="reward">0</span>.</p>
  </div>
    <h2>Your user code is: <?php echo $usercode; ?></h2>
    <div id="commentsArea">
      <form id="commentsForm">
        <label>Please enter any comments you may have about this study below (optional):</label>
        <div>
          <textarea name="comments" cols="80" rows="4" id="commentsTextArea"></textarea>
        </div>
      <input type="submit" id="submitComments">
      </form>
    </div>
  </div>  
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/completed.js"></script>
</body>
</html>
