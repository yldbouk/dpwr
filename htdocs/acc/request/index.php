<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/form.css">
    <meta charset="utf-8">
    <title>Request Access - DPWT</title>
  </head>
  <body>
    <header>
      <div class="header">
        <a href="../../" class="logo">D P W T</a>
        <div class="header-right">
          <nav>
            <?php if(isset($_SESSION['userUid'])) echo "<text>".$_SESSION['userUid']."</text>"?><a />
            <a href="/">Home</a>
            <a href="../../console">Console</a>
            <?php
            if (isset($_SESSION['userUid'])) {
              echo '<a class="blacknav" href="acc/logout">Logout</a>';
            } else {
              echo '<a class="blacknav" href="acc/">Login</a>';
            }
            ?>
          </nav>
        </div>
      </div>
    </header>
      <br><br>
       <center>
         <!-- SPLITTER -->
      <h1>Request Access</h1><h6>If you need access to the Dimensional Printing Web Terminal, you can get it here. Just fill out the form, and you will recieve your access shortly.</h6>
      <br>
      <?php 
    if (isset($_GET['result'])) {
      if ($_GET['result'] == "incomplete") {
       echo '<h4>Please Fill out all Fields.</h4>';
      } elseif ($_GET['result'] == "emailandusr") {
        echo '<h4>Please check your username and email and try again.</h4>';
      } elseif ($_GET['result'] == "email") {
        echo '<h4>Please check your email and try again.</h4>';
      } elseif ($_GET['result'] == "username") {
        echo '<h4>Please check your username and try again.</h4>';
      } elseif ($_GET['result'] == "pwd") {
        echo '<h4>Your passwords did not match. Please ty again.</h4>';
      } elseif ($_GET['result'] == "sqlerror") {
        echo '<h4>An internal error has occured. Please try again later.</h4>';
      } elseif ($_GET['result'] == "usertaken") {
        echo '<h4>That username is already taken. You can log in <a href="../login">here.</a></h4>';
      } else {
        echo '<h4>An unknown error occured. Please try again.</h4>';
      }
    }
   ?>
   
      <form action="../scripts/signup.script.php" method="post">
        <div class="container">
          <label for="user"><b>Username</b></label><br>
          <input type="text" placeholder="Username" name="uname" required>
            <br>
          <label for="name"><b>Full Name</b></label><br>
          <input type="text" placeholder="Full Name" name="name" required>
            <br>
          <label for="email"><b>Email</b></label><br> 
          <input type="text" placeholder="Email" name="email" required>
            <br>
          <label for="psw"><b>Password</b></label><br> 
          <input type="password" placeholder="Password" name="psw" required>
            <br>
          <label for="psw2"><b>Repeat Password</b></label><br> 
          <input type="password" placeholder="Repeat Password" name="psw2" required>
          <button type="submit" name="signup-submit">Request Access</button>
      </form>
    </center>
  
    <?php 
      require "../../footer.php";
    ?>
  
  
  </body>
</html>
