var App = function() {

};

App.prototype.addEvents = function() {

  $('#commentsForm').submit(function(e) {
    e.preventDefault();
    var postData = {comments: $('#commentsTextArea').val()};

    $.ajax({
      type: "POST",
      url: "api/comments.php",
      data: postData,
      success: function(data) {
        $('#commentsArea').html('<p>Thank you for your comments.</p>');
      }
    });
  });
};

App.prototype.init = function() {
  var t = this;

  t.addEvents();
};

$(function() {
  var app = new App();
  app.init();
});
