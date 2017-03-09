<html>
  <head>
    <title>Fund Prospectus Comprehension Study</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
  </head>
  <body>
    <form action="home.php" id="form">
      <div class="container">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="study-copy">
              <h1>Fund Prospectus Comprehension Study</h1>
              <p>Thank you for participating in this study on financial funds conducted by researchers at New York University. In this study you will make comments on a complex financial document called a fund prospectus.</p>
              <h2>Pre-study questions</h2>
              <p>What is your level of investing experience?
                <br><input type="radio" name="experience" value="1"><label>None/No experience</label>
                <br><input type="radio" name="experience" value="2"><label>Novice</label>
                <br><input type="radio" name="experience" value="3"><label>Intermediate</label>
                <br><input type="radio" name="experience" value="4"><label>Expert</label>
                <br><input type="radio" name="experience" value="0"><label>Not sure</label><br><br>
              </p>
              <p>Do you have a retirement savings plan such as a 401k or an investment brokerage account?
                <br><input type="radio" name="hasretire" value="1"><label>Yes</label>
                <br><input type="radio" name="hasretire" value="0"><label>No</label><br><br>
              </p>
              <div class="marg">
                <div id="questionMsg" class="red">Please complete all questions to continue.</div>
              </div>
              <hr>
                <h2>Study description</h2>
                <p>
                  The prospectus documents you will see contain financial information about funds people invest as part of their retirement saving.
                </p>
                <p>
   Your task is to read these documents and comment on one document. The document you will comment on has several sections requiring comments. After each section there will be a place for you to comment on it. There are no right or wrong comments. <strong>However, please comment on whether the fund you comment on is better, same or worse than other funds.</strong> Do you best to help other readers understand the implications of the information provided in the prospectus document. Let them know what information is important or what information is not.
                </p>
                <p>
                  There are four sections in the document: Fund Summary, Fund Basics, Shareholder Information, and Fund Services. Please fill out all section and subsection comments areas. We estimate you will spend about 10 minutes in each section reading and the commenting on the section.
                </p>
              </hr>
              <div class="marg">
                <input type="submit" class="btn btn-lg btn-primary" role="button" value="Continue" id="continueBtm">
              </div>
            </div>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </form>
    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/index.js"></script>
  </body>
</html>
