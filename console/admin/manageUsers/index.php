<?php
session_start();
if (isset($_GET['edit'])) $id = $_GET['edit'];
  $access = "true";
  require "scripts/getUsers.script.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/form.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <meta charset="utf-8">
  <title>Manage User Accounts - DPWT</title>
</head>

<body>
  <header>
    <div class="header">
      <a href="/" class="logo">D P W T</a>
      <div class="header-right">
        <nav>
          <?php echo "<text>".$_SESSION['userUid']."</text>"; ?><a />
          <a href="/">Home</a>
          <a class="active" href='/console'>Console</a> <a />
          <a class="blacknav" href="/acc/logout">Logout</a>
        </nav>
      </div>
    </div>
  </header>
  <!-- SPLITTER -->
  <br>
  <center>
    <input type="text" id="search" placeholder="Search">
    <table id="jobs">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Username</th>
          <th>Email</th>
          <th>Permission Rank</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
            if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                echo "
                  <tr>
                  <td>".$row["idUsers"]."</td>
                  <td>".$row["nameUsers"]."</td>
                  <td>".$row["uidUsers"]."</td>
                  <td>".$row["emailUsers"]."</td>
                  <td>".$row["permsUsers"]."</td>
                  <td><i><a onclick='editActions(".$row["idUsers"].")'>View</a></i></td>
                  </tr>
                  ";
              }
            } else {
            echo "
            <tr>
            <td>No Results. This is most likely an error.</td>
            </tr>
            ";
        } ?>
      </tbody>
    </table>

  </center>
  <!-- SPLITTER -->

  <script>
    var $rows = $('#jobs tr');
    $('#search').keyup(function() {
      var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
      $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
      }).hide();
    });

    function editActions(id) {
      document.location = "./?edit="+id;
    }
  </script>
  <div id="editActions" class="upload">
    <div class="uploadc">
      <div class="container">
        <label><b>Edit User: </b></label><br><br>
        <center>
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Permission Rank</th>
              </tr>
            </thead>
            <?php 
       echo "
       <tr>
       <td>".$id."</td>
       <td>".$name."</td>
       <td>".$username."</td>
       <td>".$email."</td>
       <td>".$perms."</td>
       </tr>
       ";
       ?>
          </table>
          <br><br>
          <form method='post' id="editform" action='scripts/editUsers.script.php'>
            <input type="text" style="visibility:hidden;" name="id" value="<?php echo $id?>">
            <input id="delete" type="text" name="delete" style="visibility:hidden;"><br>
            <?php echo '|<button style="background:none!important;color:inherit;border:none;padding:0!important;font:inherit;border-bottom:1pxsolid#444;cursor:pointer;"type="submit"name="edit-perms"><b><i>Change Permissions</i></b></button>|';?>
            <?php echo '|<button style="background:none!important;color:inherit;border:none;padding:0!important;font:inherit;border-bottom:1pxsolid#444;cursor:pointer;"type="submit"name="edit-user"><b><i>Edit User</i></b></button>|';?>
            <?php echo '|<button style="background:none!important;color:red;border:none;padding:0!important;font:inherit;border-bottom:1pxsolid#444;cursor:not-allowed;"type="button"onclick="editdelete();"><b><i>Delete User</i></b></button>|';?>
          </form>


        </center>
      </div>
      <div class="container" style="padding: 16px; text-align: center; background-color:#f1f1f1">
        <button type="button" onclick="document.location='./'" class="cancelbtn">OK</button>
      </div>
    </div>
  </div>
  <?php if (isset($_GET['edit'])) echo "<script>document.getElementById('editActions').style.display='block'</script>"; ?>
  <script>
    function editdelete() {
      var tmp008=prompt('WARNING: YOU ARE ABOUT TO FULLY DELETE THE USER, "<?php echo $username; ?>". THIS WILL DELETE ALL DATA AND JOBS RELATED TO THIS USER. TO CONTINUE, TYPE IN THE NAME OF THAT USER (<?php echo $username; ?>)');
      if (tmp008 == "<?php echo $username; ?>"){
        document.getElementById("delete").value = "true";
        document.getElementById("editform").submit();
      } else alert("Delete Aborted: Names do not match.")
    }
  </script>
  <?php require "../../../footer.php"; ?>
</body>

</html>