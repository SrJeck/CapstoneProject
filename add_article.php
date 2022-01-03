<?php
session_start();
if (isset($_SESSION['user_id'])) {
  $id = $_SESSION['user_id'];
}
?>
<html>

<head>
  <meta charset="utf-8">
  <title>Add Article</title>
  <script type="text/javascript" src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/addarticle.css">
  <link rel="stylesheet" type="text/css" href="css/notification.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    .number {
      height: 26px;
      width: 24px;
    }

    #dialog {

      top: 65px;
    }

    .txt {
      width: 370px;
    }
  </style>
</head>

<body>
  <!-- NAVBAR -->
  <?php

  $notif = "";
  $dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");

  $notif = "";
  $dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
  $total_count = 0;
  $unseen_count = $dbh->prepare('select COUNT(*) as unseen_count from notification where seen_status="unseen" and user_id=?');
  $unseen_count->bindParam(1, $id);
  $unseen_count->execute();
  $unseened_count = $unseen_count->fetch();
  $total_count =$total_count + $unseened_count['unseen_count'];
  $unseen_count2 = $dbh->prepare('select * from inquiry where user_id=? and seen_status="unseen"');
  $unseen_count2->bindParam(1, $id);
  $unseen_count2->execute();
  while ($unseened_count2 = $unseen_count2->fetch()) {
    if (!empty($unseened_count2['reply']) ) {
        $total_count =$total_count + 1;
    }
  }

  if (isset($_SESSION['user_id'])) {
    echo '<div class="navbar">
    <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
    <a style="margin-top: 6px;" href="research.php">RESEARCH</a>
    <a style="margin-top: 6px;" href="analytics.php">ANALYTICS</a>
    <a style="margin-top: 6px;" href="contact_us.php">CONTACT US</a>
    <div class="tooltip">
    <a style="float: right;" href="logout.php"><img style="height: 25px;" src="images/logoutIcon.png"></a>
    <span class="tooltiptext">Logout</span>
    </div>
    <div class="tooltip">
    <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <span class="tooltiptext">Profile</span>
    </div>
    <div class="tooltip">
    <a style="float: right;" href="bookmark.php"><img style="height: 25px;" src="images/bookmark.png"></a>
    <span class="tooltiptext">Bookmark</span>
    </div>
    <div class="tooltip">
    <a style="float: right;" href="add_article.php"><img style="height: 25px;" src="images/plussign.png"></a>
    <span class="tooltiptext">Add Article</span>
    </div>
    <div class="tooltip">
    <span class="tooltiptext">Notification</span>
    <a style="float: right;">
    <div class="notBtn" href="#" onclick="seeNotif()">
            <div class="number" > ' . $total_count . ' </div>
            <i style="font-size:24px;height: 25px;" id="showdialog" class="fa fatest">&#xf0f3;</i>
        <div class="box" id="dialog" id="box" style="display:none">
                <div class="display">
                <div class="cont">
                    <!-- Fold this div and try deleting evrything inbetween -->
                    <div class="sec test">
                            <div class="txt"></div>
                    </div>
            </div> 
            </div>
        </div>
    </div>
    </a>
    </div>
</div>

    ';
  } else {
    echo '<div class="navbar">
    <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
    <a style="margin-top: 6px;" href="research.php">RESEARCH</a>
    <a style="margin-top: 6px;" href="analytics.php">ANALYTICS</a>
    <a class="ol-login-link" href="logOrProf.php"><span class="icons_base_sprite icon-open-layer-login"><strong style="margin-left:30px">Log in through your library</strong> <span>to access more features.</span></span></a>
    <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    </div>';
  }
  ?>
  <!-- Form -->
  <div class="container">
    <form id="add_article_form" action="plagscan_process.php" method="post" enctype="multipart/form-data">
      <h3>Add Article</h3><br>
      <fieldset>
        <label>Abstract:</label>
        <textarea type="text" name="abstract" placeholder="Enter your abstract here" id="abstract" rows="7" cols="50" required></textarea>
      </fieldset>
      <fieldset>
        <label>Title:</label>
        <input type="text" name="title" id="title" placeholder="Title" required>
      </fieldset>
      <fieldset>
        <label>Authors:</label>
        <input type="text" name="author" id="author" placeholder="Ex. Pineda M., Dizon J., Ramos L., Reyes J." required>
      </fieldset>
      <fieldset>
        <label class="test" for="name">Publication Date:</label>
        <div class="inline">
          <input class="test2" type="text" id="publication_month" name="publication_month" placeholder="Month (ex. January, February, March)" required />
          <input class="test2" type="text" id="publication_day" name="publication_day" placeholder="Day (ex. 08, 24, 31)" required />
          <input class="test2" type="text" id="publication_year" name="publication_year" placeholder="Year (ex. 2021, 2022, 2023)" required />
        </div>
      </fieldset>
      <fieldset>
        <label>Institution:</label>
        <input type="text" name="institution" id="institution" placeholder="Institution" required>
      </fieldset>
      <fieldset>
        <label>Degree Level:</label>
        <select name="degree_level" id="degree_level" required>
          <option value="" selected disabled hidden>Select degree level</option>
          <option value="Professional Certificates">Professional Certificates</option>
          <option value="Undergraduate Degrees">Undergraduate Degrees</option>
          <option value="Transfer Degrees">Transfer Degrees</option>
          <option value="Associate Degrees">Associate Degrees</option>
          <option value="Bachelor Degrees">Bachelor Degrees</option>
          <option value="Graduate Degrees">Graduate Degrees</option>
          <option value="Master Degrees">Master Degrees</option>
          <option value="Doctoral Degrees">Doctoral Degrees</option>
          <option value="Professional Degrees">Professional Degrees</option>
        </select>
      </fieldset>
      <fieldset>
        <label>Topic:</label>
        <select name="topic" id="topic" required>
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
      </fieldset>
      <fieldset>
        <label>Research Type:</label>
        <select name="research_type" id="research_type" required>
          <option value="" selected disabled hidden>Select research type</option>
          <option value="Capstone Project">Capstone Project</option>
          <option value="Undergraduate Thesis">Undergraduate Thesis</option>
          <option value="Master’s Thesis">Master’s Thesis</option>
          <option value="Dissertation">Dissertation</option>
          <option value="Practice Based">Practice Based</option>
        </select>
      </fieldset>
      <fieldset>
        <label>Keywords:</label>
        <input type="text" placeholder="Ex. Thesis, Quo, Research" id="keywords" name="keywords">
      </fieldset>
      <fieldset>
        <label>Publisher:</label>
        <input type="text" name="publisher" id="publisher" placeholder="Publisher" required>
      </fieldset>
      <fieldset>
        <label>Permission Type:</label>
        <br>
        <input type="radio" id="view_only" name="permission" value="View Only">
        <label>View Only</label>
        <input style="margin-left: 20px;" type="radio" id="download_only" name="permission" value="Download Only">
        <label>Download Only</label>
        <input style="margin-left: 20px;" type="radio" id="view_download" name="permission" value="View and Download">
        <label>View and Download</label><br>
      </fieldset>
      <div class="file-upload">
        <input class="file-upload__input" type="file" name="myfile" accept="application/pdf" id="myFile" multiple>
        <button class="file-upload__button" type="button">Choose File(s)</button>
        <span class="file-upload__label"></span>
        <script type="text/javascript" src="js/custom.js"></script>
      </div>
      <fieldset>
        <br>
        <div class="terms">
          <p class="detail">I agree to the <span id="myBtn">Terms & Conditions </span>and <span id="myBtns">Privacy Policy.</span>
            <input onclick="changeColor('sendNewSms')" type="checkbox" ng-model="chkvalue" class="ng-valid ng-dirty ng-valid-parse ng-touched ng-pristine ng-untouched ng-empty" id="checkme" />
          </p>
        </div>
        <!-- The Modal -->
        <div id="myModal" class="modal">

          <!-- Modal content -->
          <div class="modal-content">
            <span class="close">&times;</span>
            <p>
              <strong style="font-size: 18;">Terms and Conditions</strong><br>
            <p>Welcome to ThesisQuo! <br><br>
              These terms and conditions outline the rules and regulations for the use of ThesisQuo inc's Website, located at ThesisQuo.com. <br><br>
              By accessing this website we assume you accept these terms and conditions. Do not continue to use ThesisQuo if you do not agree to take all of the terms and conditions stated on this page. <br> <br>
              The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: "Client", "You" and "Your" refers to you, the person log on this website and compliant to the Company’s terms and conditions. "The Company", "Ourselves", "We", "Our" and "Us", refers to our Company. "Party", "Parties", or "Us", refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client’s needs in respect of provision of the Company’s stated services, in accordance with and subject to, prevailing law of Netherlands. Any use of the above terminology or other words in the singular, plural, capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same.
            </p>
            <strong style="font-size: 18;">Cookies</strong>
            <p>We employ the use of cookies. By accessing ThesisQuo, you agreed to use cookies in agreement with the ThesisQuo inc's Privacy Policy.</p>
            <p>Most interactive websites use cookies to let us retrieve the user’s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.</p>
            </p>
            <strong style="font-size: 18;">License</strong>
            <p>Unless otherwise stated, ThesisQuo inc and/or its licensors own the intellectual property rights for all material on ThesisQuo. All intellectual property rights are reserved. You may access this from ThesisQuo for your own personal use subjected to restrictions set in these terms and conditions.</p>
            <p>You must not: <br>
            <ul>
              <li>Republish material from ThesisQuo</li>
              <li>Sell, rent or sub-license material from ThesisQuo</li>
              <li>Reproduce, duplicate or copy material from ThesisQuo</li>
              <li>Redistribute content from ThesisQuo</li>
            </ul>
            <p>This Agreement shall begin on the date hereof. Our Terms and Conditions were created with the help of the Terms And Conditions Generator.</p>
            <p>Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. ThesisQuo inc does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of ThesisQuo inc,its agents and/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, ThesisQuo inc shall not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a result of any use of and/or posting of and/or appearance of the Comments on this website.</p>
            <p>ThesisQuo inc reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes breach of these Terms and Conditions.</p>
            <p>You warrant and represent that: <br>
            <ul>
              <li>You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;</li>
              <li>The Comments do not invade any intellectual property right, including without limitation copyright, patent or trademark of any third party;</li>
              <li>The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material which is an invasion of privacy</li>
              <li>The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.</li>
            </ul>
            </p>
            <p>You hereby grant ThesisQuo inc a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.</p>
            </p>
            <strong style="font-size: 18;">Hyperlinking to our Content</strong>
            <p>The following organizations may link to our Website without prior written approval:</p>
            <p>
            <ul>
              <li>Government agencies</li>
              <li>Search engines;</li>
              <li>News organizations;</li>
              <li>Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses; and</li>
              <li>System wide Accredited Businesses except soliciting non-profit organizations, charity shopping malls, and charity fundraising groups which may not hyperlink to our Web site.</li>
              <li>These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and/or services; and (c) fits within the context of the linking party’s site.</li>
            </ul>
            </p>
            <p>We may consider and approve other link requests from the following types of organizations: <br>
            <ul>
              <li>commonly-known consumer and/or business information sources;</li>
              <li>dot.com community sites;</li>
              <li>associations or other groups representing charities;</li>
              <li>online directory distributors;</li>
              <li>internet portals;</li>
              <li>accounting, law and consulting firms; and</li>
              <li>educational institutions and trade associations.</li>
            </ul>
            </p>
            <p>We will approve link requests from these organizations if we decide that: (a) the link would not make us look unfavorably to ourselves or to our accredited businesses; (b) the organization does not have any negative records with us; (c) the benefit to us from the visibility of the hyperlink compensates the absence of ThesisQuo inc; and (d) the link is in the context of general resource information.</p>
            <p>These organizations may link to our home page so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products or services; and (c) fits within the context of the linking party’s site.</p>
            <p>If you are one of the organizations listed in paragraph 2 above and are interested in linking to our website, you must inform us by sending an e-mail to ThesisQuo inc. Please include your name, your organization name, contact information as well as the URL of your site, a list of any URLs from which you intend to link to our Website, and a list of the URLs on our site to which you would like to link. Wait 2-3 weeks for a response.</p>
            <p>Approved organizations may hyperlink to our Website as follows: <br>
            <ul>
              <li>By use of our corporate name; or</li>
              <li>By use of the uniform resource locator being linked to; or</li>
              <li>By use of any other description of our Website being linked to that makes sense within the context and format of content on the linking party’s site.</li>
            </ul>
            </p>
            <p>No use of ThesisQuo inc's logo or other artwork will be allowed for linking absent a trademark license agreement.</p>
            <strong style="font-size: 18;">iFrames</strong>
            <p>Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website.</p>
            <strong style="font-size: 18;">Content Liability</strong>
            <p>We shall not be hold responsible for any content that appears on your Website. You agree to protect and defend us against all claims that is rising on your Website. No link(s) should appear on any Website that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or other violation of, any third party rights.</p>
            <strong style="font-size: 18;">Your Privacy</strong>
            <p>Please read Privacy Policy</p>
            <strong style="font-size: 18;">Reservation of Rights</strong>
            <p>We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amen these terms and conditions and it’s linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.</p>
            <strong style="font-size: 18;">Removal of links from our website</strong>
            <p>If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.</p>
            <p>We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.</p>
            <strong style="font-size: 18;">Disclaimer </strong>
            <p>To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website. Nothing in this disclaimer will:</p>
            <ul>
              <li>limit or exclude our or your liability for death or personal injury;</li>
              <li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;</li>
              <li>limit any of our or your liabilities in any way that is not permitted under applicable law; or</li>
              <li>exclude any of our or your liabilities that may not be excluded under applicable law.</li>
            </ul>
            <p>The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty.</p>
            <p>As long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.</p>
          </div>
        </div>

        <!-- Privacy and Policy -->
        <div id="myModals" class="modal">

          <!-- Modal content -->
          <div class="modal-content">
            <span class="close1">&times;</span>
            <p>
              <strong style="font-size: 18;">Privacy Policy</strong><br>
            <p>At ThesisQuo, accessible from ThesisQuo.com, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by ThesisQuo and how we use it.</p>
            <p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.</p>
            <p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in ThesisQuo. This policy is not applicable to any information collected offline or via channels other than this website. Our Privacy Policy was created with the help of the Free Privacy Policy Generator.</p>
            <strong style="font-size: 18;">Consent</strong><br>
            <p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>
            <strong style="font-size: 18;">Information we collect</strong><br>
            <p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.</p>
            <p>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.</p>
            <p>When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.</p>
            <strong style="font-size: 18;">How we use your information</strong><br>
            <p>We use the information we collect in various ways, including to:</p>
            <ul>
              <li>Provide, operate, and maintain our website</li>
              <li>Improve, personalize, and expand our website</li>
              <li>Understand and analyze how you use our website</li>
              <li>Develop new products, services, features, and functionality</li>
              <li>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website, and for marketing and promotional purposes</li>
              <li>Send you emails</li>
              <li>Find and prevent fraud</li>
            </ul>
            <strong style="font-size: 18;">Log Files</strong><br>
            <p>ThesisQuo follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users' movement on the website, and gathering demographic information.</p>
            <strong style="font-size: 18;">Cookies and Web Beacons</strong><br>
            <p>Like any other website, ThesisQuo uses 'cookies'. These cookies are used to store information including visitors' preferences, and the pages on the website that the visitor accessed or visited. The information is used to optimize the users' experience by customizing our web page content based on visitors' browser type and/or other information.</p>
            <p>For more general information on cookies, please read more on the Cookie Consent website.</p>
            <strong style="font-size: 18;">Google DoubleClick DART Cookie</strong><br>
            <p>Google is one of a third-party vendor on our site. It also uses cookies, known as DART cookies, to serve ads to our site visitors based upon their visit to www.website.com and other sites on the internet. However, visitors may choose to decline the use of DART cookies by visiting the Google ad and content network Privacy Policy at the following URL – https://policies.google.com/technologies/ads</p>
            <strong style="font-size: 18;">Our Advertising Partners</strong><br>
            <p>Some of advertisers on our site may use cookies and web beacons. Our advertising partners are listed below. Each of our advertising partners has their own Privacy Policy for their policies on user data. For easier access, we hyperlinked to their Privacy Policies below.</p>
            <ul>
              <li>Google</li>
            </ul>
            <p>https://policies.google.com/technologies/ads</p>
            <strong style="font-size: 18;">Advertising Partners Privacy Policies</strong><br>
            <p>You may consult this list to find the Privacy Policy for each of the advertising partners of ThesisQuo.</p>
            <p>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on ThesisQuo, which are sent directly to users' browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.</p>
            <p>Note that ThesisQuo has no access to or control over these cookies that are used by third-party advertisers.</p>
            <strong style="font-size: 18;">Third Party Privacy Policies</strong><br>
            <p>ThesisQuo's Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options.</p>
            <p>You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers' respective websites.</p>
            <strong style="font-size: 18;">CCPA Privacy Rights (Do Not Sell My Personal Information)</strong><br>
            <p>Under the CCPA, among other rights, California consumers have the right to:</p>
            <p>Request that a business that collects a consumer's personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.</p>
            <p>Request that a business delete any personal data about the consumer that a business has collected.</p>
            <p>Request that a business that sells a consumer's personal data, not sell the consumer's personal data.</p>
            <p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>
            <strong style="font-size: 18;">GDPR Data Protection Rights</strong><br>
            <p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>
            <p>The right to access – You have the right to request copies of your personal data. We may charge you a small fee for this service.</p>
            <p>The right to rectification – You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.</p>
            <p>The right to erasure – You have the right to request that we erase your personal data, under certain conditions.</p>
            <p>The right to restrict processing – You have the right to request that we restrict the processing of your personal data, under certain conditions.</p>
            <p>The right to object to processing – You have the right to object to our processing of your personal data, under certain conditions.</p>
            <p>The right to data portability – You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.</p>
            <p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>
            <strong style="font-size: 18;">Children's Information</strong><br>
            <p>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity.</p>
            <p>ThesisQuo does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</p>
            </p>
          </div>

        </div>
        <script>
          // Get the modal
          var modal = document.getElementById("myModal");

          // Get the button that opens the modal
          var btn = document.getElementById("myBtn");

          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("close")[0];

          // When the user clicks the button, open the modal 
          btn.onclick = function() {
            modal.style.display = "block";
          }

          // When the user clicks on <span> (x), close the modal
          span.onclick = function() {
            modal.style.display = "none";
          }

          // When the user clicks anywhere outside of the modal, close it
          window.onclick = function(event) {
            if (event.target == modal) {
              modal.style.display = "none";
            }
          }
        </script>
        <script>
          // Get the modal
          var modals = document.getElementById("myModals");

          // Get the button that opens the modal
          var btn = document.getElementById("myBtns");

          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("close1")[0];

          // When the user clicks the button, open the modal 
          btn.onclick = function() {
            modals.style.display = "block";
          }

          // When the user clicks on <span> (x), close the modal
          span.onclick = function() {
            modals.style.display = "none";
          }

          // When the user clicks anywhere outside of the modal, close it
          window.onclick = function(event) {
            if (event.target == modal) {
              modals.style.display = "none";
            }
          }
        </script>
        <button name="submit" class="submit" type="submit" id="sendNewSms" data-submit="...Sending">Submit</button>
        <script>
          var checker = document.getElementById('checkme');
          var sendbtn = document.getElementById('sendNewSms');
          // when unchecked or checked, run the function
          checker.onchange = function() {
            if (this.checked) {
              sendNewSms.style.backgroundColor = "#157572";

              sendbtn.disabled = false;
            } else {
              sendNewSms.style.backgroundColor = "#b8bdbd";
              sendbtn.disabled = true;
            }

          }
        </script>
      </fieldset>
    </form>


  </div>
</body>

</html>