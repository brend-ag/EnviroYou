<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel ="stylesheet" href='https://fonts.googleapis.com/css?family=Didact Gothic'>
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/orgs.css">
  <style>

  </style>
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

<h2>EnviroYou Organizations</h2>

<br>
<table id="table" width="100%"></table>

<script src="../js/main.js"></script>
<script>
  const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
      const myObj = JSON.parse(this.responseText);
      const myObjLength = myObj.orgsL.length;
      makeTable(myObj, myObjLength);

  }
  xmlhttp.open("GET", "orgs.json");
  xmlhttp.send();


function makeTable(textObj, textObjLength){
  let orgText = "";
  orgText += "<tr>\n<th> Organization </th>\n <th> Location </th>\n <th> Summary </th> \n</tr>";

  for (let i = 0; i < textObjLength; i++){
   orgText += "<tr> <td width='30%'>\n" + textObj.orgsL[i].orgName + "</td> \n<td width='20%'>" + textObj.orgsL[i].orgLocation + "</td> \n<td>" + textObj.orgsL[i].orgSummary + "</td> \n</tr>\n";
  }

  document.getElementById("table").innerHTML = orgText;
}

</script>

<!--Credits for the organizations, names, locations, and summaries:
https://www.wearenewyorkvalues.org/hunger-food-justice
https://www.eater.com/2020/6/3/21279147/black-food-justice-food-sovereignty-groups-where-to-donate
http://seedstock.com/2017/11/28/16-socal-food-system-focused-organizations-that-need-your-support/
https://www.onepercentfortheplanet.org/stories/nonprofits-fighting-for-social-environmental-justice
https://foodforward.org/who-we-are/
https://www.communityhealinggardens.org/
https://plantingjustice.org/about/
https://kisstheground.com/about-us/
https://www.growfoodnorthampton.org/about/
https://www.earthaction.org/
https://www.gardeningthecommunity.org/mission.html
https://nuestras-raices.org/about/
https://www.justfood.org/
https://www.harlemgrown.org/about
https://www.teensforfoodjustice.org/about/
-->

</body>
</html>
