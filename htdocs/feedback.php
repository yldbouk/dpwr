<?php
  session_start();
  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/form.css">
    <meta charset="utf-8">
    <title>Feedback - DPWT</title>
  </head>
  <body>
  <?php
    $homeActive = TRUE;
    require $_SERVER['DOCUMENT_ROOT']."/header.php";
  ?>
      <br><br> 
       <center>
         <!-- SPLITTER -->
      <h1>Submit Feedback</h1><br><h3>Please submit issues, suggestions, or other feedback here.</h3>
      <br><br>
   <?php 
    if (isset($_GET['result'])) {
      if ($_GET['result'] == "success") {
       echo '<h4>Thank you! Your feedback has been submitted.</h4>';
      } elseif ($_GET['result'] == "sqlerror") {
        echo '<h4>An internal error has occured. Please try again later.</h4>';
      } else {
        echo '<h4>An unknown error occured. Please try again.</h4>';
      }
    }
   ?>
      <form action="./scripts/feedback.script.php" method="post">
        <div class="container">
          <label for="name"><b>Name</b></label><br>
          <input type="text" placeholder="Enter Name" <?php if(isset($_SESSION["userName"])) echo 'value="'.$_SESSION["userName"].'"' ?> name="name" required>
            <br><br>
            <input type="radio" name="type" value="issue" checked> Issue<br>
            <input type="radio" name="type" value="suggestion"> Suggestion<br>
            <input type="radio" name="type" value="other"> Other
            <br><br>
          <label for="feedback"><b>Feedback:</b></label><br>
          <textarea cols="60" rows="5" placeholder="Type your feedback in here." name="feedback" required></textarea>
               <br><br>
          <button type="submit" name="feedback-submit">Submit</button>
      </form>
    <br>
        <!-- Consent Form -->
    <div id="consent" class="modal">
      <div class="modal-content">
        <p><b>Please note that misuse of the feedback form may result in you no longer being able to submit feedback. By pressing Agree, you agree to not misuse the feedback form.</b></p>
        <button style="float:left;">Agree</button> 
        <button style="float:right;" class="red">Decline</button>
        <p>&nbsp</p>
      </div>
    </div>
  </center>
         
         <script>
           if(localStorage.getItem("abuseAgreed") != true){
             consent.style.display = "block";
           }

           function
         </script>
  
    <?php 
      require $_SERVER['DOCUMENT_ROOT']."/footer.php";
    ?>
  
  
  </body>
</html>
