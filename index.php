<?php include 'konfiguracija.php'; 
session_start();  
include 'head.php';  
?>
<div id="home">  
      
      <img src="slike/naslovnica.png" alt="početna slika" class="pocetnaslika">

    </div>

      <div class="naslovi" id="onama">
<h1>O nama</h1>
          <br />
<p class="tekst">Local Boost je stranica na kojoj možete financijski poduprijeti tuđe projekte, kao i drugi Vaše.</p>
<p class="tekst">Kako biste postavili vlastiti projekt, potrebno je obaviti registraciju.</p>
<p class="tekst">Nakon izrade korisničkog računa, možete se prijavljivati sa emailom i odabranom lozinkom.</p>
<p class="tekst">Svaki prijavljeni korisnik ima mogućnost financiranja tuđih projekata jednostavnim klikom na uplatu.</p>
<p class="tekst">Svaki prijavljeni korisnik ima mogućnost objaviti vlastiti projekt koji omogućuje drugima da ga financiraju.</p>
<p class="tekst">Local Boost Vam pomaže u realizaciji raznovrsnih projekata i potiče Vaše ideje i napredak.</p>
          
      </div>
      
  
        
<div class="container" id="projekti">
    <h1 class="naslovi">Projekti</h1>
    
    <div class="row">


<?php
$izraz=$veza->prepare("select * from projekt");
$izraz->execute();
$projekti=$izraz->fetchAll(PDO::FETCH_OBJ);
foreach ($projekti as $projekt) {
  $izraz=$veza->prepare("select * from slike");
  $izraz->execute();
  $slike=$izraz->fetchAll(PDO::FETCH_OBJ);
  foreach ($slike as $slika) {
    if ($projekt->sifra == $slika->projekt) {
        if ($slika->avatar == 1) {
          if (isset($_SESSION['autoriziran'])) {
      echo "<div class='col-lg-4 col-md-6 col-xs-12 col-centered'><a href='detalji.php?sifra=" . $projekt->sifra . "'><img src='" . $slika->putanja . "' style='width:100%;height:350px;padding-bottom:15px' class='avatar-projekt' /></a><p class='naziv-projekt'>" . $projekt->naziv . "</p><p class='opis-projekt'>" . $projekt->kratakopis . "</p></div>";
      }
      else {
          echo "<div class='col-lg-4 col-md-6 col-xs-12 col-centered'><img src='" . $slika->putanja . "' style='width:100%;height:350px;padding-bottom:15px' class='avatar-projekt' /><p class='naziv-projekt'>" . $projekt->naziv . "</p><p class='opis-projekt'>" . $projekt->kratakopis . "</p></div>";
      }
      }
    }
  }
}
?>
</div>

        
</div>
   
<div class="containter">
    <div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12">
  <div id="registracija">
<br />
      
      
   <?php
    if(!isset($_SESSION['autoriziran'])){ ?>
      <h1 style="text-align:center" class="bijelo">Registracija</h1>
    <form action="#" id="registracija">
    <fieldset>
      <label for="email" class="bijelo">Email</label> <input type="email" id="emailReg" /> <br />
      <label for="ime" class="bijelo">Ime</label> <input type="text" id="ime" /> <br />
      <label for="prezime" class="bijelo">Prezime</label> <input type="text" id="prezime" /> <br />
      <label for="lozinkaReg" class="bijelo">Lozinka</label> <input type="password" id="lozinkaReg" /> <br />
      <label for="lozinkaReg2" class="bijelo">Ponovite lozinku</label> <input type="password" id="lozinkaReg2" />  <br />
      <label for="ziroracun" class="bijelo">Žiro račun</label> <input type="text" id="ziroracun" /> <br />
      <a style="width:107px;text-align:center;right:0;" id="registriraj" href="#" class="btn btn-prvi center-block" style="width: 100%" type="submit">Registracija</a>
    </fieldset>
  </form>
  <p id="registracijaPoruka"></p>
  <?php } ?>
</div>
        </div>
        </div>
    </div>



<?php include_once 'podnozje.php'; ?>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
    $('#autorizacija').modal('hide');

    $('#autorizacijaModal').click(function () {
        $('#autorizacija').modal('show');
    });

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