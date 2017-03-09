var App = function() {

};

App.prototype.addEvents = function() {
  var t = this;

  $('input[type="radio"]').click(function() {
    if ($('input[name="experience"]:checked').length &&
      $('input[name="hasretire"]:checked').length) {
     
      $('#questionMsg').hide();
    }
  });

  $('form').submit(function(e) {
    e.preventDefault();
    if ($('input[name="experience"]:checked').length &&
      $('input[name="hasretire"]:checked').length) {
      
      t.createUser();
    } else {
      $('#questionMsg').show();
      window.scrollTo(0, 0);
    } 
  });
};

App.prototype.createUser = function() {
  $('#continueBtn').attr('disabled', 'disabled');
  var postData = {
    experience: $('input[name="experience"]:checked').val(),
    hasretire: $('input[name="hasretire"]:checked').val()};

  $.ajax({
    type: "POST",
    url: "api/create_user.php",
    data: postData,
    success: function(data) {
/*
      switch(data) {
        case '1':
          document.location = "prospectus.php?symbol=SFN&comment=1";
          break;
        case '2':
          document.location = "prospectus.php?symbol=SFQ&comment=1";
          break;
        case '3':
          document.location = "prospectus.php?symbol=SFR&comment=1";
          break;
        case '4':
          document.location = "prospectus_bond.php?symbol=BFA&comment=1";
          break;
        case '5':
          document.location = "prospectus_bond.php?symbol=BFE&comment=1";
          break;
        case '6':
          document.location = "prospectus_bond.php?symbol=BFG&comment=1";
          break;
        case '7':
          document.location = "prospectus_lifecycle.php?symbol=LC4&comment=1";
          break;
        case '8':
          document.location = "prospectus_lifecycle.php?symbol=LC6&comment=1";
          break;
        case '9':
          document.location = "prospectus_lifecycle.php?symbol=LCB&comment=1";
          break;
      }
*/

      document.location = "main.php";
    }
  });
};

App.prototype.init = function() {
  var t = this;

  $('#questionMsg').hide();
  t.addEvents();
};

$(function() {
  var app = new App();
  app.init();
});
