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


<div class="form-popup" id="myForm">
  <!--<form action="../php/action_page.php" method = "post" class="form-container">-->
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method = "post" class="form-container">

    <h1>Login</h1>
    <i> Scroll down and click the screen to have some firework fun! </i>
    <br>
    <br>
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <button type="submit" class="btn" >Login</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

<?php

  if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $user = $_POST["uname"];
    $password = $_POST["psw"];
    $_SESSION["username"] = $user;
    $_SESSION["pwd"] = $password;

            $filename = "../php/Users/" . $user . ".json";
            if (file_exists($filename)) {  //if the user already exists
                $str = file_get_contents($filename);
                $json = json_decode($str, true);
                $userMatch = false;

                for($i = 0; $i < count($json['username']); $i++){
                  //If the Login user is one that matches one in a JSON file, return true
                  if($user == $json['username']){
                    $userMatch = true;
                  }
                  //Else, leave userMatch as false
                  elseif($user != $json['username']){
                  }
                }

               for($i = 0; $i< count($json['password']); $i++){
                 $pwdMatch = false;

                 //If the Login user is one that matches one in a JSON file, return true
                 if($password == $json['password']){
                   $pwdMatch = true;
                 }
                 //Else, leave userMatch as false
                 elseif($password != $json['password']){
                 }
               }

               /*Only let them log in if the username & password match*/
               if($userMatch and $pwdMatch){
                 echo "Welcome back, " . $user . "!" . "<br>";
                 echo "Feel free to take the survey." . "<br>";
                 echo "Please refresh to see your new menu options!";
               }
               /*Let them know that the username is taken by another user,
              doesn't prevent them from signing in though, I think?*/
               elseif($userMatch and !$pwdMatch){
                 echo "This username exists already.";
               }
            }

            else { //If the user does not exist, create a new file for them
                echo "Welcome, " . $user . "! \n";
                echo "You can now take the survey.";
                $myfile = fopen($filename, "w") or die("Unable to open file!"); //Create a file
                $userarray = array("username" => $user, "password" => $password); // Php user array containing their username and password
                $json_array = json_encode($userarray); //Turns the array into a JSON object
                fwrite($myfile, $json_array); //Writes the JSON object into the JSON file
                fclose($myfile);
                return true;
            }
   }
?>
<!--Credit for canvas!  https://codepen.io/juliangarnier/pen/gmOwJX
Library used: https://github.com/juliangarnier/anime -->
<canvas class="fireworks"></canvas>

<script src="../js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script>
<script src="../js/loginT.js"></script>

</body>
</html>
