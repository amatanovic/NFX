<?php 
include 'konfiguracija.php';
session_start(); 
include 'head.php';
 ?>
<div id="home">  
<img class="naslovna-slika" src="slike/field-918534_1920.jpg" alt="naslovna stranica jabuka" />
</div>




    
      <div class="naslovi" id="onama">
<h1>O nama</h1>
          <br />
  
<p class="onama">Eko Riznica je platforma koja na jednom mjestu okuplja sve OPG-ove na području Osječko-baranjske županije. </p>
  <p class="onama">Svaki neregistrirani posjetitelj ima mogućnost pregleda OPG-ova, kao i proizvoda koje ti OPG-ovi nude.</p>
  <p class="onama">Nakon registracije, krajnji korisnik ima mogućnost dodavanja vlastitog OPG-a.</p> 
    <p class="onama">Također, omogućeno je komentiranje svih OPG-ova i njihovih proizvoda. </p>
  <p class="onama">Svaki korisnik ima mogućnost online narudžbe, ako OPG od kojeg želi naručiti ima PayPal račun.</p> 
   <p class="onama"> Ako nema tu mogućnost, tada postoje kontakt podaci OPG-a. </p>
  <p class="onama">Instalacijom mobilne aplikacije, korisniku je omogućeno praćenje OPG-ova, čime se ostvaruje određeni popust (5%) prilikom kupnje.</p>
  <p class="onama">Putem mobilne aplikacije korsnik ima mogućnost primanja obavijesti od OPG-a kojeg prati o određenim akcijama ili novostima.</p>
  <p class="onama">Cilj nam je spojiti OPG-ove s korisnicima te potaknuti zdrav način prehrane kod ljudi, odnosno doprinjeti njihovom zdravom životu.</p>
          
      
      </div>
      


    <div class="naslovi" id="opg">
      <div class="container">
<h1 class="opg-naslov">OPG-ovi</h1>

   <?php
$izraz=$veza->prepare("select * from opg");
$izraz->execute();


$opgi=$izraz->fetchAll(PDO::FETCH_OBJ);
foreach ($opgi as $opg) {
 echo " <div class='col-lg-4 col-md-4 col-sm-6 col-xs-12 col-centered'><p class='naziv-opg'>" . $opg->naziv . "</p><a href='detalji.php?sifra=" . $opg->sifra . "'><img src='" . $opg->avatar . "' alt='avatar'  class='opgavatar img-circle'></a><p class='kratakopis-opg'>" . $opg->kratakopis ."</p></div>";

}
?>     
      
          
         
          </div> 
      </div>


<div class="naslovi" id="registracija-odabir">
      

   <?php
  if(!isset($_SESSION['autoriziran'])){ 
    ?>
  <form action="#">   

  <form action="#" id="registracija">
      
<h1 class="opg-naslov registracija-naslov">Registracija</h1>      
      
    <fieldset class="forma-registracija">
      <input type="text" id="ime" placeholder="ime" /> <br />
      <input type="text" id="prezime"  placeholder="prezime" /> <br />
      <input type="email" id="emailReg"  placeholder="e-mail" /> <br />
      <input type="password" id="password" placeholder="lozinka" /> <br />
      <input type="password" id="password2" placeholder="ponovno lozinka" /> <br />
      <input type="text" id="ulica"  placeholder="ulica i broj"/> <br />
      <input type="text" id="mjesto" placeholder="mjesto stanovanja" /> <br />
      <input type="tel" id="kontakt" placeholder="kontakt broj" /> <br />
      <a id="registriraj" href="#" type="submit" class="btn btn-primary">Registracija</a>
    </fieldset>
  </form>
  <p id="registracijaPoruka"></p>
<?php } ?> 
  
 

  </div>    
      

<?php include 'prijava-modal.php'; ?>
<?php include 'search-modal.php'; ?>

      

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
    $('#autorizacija').modal('hide');

    $('#autorizacijaModal').click(function () {
        $('#autorizacija').modal('show');
    });

     $('#trazenje').modal('hide');

    $('#trazenjeNav').click(function () {
        $('#trazenje').modal('show');
    });
      $(function(){
      $("#registriraj").click(function(){
      $("#registracijaPoruka").html("");
      if ($("#password").val() !== $("#password2").val()) {
        $("#registracijaPoruka").html("Unesene lozinke nisu identične!");
      }
      else 
     $.ajax({
        type: "POST",
        url: "registracija.php",
        data: "email=" + $("#emailReg").val() + "&password=" + $("#password").val() + "&ime=" + $("#ime").val() + "&prezime=" + $("#prezime").val() + "&ulica=" + $("#ulica").val() + "&mjesto=" + $("#mjesto").val() + "&kontakt=" + $("#kontakt").val(),
        success: function(msg){
          if(msg=="true") {
              $("#registracijaPoruka").html("Uspješno ste se registrirali!");
              }
        }
      });
        

        return false;
      });
        });

       $(function(){
      $("#prijavi").click(function(){
      $("#prijaviPoruka").html("");
     $.ajax({
        type: "POST",
        url: "prijava.php",
        data: "email=" + $("#emailPrijava").val() + "&password=" + $("#passwordPrijava").val(),
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