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
  <h3> Administrative Page </h3>
  <?php #include "../php/myLib.php"; ?>

<!--<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
  Press here to see the amount of current users: <input type="submit" name="submit" value="Click">
</form> -->
 <p> See below for the current users and their passwords: </p>

<script src="../js/main.js"></script>
<?php
    ini_set('display_errors','On');
    error_reporting(E_ALL);

    $username = $_SESSION["username"];
    $pwd = $_SESSION["pwd"];

      displayJSONUsers();

      function displayJSONUsers() {
       $userDir = realpath("../php/Users/");

       if ($handle = opendir($userDir)) {
         while (false !== ($file = readdir($handle))) {
             if ('.' === $file) continue;
             if ('..' === $file) continue;

             $str = file_get_contents($userDir . "/". $file);
             $json = json_decode($str, true);

             for($i = 0; $i < count(array($json['username'])); $i++){
               echo $json['username'] . " " . $json['password'] . "<br>";
            }
         }
         closedir($handle);
     }
    }
?>

<br>
<!--Credits:
https://stackoverflow.com/questions/4202175/php-script-to-loop-through-all-of-the-files-in-a-directory
https://www.delftstack.com/howto/php/how-to-pass-variable-to-next-page-using-php/
-->
</body>
</html>
