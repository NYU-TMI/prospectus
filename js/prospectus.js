var App = function() {

};

App.prototype.addEvents = function() {
  var t = this;

  $('textarea').change(function() {
    $(this).next().hide();

    t.saveText(this);
  });

  $('button').click(function() {
    var emptyFlag;

    var firstId = "";

    // Check comment field 7
    var id = "#answer7";
    if (!(/\S/.test($(id).val()))) {
      $(id).next().show();  
      firstId = id;
    }
 
    // Check comment fields 4 to 1
    for (var answer = 4; answer > 0; --answer) {
      var id = "#answer" + answer;
      if (!(/\S/.test($(id).val()))) {
        $(id).next().show();  
        firstId = id;
      }
    }

    if (!firstId) {
      t.submitComments();
    } else {

      $('body').scrollTop($(firstId).parent().offset().top - 25);
      $(firstId).focus();
    }
  });
};

App.prototype.saveText = function(section) {
  var postData = {
    id: section.id,
    value: section.value
  };

  $.ajax({
    type: "POST",
    url: "api/temp_answer.php",
    data: postData
  });
}

App.prototype.submitComments = function() {
  var postData = {
    answer1: $('#answer1').val(),
    answer2: $('#answer2').val(),
    answer3: $('#answer3').val(), 
    answer4: $('#answer4').val(),
    answer5: $('#answer5').val(),
    answer6: $('#answer6').val(), 
    answer7: $('#answer7').val(),
    answer8: $('#answer8').val(),
    answer9: $('#answer9').val(), 
    answer10: $('#answer10').val(),
    answer11: $('#answer11').val(),
    documentName: documentName,
    symbol: symbol};
 
  $.ajax({
    type: "POST",
    url: "api/answer.php",
    data: postData,
    success: function() {
      document.location = 'completed.php';
    }
  });
};


App.prototype.yearGraph = function(year, annualRet) {
  var yearGraph = c3.generate({
    bindto: '#year-graph',
    data: {
      columns: [
        annualRet
      ],
      type: 'bar'
    },
    grid: {
      y: {
        lines: [{value: 0}]
      }
    },
    axis: {
      x: {
        type: 'category',
        categories: year
      },
      y: {
        label: {
          text: 'Percentage (%)',
          position: 'outer-top'
        }
      }
    },
    color: {
      pattern: ['#777']
    }
  });
};

App.prototype.fillComments = function() {
  var t = this;

  var getData = {
    symbol: symbol,
    documentName: documentName};
 
  $.ajax({
    type: "GET",
    data: getData,
    url: "api/prospectus_comments.php",
    dataType: 'json',
    success: function(data) {
      // 1 -> comment 1; 2 -> comment 2; ... ; 11 -> comment 11

      for (var commentNum = 0; commentNum < 11; ++commentNum) {
        $('.example')[commentNum].innerText = data[commentNum + 1];
      }

    }
  });
}

App.prototype.fillData = function(name, fees) {
  var t = this;

  var getData = {
    name: name,
    fees: fees};

  $.ajax({
    type: "GET",
    data: getData,
    url: "api/prospectus_data.php",
    dataType: 'json',
    success: function(data) {
      // 0 -> cumulative fees; 1 -> year; 2 -> year's annual return
      // 3 -> highest quarter %; 4 -> highest quarter date
      // 5 -> lowest quarter %; 6 -> lowest quarter date
      // 7 -> final quarter %; 8 -> final quarter date
      // 9 -> fund year's return (feb); 10 -> fund year's return (aug)
      // 11 -> fund year's return (mar)
      $('#cum-fee1').text(parseInt(data[0][1].toFixed(0)));
      $('#cum-fee3').text(parseInt(data[0][3].toFixed(0)));
      $('#cum-fee5').text(parseInt(data[0][5].toFixed(0)));
      $('#cum-fee10').text(parseInt(data[0][10].toFixed(0)));

      var last5Annual = data[2][9] + data[2][8] + data[2][7] + data[2][6] + data[2][5];
      var last10Annual = last5Annual + data[2][4] + data[2][3] + data[2][2] + data[2][1] + data[2][0];
      last5Annual /= 5;
      last10Annual /= 10;

      for (var years = 0; years < data[1].length; ++years) {
        $('#yearTable').children().children()[0].children[years + 1].children[0].children[0].innerText = data[1][years];
        data[2][years] = data[2][years].toFixed(2);
        $('#yearTable').children().children()[1].children[years + 1].children[0].children[0].innerText = data[2][years] + '%';
      }

      $('#return2014').text(data[9][8].toFixed(2));
      $('#return2013').text(data[9][7].toFixed(2));
      $('#return2012').text(data[9][6].toFixed(2));
      $('#return2011').text(data[9][5].toFixed(2));
      $('#return2010').text(data[9][4].toFixed(2));

      $('#return-aug2014').text(data[10][8].toFixed(2));
      $('#return-aug2013').text(data[10][7].toFixed(2));
      $('#return-aug2012').text(data[10][6].toFixed(2));
      $('#return-aug2011').text(data[10][5].toFixed(2));
      $('#return-aug2010').text(data[10][4].toFixed(2));

      $('#return-mar2014').text(data[11][8].toFixed(2));
      $('#return-mar2013').text(data[11][7].toFixed(2));
      $('#return-mar2012').text(data[11][6].toFixed(2));
      $('#return-mar2011').text(data[11][5].toFixed(2));
      $('#return-mar2010').text(data[11][4].toFixed(2));

      t.yearGraph(data[1], ['Year'].concat(data[2]));

      $('#high-quart-pct').text(data[3].toFixed(2));
      $('#high-quart-date').text(data[4]);
      $('#low-quart-pct').text(data[5].toFixed(2));
      $('#low-quart-date').text(data[6]);
      $('#final-quart-pct').text(data[7].toFixed(2));
      $('#final-quart-date').text(data[8]);
      
      $('#last1-annual').text(data[2][9]);
      $('#last5-annual').text(last5Annual.toFixed(2));
      $('#last10-annual').text(last10Annual.toFixed(2));
    }
  });
}

App.prototype.fillMain = function() {
  var t = this;

  var getData = {symbol: symbol};

  $.ajax({
    type: "GET",
    url: "api/prospectus_label.php",
    data: getData,
    dataType: 'json',
    success: function(data) {
      // 0 -> name; 1 -> fee; 2 -> abbreviation; 3 -> recommendation; 4 -> description
      $('.fund-name').text(data[0]);
      $('.symbol').text(data[2]);
      $('.recommendation').text(data[3]);
      $('.description').text(data[4]);

      $('#management-fee').text((0.035 / 0.05 * data[1] * 100).toFixed(2));
      $('#other-fee').text(((0.05 - 0.035) / 0.05 * data[1] * 100).toFixed(2));

      $('#lifecycle-other-fee').text((0.05 / 0.64 * data[1] * 100).toFixed(2));
      $('#lifecycle-acquired-fee').text((0.59 / 0.64 * data[1] * 100).toFixed(2));

      $('.fee').text((data[1] * 100).toFixed(2));

      $('body').fadeTo(250, 1);

      //t.fillComments();
      t.fillData(data[0], data[1]);
    }
  });
}

App.prototype.fillTempAns = function() {
  $.ajax({
    type: "GET",
    url: "api/return_temp_answers.php",
    dataType: 'json',
    success: function(data) {
      // 1 -> #answer1; 2 -> #answer2; ... ; 11 -> #answer11

      for (var ansNum = 1; ansNum < 12; ++ansNum) {
        var id = $('#answer'+ansNum);
        id.val(data[ansNum]);
      }
    }
  });
}

App.prototype.init = function() {
  var t = this;

  t.fillMain();
  t.fillTempAns();
  t.fillComments();

  t.addEvents();
};

$(function() {
  var app = new App();
  app.init();

});
