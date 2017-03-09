var head = document.getElementsByTagName('head')[0];
head.innerHTML = head.innerHTML + '<link href="../../prospectus/css/transforming-disclosures.webflow.css"  type="text/css" rel="stylesheet">';
head.innerHTML = head.innerHTML + '<link href="../../prospectus/css/webflow.css" type="text/css" rel="stylesheet" media="screen,projection"/>';
head.innerHTML = head.innerHTML + '<link rel="stylesheet" type="text/css" href=../../prospectus/css/normalize.css">';


var buttonDiv = document.getElementById("calculate-button");
var key = buttonDiv.getAttribute('data-key');
var url = '';

loadXMLDoc();

function loadXMLDoc() {

          var buttonTpl = '\
            <div class="calc_coulmn w-col w-col-7">\
          <div class="calc_box" data-ix="new-interaction">\
            <h3 class="calc_header">ABCX Fee Calculator</h3>\
            <div class="">\
              <form data-name="Email Form" id="email-form" action="" method="post" name="email-form1">\
                <div class="w-row">\
                  <div class="w-col w-col-8">\
                    <p>Percentage of 10,000 shares to purchase:</p>\
                  </div>\
                  <div class="w-col w-col-3">\
                    <input class="allocation_field w-input" data-name="number_of_shares" id="number_of_shares" maxlength="256" name="numberofshares" placeholder="%"  type="text">\
                  </div>\
                  <div class="info_icon w-col w-col-1">\
                  </div>\
                </div>\
                <p class="or_divider">-OR-</p>\
                <div class="w-row">\
                  <div class="w-col w-col-8">\
                    <p class="allocation_prompt">Enter an amount to allocate to funds:</p>\
                  </div>\
                  <div class="w-col w-col-3">\
                    <input class="allocation_field w-input" data-name="amount_to_allocate" id="amount_to_allocate-2" maxlength="256" name="amounttoallocate" placeholder="$"  type="text">\
                  </div>\
                  <div class="info_icon w-col w-col-1">\
                  </div>\
                </div>\
                <div class="w-clearfix">\
                  <input class="calc_submit w-button" data-wait="Calculating Results..." name="submit" type="button" onclick="cal();" id="calculate" value="Calculate">\
                </div>\
              </form>\
              <div class="w-form-done">\
                <div>Thank you! Your submission has been received!</div>\
              </div>\
              <div class="w-form-fail">\
                <div>Oops! Something went wrong while submitting the form</div>\
              </div>\
            </div>\
            <div class="results_section">\
              <div class="calc_fee_row w-row">\
                <div class="w-col w-col-8">\
                 <h4 class="calc_fee_title">Calculated Fees:</h4>\
                </div>\
                <div class="w-clearfix w-col w-col-4">\
                  <h4 class="fee_total" id="calculated-amount"></h4>\
                </div>\
              </div>\
              <div class="calc_fee_row w-row">\
                <div class="w-col w-col-8">\
                  <div>After 10 years:</div>\
                </div>\
                <div class="w-clearfix w-col w-col-4">\
                  <h4 class="fee_total" id="fee_total_10"></h4>\
                </div>\
              </div>\
              <div class="calc_fee_row w-row">\
                <div class="w-col w-col-8">\
                  <div>After 30 years:</div>\
                </div>\
                <div class="w-clearfix w-col w-col-4">\
                  <h4 class="fee_total" id="fee_total_30"></h4>\
                </div>\
              </div>\
              <div class="calc_fee_row w-row">\
                <div class="w-col w-col-8">\
                  <div>After your remaining years:</div>\
                </div>\
                <div class="w-clearfix w-col w-col-4">\
                  <h4 class="fee_total">$250</h4>\
                </div>\
              </div>\
            </div>\
          </div>\
       </div>\
          ';

          buttonDiv.innerHTML = buttonTpl;
}


function cal(){
  
  var amountvalue =  document.getElementById("amount_to_allocate-2").value;
  var sharevalue =  document.getElementById("number_of_shares").value;
  var sv = '';
  var past = '';
  if(amountvalue != ''){
    var value = amountvalue;
    var curency = '$';
    sv = 1;
    past = 'amounttoallocate='+value;
  }else if(sharevalue != ''){
    var value = sharevalue;
    var curency = '%';
    sv = 2;
    past = 'numberofshares='+value;
  }else{
    alert('Please enter vlaue');
    return false;
  }

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 ) {
      if (xmlhttp.status == 200) {
          var data = JSON.parse(xmlhttp.responseText);
          if(data){
            
            if(sv == 1){
                document.getElementById("calculated-amount").innerHTML = '$'+value;
            }else if(sv == 2){
               document.getElementById("calculated-amount").innerHTML = value+'%';
            }else{
               document.getElementById("calculated-amount").innerHTML = value;
            }

            document.getElementById("fee_total_10").innerHTML = '$'+data.tenyears;
            document.getElementById("fee_total_30").innerHTML = '$'+data.thirtyyears;
            document.getElementById("amount_to_allocate-2").value = '';
            document.getElementById("number_of_shares").value = '';
          }else{

          }
      }
      else if (xmlhttp.status == 400) {
        alert('There was an error 400');
      }
      else {
        alert('something else other than 200 was returned');
      }

    }

  };

  var url = 'http://tm.poly.edu/prospectus/calculation.php?'+past;

  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}