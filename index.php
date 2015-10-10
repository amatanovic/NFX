<?php include 'head.php';  ?>
<<<<<<< HEAD
 


<div id="home">  
<img class="naslovna-slika" src="slike/jabuke.jpg" alt="naslovna stranica jabuka   " />
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
      
      
=======
      
  <form action="#" id="registracija">
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
>>>>>>> origin/master
      
      
      
      
      

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
          console.log(msg);
          if(msg=="true") {
              $("#registracijaPoruka").html("Uspješno ste se registrirali!");
              }
        }
      });
        

        return false;
      });
        });
    </script>
  </body>
</html>