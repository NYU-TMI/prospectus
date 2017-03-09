<?php

include 'api/include.php';

if (!isset($_SESSION["groupid"])) {
  header("Location: index.php");
}
$groupid = $_SESSION["groupid"];

?>
<!DOCTYPE html>
<html>
<head>
  <title>Fund Prospectus Comprehension Study</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-header">
          <h1>Prospectus Documents</h1>

  <p>First, click on the <span style="color: #337ab7; font-weight:bold">blue links</span> below to view fund prospectus documents. Please read over each prospectus document that appears after you click on a blue link. When you have finished reading a document, press the back button at the top of the prospectus document to return to this page. You can visit the links as many times as you wish.</p>

  <p>Once you have finished reading all of the blue link prospectus documents, click on the <span style="color: red; font-weight:bold">red link</span> prospectus document.</p>

  <p>On the red link prospectus document please leave comments about how the red link prospectus document compares to the blue link prospectus documents. You should comment on things such as fees, rates of return and risk, noting how the red link fund compares to other blue link funds. Other users will read your comments. A useful comment to other users would be something such as "This is a great fund that's better than other funds with low fees of 0.2% and a high rate of return of 7%" or "This is a bad fund, worse than any of the others. Stay away from it. The fees are very high at almost 2%."</p>

  <p><strong>Be sure to write in your comments if the <span style="color: red; font-weight:bold">red link</span> fund is <i>better, same or worse</i> than other <span style="color: #337ab7; font-weight:bold">blue link</span> funds in the list.</strong></p>

  <p>When you are finished, scroll to the bottom of the red link prospectus document and click submit.</p>

<!--          <p>
            Please click on the fund names to learn more about them.
          </p>
          <p>  
            <strong class="red">For the fund name in red, please comment on this fund and let others know if it is better, worse or the same as other funds in this list.</strong>
          </p>-->
        </div>
        <div class="table-responsive">
          <table class="table table-striped">
             <thead>
              <tr>
                <th>Fund Name</th>
              </tr>
            </thead>
            <tbody>

              <tr class="data_row">
                <td id="SFN">
<?php
if ($groupid == 1) {
  echo '
                  <a href="prospectus.php?symbol=SFN&comment=1" class="red">
       ';
} else {
  echo '
                  <a href="prospectus.php?symbol=SFN">
       ';
}
?>
                    Stock Index Fund N
                  </a>
                </td>
              </tr>

              <tr class="data_row">
                <td id="SFQ">
<?php
if ($groupid == 2) {
  echo '
                  <a href="prospectus.php?symbol=SFQ&comment=1" class="red">
       ';
} else {
  echo '
                  <a href="prospectus.php?symbol=SFQ">
       ';
}
?>
                    Stock Index Fund Q
                  </a>
                </td>
              </tr>

              <tr class="data_row">
                <td id="SFR">
<?php
if ($groupid == 3) {
  echo '
                  <a href="prospectus.php?symbol=SFR&comment=1" class="red">
       ';
} else {
  echo '
                  <a href="prospectus.php?symbol=SFR">
       ';
}
?>
                    Stock Index Fund R
                  </a>
                </td>
              </tr>
 
              <tr class="data_row">
                <td id="BFA">
<?php
if ($groupid == 4) {
  echo '
                  <a href="prospectus_bond.php?symbol=BFA&comment=1" class="red">
       ';
} else {
  echo '
                  <a href="prospectus_bond.php?symbol=BFA">
       ';
}
?>
                    Investment Grade Bond Fund A
                  </a>
                </td>
              </tr>

              <tr class="data_row">
                <td id="BFE">
<?php
if ($groupid == 5) {
  echo '
                  <a href="prospectus_bond.php?symbol=BFE&comment=1" class="red">
       ';
} else {
  echo '
                  <a href="prospectus_bond.php?symbol=BFE">
       ';
}
?>
                    Investment Grade Bond Fund E
                  </a>
                </td>
              </tr>

              <tr class="data_row">
                <td id="BFG">
<?php
if ($groupid == 6) {
  echo '
                  <a href="prospectus_bond.php?symbol=BFG&comment=1" class="red">
       ';
} else {
  echo '
                  <a href="prospectus_bond.php?symbol=BFG">
       ';
}
?>
                    Investment Grade Bond Fund G
                  </a>
                </td>
              </tr>

              <tr class="data_row">
                <td id="LC4">
<?php
if ($groupid == 7) {
  echo '
                  <a href="prospectus_lifecycle.php?symbol=LC4&comment=1" class="red">
       ';
} else {
  echo '
                  <a href="prospectus_lifecycle.php?symbol=LC4">
       ';
}
?>
                    Lifecycle Fund 4
                  </a>
                </td>
              </tr>

              <tr class="data_row">
                <td id="LC6">
<?php
if ($groupid == 8) {
  echo '
                  <a href="prospectus_lifecycle.php?symbol=LC6&comment=1" class="red">
       ';
} else {
  echo '
                  <a href="prospectus_lifecycle.php?symbol=LC6">
       ';
}
?>
                    Lifecycle Fund 6
                  </a>
                </td>
              </tr>

              <tr class="data_row">
                <td id="LCB">
<?php
if ($groupid == 9) {
  echo '
                  <a href="prospectus_lifecycle.php?symbol=LCB&comment=1" class="red">
       ';
} else {
  echo '
                  <a href="prospectus_lifecycle.php?symbol=LCB">
       ';
}
?>
                    Lifecycle Fund B
                  </a>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script src="js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
