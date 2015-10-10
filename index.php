<?php 
include 'konfiguracija.php';
session_start(); 
include 'head.php';
 ?>
<div id="home">  
<img class="naslovna-slika" src="slike/field-918534_1920.jpg" alt="naslovna stranica jabuka" />
</div>




    <div class="container">
      <div class="naslovi" id="onama">
<h1>O nama</h1>
          <br />

          
      </div>
      </div>
      


    <div class="naslovi" id="opg">
      <div class="container">
<h1 class="opg-naslov">OPG-ovi</h1>
  
   <?php
$izraz=$veza->prepare("select * from opg");
$izraz->execute();

$opgi=$izraz->fetchAll(PDO::FETCH_OBJ);
foreach ($opgi as $opg) {
 echo " <div class='col-lg-4 col-md-6 col-xs-12 col-centered'><p>" . $opg->naziv . "</p><p>" . $opg->kratakopis ."</p><img src='" . $opg->avatar . "' alt='avatar'  class='opgavatar img-circle'></div>";

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
      <label for="ime">Ime</label> <input type="text" id="ime" /> <br />
      <label for="prezime">Prezime</label> <input type="text" id="prezime" /> <br />
      <label for="email">Email</label> <input type="email" id="emailReg" /> <br />
      <label for="ulica">Ulica</label> <input type="text" id="ulica" /> <br />
      <label for="mjesto">Mjesto</label> <input type="text" id="mjesto" /> <br />
      <label for="kontakt">Kontakt</label> <input type="tel" id="kontakt" /> <br />
      <label for="lozinka">Lozinka</label> <input type="password" id="password" /> <br />
      <label for="lozinka2">Ponovite lozinku</label> <input type="password" id="password2" /> <br />
      <a id="registriraj" href="#" type="submit" class="btn btn-primary">Registracija</a>
    </fieldset>
  </form>
  <p id="registracijaPoruka"></p>
<?php } ?> 
  
 

  </div>    
      

<?php include 'prijava-modal.php'; ?>
  
      

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
    $('#autorizacija').modal('hide');

    $('#autorizacijaModal').click(function () {
        $('#autorizacija').modal('show');
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