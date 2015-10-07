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

    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">HOME</a></li>
            <li><a href="#onama">O NAMA</a></li>
            <li><a href="#projekti">PROJEKTI</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
                     <?php
    if(isset($_SESSION['autoriziran'])){
      ?>
    <a href="logout.php"><li>LOGOUT</li></a>
   <?php } else {?>
            <li><a href="../navbar/">LOGIN</a></li>
            <li><a href="../navbar-static-top/">REGISTRACIJA</a></li>
              <?php }?>
            <li class="glyphicon glyphicon-search"></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
      

      
      
      <img src="slike/gornjajezera.jpg" alt="početna slika" class="pocetnaslika">


      <div class="naslov">
<h1>O nama</h1>
<p class="tekst">Local Boost je stranica na kojoj možete financijski poduprijeti tuđe projekte, kao i drugi Vaše.</p>
<p class="tekst">Kako biste postavili vlastiti projekt, potrebno je obaviti registraciju.</p>
<p class="tekst">Nakon izrade korisničkog računa, možete se prijavljivati sa emailom i odabranom lozinkom.</p>
<p class="tekst">Svaki prijavljeni korisnik ima mogućnost financiranja tuđih projekata jednostavnim klikom na uplatu.</p>
<p class="tekst">Svaki prijavljeni korisnik ima mogućnost objaviti vlastiti projekt koji omogućuje drugima da ga financiraju.</p>
<p class="tekst">Local Boost Vam pomaže u realizaciji raznovrsnih projekata i potiče Vaše ideje i napredak.</p>
      </div>
      
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