<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel ="stylesheet" href='https://fonts.googleapis.com/css?family=Didact Gothic'>
  <link rel="stylesheet" href="../css/survey.css">
  <link rel="stylesheet" href="../css/main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
   <!--CREDIT for Quiz format: https://www.sitepoint.com/simple-javascript-quiz/-->
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
  <h1>EnviroYou Quiz</h1>
  <div class="quiz-container">
    <div id="quiz"></div>
  </div>
  <br>
  <button id="previous">Previous Question</button>
  <button id="next">Next Question</button>
  <button id="submit">Submit Quiz</button>
  <div id="results"></div>
  <div id="chosenOrg"></div>

  <br>
  
  <script src="../js/survey.js"></script>
  <script src="../js/main.js"></script>

  <script>
   //Accessing the JSON file with the organizations' information through JQuery
    $(document).ready(function() {
    $("#submit").click(function(event) {
        $.getJSON('orgs.json', function(org) { //JSON orgs are written in this order for each city: 1) food, 2) education 3) community 4) farming
              $.each(org, function(i, field){

                  //lA locations
                  if ((resultOrg == 1) && (cityOrg == 3)){ //food and LA
                    $('#chosenOrg').html('<p> Organization Name: ' + field[0].orgName + '</p>');
                    $('#chosenOrg').append('<p>Organization Location: ' + field[0].orgLocation + '</p>');
                    $('#chosenOrg').append('<p>Organization Summary: ' + field[0].orgSummary + '</p>');
                  }
                  if ((resultOrg == 2) && (cityOrg == 3)){ //education and LA
                    $('#chosenOrg').html('<p> Organization Name: ' + field[1].orgName + '</p>');
                    $('#chosenOrg').append('<p>Organization Location: ' + field[1].orgLocation + '</p>');
                    $('#chosenOrg').append('<p>Organization Summary: ' + field[1].orgSummary + '</p>');
                  }
                  if ((resultOrg == 3) && (cityOrg == 3)){ //community and LA
                    $('#chosenOrg').html('<p> Organization Name: ' + field[2].orgName + '</p>');
                    $('#chosenOrg').append('<p>Organization Location: ' + field[2].orgLocation + '</p>');
                    $('#chosenOrg').append('<p>Organization Summary: ' + field[2].orgSummary + '</p>');
                  }
                  if ((resultOrg == 4) && (cityOrg == 3)){ //farming and LA
                    $('#chosenOrg').html('<p> Organization Name: ' + field[3].orgName + '</p>');
                    $('#chosenOrg').append('<p>Organization Location: ' + field[3].orgLocation + '</p>');
                    $('#chosenOrg').append('<p>Organization Summary: ' + field[3].orgSummary + '</p>');
                  }

                  //Northampton Locations
                  if ((resultOrg == 1) && (cityOrg == 2)){ //food and Noho
                    $('#chosenOrg').html('<p> Organization Name: ' + field[4].orgName + '</p>');
                    $('#chosenOrg').append('<p>Organization Location: ' + field[4].orgLocation + '</p>');
                    $('#chosenOrg').append('<p>Organization Summary: ' + field[4].orgSummary + '</p>');
                  }
                  if ((resultOrg == 2) && (cityOrg == 2)){ //education and Noho
                    $('#chosenOrg').html('<p> Organization Name: ' + field[5].orgName + '</p>');
                    $('#chosenOrg').append('<p>Organization Location: ' + field[5].orgLocation + '</p>');
                    $('#chosenOrg').append('<p>Organization Summary: ' + field[5].orgSummary + '</p>');
                  }
                  if ((resultOrg == 3) && (cityOrg == 2)){ //community and Noho
                    $('#chosenOrg').html('<p> Organization Name: ' + field[6].orgName + '</p>');
                    $('#chosenOrg').append('<p>Organization Location: ' + field[6].orgLocation + '</p>');
                    $('#chosenOrg').append('<p>Organization Summary: ' + field[6].orgSummary + '</p>');
                  }
                  if ((resultOrg == 4) && (cityOrg == 2)){ //farming and Noho
                    $('#chosenOrg').html('<p> Organization Name: ' + field[7].orgName + '</p>');
                    $('#chosenOrg').append('<p>Organization Location: ' + field[7].orgLocation + '</p>');
                    $('#chosenOrg').append('<p>Organization Summary: ' + field[7].orgSummary + '</p>');
                  }

                  //NY locations
                  if ((resultOrg == 1) && (cityOrg == 1)){ //food and NY
                    $('#chosenOrg').html('<p> Organization Name: ' + field[8].orgName + '</p>');
                    $('#chosenOrg').append('<p>Organization Location: ' + field[8].orgLocation + '</p>');
                    $('#chosenOrg').append('<p>Organization Summary: ' + field[8].orgSummary + '</p>');
                  }
                  if ((resultOrg == 2) && (cityOrg == 1)){ //education and NY
                    $('#chosenOrg').html('<p> Organization Name: ' + field[9].orgName + '</p>');
                    $('#chosenOrg').append('<p>Organization Location: ' + field[9].orgLocation + '</p>');
                    $('#chosenOrg').append('<p>Organization Summary: ' + field[9].orgSummary + '</p>');
                  }
                  if ((resultOrg == 3) && (cityOrg == 1)){ //community and NY
                    $('#chosenOrg').html('<p> Organization Name: ' + field[10].orgName + '</p>');
                    $('#chosenOrg').append('<p>Organization Location: ' + field[10].orgLocation + '</p>');
                    $('#chosenOrg').append('<p>Organization Summary: ' + field[10].orgSummary + '</p>');
                  }
                  if ((resultOrg == 4) && (cityOrg == 1)){ //farming and NY
                    $('#chosenOrg').html('<p> Organization Name: ' + field[11].orgName + '</p>');
                    $('#chosenOrg').append('<p>Organization Location: ' + field[11].orgLocation + '</p>');
                    $('#chosenOrg').append('<p>Organization Summary: ' + field[11].orgSummary + '</p>');
                  }
            });
      });
    });
});

  </script>
</body>
</html>
