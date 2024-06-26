<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel ="stylesheet" href='https://fonts.googleapis.com/css?family=Didact Gothic'>
  <link rel="stylesheet" href="../css/main.css">

</head>
<body>
  <!-- The overlay -->
  <div id="myNav" class="overlay">
    <!-- Button to close the overlay navigation -->
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

    <!-- Overlay content -->
    <div class="overlay-content">
      <a href="main.html.php">Home</a>
      <a href="orgs.html.php">Organizations</a>
            <!--Credits:
              https://stackoverflow.com/questions/13156260/sessions-in-php-with-json-and-ajax
              https://stackoverflow.com/questions/42409310/how-to-make-menu-tab-invisible-if-the-user-is-not-admin
            -->

            <!--If the user logs in and is not the admin, show the Survey and Log out tabs, and their username-->
            <?php if (isset($_SESSION["username"]) && (($_SESSION["username"]!="Admin"))){?>
                    <a href="survey.html.php">Survey</a>
                    <br>
                    <br>
                    <a href ="#"><?php echo $_SESSION["username"]; ?></a>
                    <a href="../php/logout.html.php">Log Out</a>

          <!--Else if the Admin logs in (both user and password have to be right), show the Survey, Admin, and Log out tabs-->
          <?php } elseif (($_SESSION["username"]=="Admin") && ($_SESSION["pwd"]=="private")){?>
                  <a href="survey.html.php">Survey</a>
                  <br>
                  <br>
                  <a href="admin.html.php">Admin</a>
                  <a href="../php/logout.html.php">Log Out</a>

            <!--Else, if the user is not logged in, show the Log In tab-->
            <?php } else { ?>
                 <a href="loginT.html.php">Log In</a>
            <?php } ?>
    </div>
  </div>

  <!-- Menu hamburger icon to open the Nav Menu-->
  <div onclick="openNav()">
    <div class="bars"></div>
    <div class="bars"></div>
    <div class="bars"></div>
  </div>

  <div class="full-height">
    <div class="imgC">
      <img src="images/doubrava.jpg" alt="Doubrava Valley, Czech Republic" class="welcomeImg" style="width:100%;">
      <div class="imgTxt"> <h2 class="mainImg"> EnviroYou </h2>
        <h3 class="centDiv mainImg"> A place where you can find ways to participate in organizations that help nurture the Earth
          and communities near you! </h3>
        <br>
        <h3 class="centDiv mainImg"> Sign in to take our quick survey and find a local organization that matches your values and needs! <h3>
        <br>
        <button class="buttonS" onclick="location.href ='loginT.html.php'">Sign In</button>
      </div>
    </div>
  </div>


  <script src="../js/main.js"></script>
</body>
</html>
