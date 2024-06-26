<?php
 session_start();
 unset($_SESSION['username']);
 echo "<a href='../html/main.html.php'>Return to Home</a>";
 ?>
 <!DOCTYPE html>
 <html>
 <head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel ="stylesheet" href='https://fonts.googleapis.com/css?family=Didact Gothic'>
   <link rel="stylesheet" href="../css/main.css">

 </head>
 <body>
   <h4> You have successfully logged out! Thanks for visiting.</h4>
   <i> Scroll down and click the screen to have some firework fun! </i>
 </body>

 <!--Credit for canvas!  https://codepen.io/juliangarnier/pen/gmOwJX
 Library used: https://github.com/juliangarnier/anime -->
 <canvas class="fireworks"></canvas>

 <script src="../js/main.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script>
 <script src="../js/loginT.js"></script>
 </html>
