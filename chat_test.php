<html>

<head>
  <title>Chat TEST</title>
  <script type="text/javascript" src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/add_article.css">
  <link rel="stylesheet" type="text/css" href="css/notification.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>

<body>
<button class="questions" style="display:block" onclick="questionType(1)">How to Upload Study?</button>
<button class="questions"  style="display:block" onclick="questionType(2)">What study would you recommend for me to read?</button>
<button class="questions"  style="display:block" onclick="questionType(3)">What study topic can i develop?</button>
<div class="answer1" style="display:none">You must have an account before you upload your papers, if you are already a member, you may follow these steps:
    <br><br>
    1. Click the add (+) button on the navigation bar to upload your papers
    <br>
    2. Fill out the fields required by the admin to upload paper.
    <br>
    3. Read and Accept the Privacy Policy & Terms and Condition before submitting the paper.
    <br>
    4. Wait for the Plagiarism result if accepted or not.
    <br>
    5. If the paper passed the Plagiarism test, the paper will be upload. if not, the User must revise and re-upload the paper.
    <br><br><br>
</div>
<button class="answer1" style="display:none" onclick="reset()">Ok</button>
<select class="answer2" style="display:none" name="topic" id="topic" required>
          <option value="" selected disabled hidden>Select topic type</option>
          <option value="Education">Education</option>
          <option value="Technology">Technology</option>
          <option value="Research">Research</option>
          <option value="Analysis">Analysis</option>
          <option value="Database">Database</option>
          <option value="Agriculture">Agriculture</option>
          <option value="Health">Health</option>
          <option value="Politics">Politics</option>
          <option value="Psychology">Psychology</option>
          <option value="Business">Business</option>
          <option value="Marketing and Advertising">Marketing and Advertising</option>
          <option value="Mechanical">Mechanical</option>
          <option value="Ethics">Ethics</option>
          <option value="Others">Others</option>
        </select>
<button class="answer2" style="display:none" onclick="selectedTopic()">select</button>
<!-- <button class="answer2"  style="display:none" onclick="analytics('Education')">Education</button>
<button class="answer2"  style="display:none" onclick="analytics('Technology')">Technology</button>
<button class="answer2"  style="display:none" onclick="analytics('Business')">Business</button> -->
<div class="analyticsResult" style="display:none">I Recommend these studies:
</div>
<button class="analyticsResult" style="display:none" onclick="analyticsQuestionType(1)">Do you want another question suggestion from other topics?</button>
<button class="analyticsResult" style="display:none" onclick="analyticsQuestionType(2)">Do you have any specific question for me?</button>
<button class="analyticsAnswer1" style="display:none" onclick="analyticsAnswerType('yes')">Yes</button>
<button class="analyticsAnswer1" style="display:none" onclick="analyticsAnswerType('no')">No</button>
<div class="analyticsAnswer2"  style="display:none">Send your Question to this email thesisquo.helpdesk@gmail.com</div>
<button class="analyticsAnswer2"  style="display:none" onclick="reset()">Ok</button>
<div class="answer3"   style="display:none">What do you want to develop?</div>
<button class="answer3" style="display:none" onclick="developmentType(1)">Uniqie Study</button>
<button class="answer3" style="display:none" onclick="developmentType(2)">More Resources Available</button>
<div class="development1" style="display:none">Show overall Lowest number of uploaded topic</div>
<div class="development2" style="display:none">Show overall Highest number of uploaded topic</div>
<div class="development"  style="display:none">Do you have any specific question for me?</div>
<button class="development" style="display:none" onclick="developmentAnswerType('yes')">Yes</button>
<button class="development" style="display:none"  onclick="developmentAnswerType('no')">No</button>
<div class="developmentQuestions" style="display:none">Send your Question to this email thesisquo.helpdesk@gmail.com</div>
<button class="developmentQuestions"  style="display:none" onclick="reset()">Ok</button>
</body>