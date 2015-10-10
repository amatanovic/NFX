<?php 
include 'konfiguracija.php';
session_start(); 
include 'head.php';
 ?>
<div id="home">  
<img class="naslovna-slika" src="slike/field-918534_1920.jpg" alt="naslovna stranica jabuka   " />
</div>




    <div class="container">
      <div class="naslovi" id="onama">
<h1>O nama</h1>
          <br />

          
      </div>
      </div>
      



      <div class="container">
      <div class="naslovi" id="opg">
<h1>OPG-ovi</h1>
   <div class="col-lg-4 col-md-6 col-xs-12 col-centered">      
          <img src="slike/jabuke.jpg" alt="avatar" class="opgavatar">
      </div>
          
          
          
      </div>


<div class="naslovi">
      

   <?php
  if(!isset($_SESSION['autoriziran'])){ 
    ?>
  <form action="#">   

  <form action="#" id="registracija">
      
<h1>Registracija</h1>      
      
    <fieldset>
      <label for="ime">Ime</label> <input type="text" id="ime" /> <br />
      <label for="prezime">Prezime</label> <input type="text" id="prezime" /> <br />
      <label for="email">Email</label> <input type="email" id="emailReg" /> <br />
      <label for="ulica">Ulica</label> <input type="text" id="ulica" /> <br />
      <label for="mjesto">Mjesto</label> <input type="text" id="mjesto" /> <br />
      <label for="kontakt">Kontakt</label> <input type="tel" id="kontakt" /> <br />
      <label for="lozinka">Lozinka</label> <input type="password" id="password" /> <br />
      <label for="lozinka2">Ponovite lozinku</label> <input type="password" id="password2" /> <br />
      <a id="registriraj" href="#" style="width: 100%" type="submit">Registracija</a>
    </fieldset>
  </form>
  <p id="registracijaPoruka"></p>
<?php } ?> 
  
   <?php if(!isset($_SESSION['autoriziran'])){ ?>  
  <form action="#">
    <fieldset>
      <label for="email">Email</label> <input type="email" id="emailPrijava" /> <br />
      <label for="lozinka">Lozinka</label> <input type="password" id="passwordPrijava" /> <br />
      <a id="prijavi" href="#" style="width: 100%" type="submit">Prijava</a>
    </fieldset>
  </form>
  <p id="prijaviPoruka"></p>  
  <?php } ?>    

  <p id="registracijaPoruka"></p>  

  </div>    
      

      
      

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
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
    </script>
  </body>
</html>