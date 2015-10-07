<?php include 'konfiguracija.php'; 
session_start();    
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

      <nav>
        <ul class="nav">
            <li>HOME</li>
            <li>O NAMA</li>
            <li>PROJEKTI</li>
         </ul>
        <ul class="nav">
        <?php
    if(isset($_SESSION['autoriziran'])){
      ?>
    <a href="logout.php"><li>LOGOUT</li></a>
   <?php } else {?>
            <li>LOGIN</li>
            <li>REGISTRACIJA</li>
            <?php }?>
            <li class="glyphicon glyphicon-search"></li>
         </ul>
      </nav>
      
      
      
      
      
      <img src="slike/gornjajezera.jpg" alt="početna slika" class="pocetnaslika">
      
    <?php
    if(!isset($_SESSION['autoriziran'])){ ?>
    <form action="#" id="login">
    <fieldset>
      <label for="email">Email</label> <input type="email" id="email" /> 
      <label for="lozinka">Lozinka</label> <input type="password" id="lozinka" /> 
      <a id="prijava" href="#" class="button" style="width: 100%" type="submit">Prijava</a>
    </fieldset>
  </form>
  <p id="poruka"></p>
  <?php } ?>
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
    $("#lozinka").keypress(function(e) {
    if(e.which == 13) {
      $("#poruka").html("");
      $.ajax({
        type: "POST",
        url: "login.php",
        data: "email=" + $("#email").val() + "&lozinka=" + $("#lozinka").val(),
        success: function(msg){
            if(msg=="true"){
              window.location="index.php";
            }
            else{
              $("#poruka").html("Neispravno uneseno korisničko ime i lozinka.<br /> Molimo unesite ponovno.");
            }

          
        }
      });
    }
});
    $(function(){
    $("#prijava").click(function(){
      $("#poruka").html("");
      $.ajax({
        type: "POST",
        url: "login.php",
        data: "email=" + $("#email").val() + "&lozinka=" + $("#lozinka").val(),
        success: function(msg){
            if(msg=="true"){
              window.location="index.php";
            }
            else{
              $("#poruka").html("Neispravno uneseno korisničko ime i lozinka.<br /> Molimo unesite ponovno.");
            }
        }
      });
        

        return false;
      });
        });
  </script> 
  </body>
</html>