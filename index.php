<?php include 'konfiguracija.php'; 
session_start();  
include 'head.php';  
?>

<div class="naslovi" id="onama">
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
            <li><a href="#home">HOME</a></li>
            <li><a href="#onama">O NAMA</a></li>
            <li><a href="#projekti">PROJEKTI</a></li>
            <?php if(isset($_SESSION['autoriziran'])){
      ?>
      <li><a href="mojiprojekti.php"><li>MOJI PROJEKTI</li></a>
   <?php } ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
                     <?php
    if(isset($_SESSION['autoriziran'])){
      ?>
   <li><a href="logout.php"><li>ODJAVA</li></a>
   <?php } else {?>
            <li><a href="#prijava" data-toggle="modal">PRIJAVA</a></li>
            <li><a href="#registracija">REGISTRACIJA</a></li>
              <?php }?>
            <li><span class="glyphicon glyphicon-search"></span></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
      

    <div id="home">  
      
      <img src="slike/milino-jezero.jpg" alt="početna slika" class="pocetnaslika">


      <div class="naslovi" id="onama">
>>>>>>> origin/master

<h1>O nama</h1>
<p class="tekst">Local Boost je stranica na kojoj možete financijski poduprijeti tuđe projekte, kao i drugi Vaše.</p>
<p class="tekst">Kako biste postavili vlastiti projekt, potrebno je obaviti registraciju.</p>
<p class="tekst">Nakon izrade korisničkog računa, možete se prijavljivati sa emailom i odabranom lozinkom.</p>
<p class="tekst">Svaki prijavljeni korisnik ima mogućnost financiranja tuđih projekata jednostavnim klikom na uplatu.</p>
<p class="tekst">Svaki prijavljeni korisnik ima mogućnost objaviti vlastiti projekt koji omogućuje drugima da ga financiraju.</p>
<p class="tekst">Local Boost Vam pomaže u realizaciji raznovrsnih projekata i potiče Vaše ideje i napredak.</p>
      </div>
      
  
        
<div class="container" id="projekti">
    <h1 class="naslovi">Projekti</h1>
<?php
$izraz=$veza->prepare("select * from projekt");
$izraz->execute();
$projekti=$izraz->fetchAll(PDO::FETCH_OBJ);
foreach ($projekti as $projekt) {
  echo "<p>" . $projekt->naziv . "</p><p>" . $projekt->kratakopis . "</p>"; 
  $izraz=$veza->prepare("select * from slike");
  $izraz->execute();
  $slike=$izraz->fetchAll(PDO::FETCH_OBJ);
  foreach ($slike as $slika) {
    if ($projekt->sifra == $slika->projekt) {
        if ($slika->avatar == 1) {
      echo "<img src='" . $slika->putanja . "' />";
      }
    }
  }
}
?>
</div>
        
<?php include 'modal-prijava.php'; ?>   
      
  <div id="registracija">
   <?php
    if(!isset($_SESSION['autoriziran'])){ ?>
    <form action="#" id="registracija">
    <fieldset>
      <label for="email">Email</label> <input type="email" id="emailReg" /> <br />
      <label for="ime">Ime</label> <input type="text" id="ime" /> <br />
      <label for="prezime">Prezime</label> <input type="text" id="prezime" /> <br />
      <label for="lozinkaReg">Lozinka</label> <input type="password" id="lozinkaReg" /> <br />
      <label for="lozinkaReg2">Ponovite lozinku</label> <input type="password" id="lozinkaReg2" />  <br />
      <label for="ziroracun">Žiro račun</label> <input type="text" id="ziroracun" /> <br />
      <a id="registriraj" href="#" class="button" style="width: 100%" type="submit">Registracija</a>
    </fieldset>
  </form>
  <p id="registracijaPoruka"></p>
  <?php } ?>
</div>
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

    $(function(){
    $("#registriraj").click(function(){
      $("#registracijaPoruka").html("");
      if ($("#lozinkaReg").val() !== $("#lozinkaReg2").val()) {
        $("#registracijaPoruka").html("Unesene lozinke nisu identične!");
      }
      else 
     $.ajax({
        type: "POST",
        url: "registracija.php",
        data: "emailReg=" + $("#emailReg").val() + "&lozinkaReg=" + $("#lozinkaReg").val() + "&ime=" + $("#ime").val() + "&prezime=" + $("#prezime").val() + "&ziroracun=" + $("#ziroracun").val(),
        success: function(msg){
            if(msg=="true"){
              $("#registracijaPoruka").html("Uspješno ste se registrirali!");
              $("#registriraj").html("");
            }
            else{
              $("#registracijaPoruka").html("Registracija nije uspjela.");
            }
        }
      });
        

        return false;
      });
        });
        $(function () {
        $('a[href*=#]:not([href=#])').click(function () {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                    || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 700);
                    return false;
                }
            }
        });
    }); 
  </script> 
  </body>
</html>