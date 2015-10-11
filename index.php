<?php 
include 'konfiguracija.php';
session_start(); 
include 'head.php';
 ?>
<div id="home">  
<img style="opacity:0.7;" class="naslovna-slika" src="slike/field-918534_1920.jpg" alt="naslovna stranica jabuka" />
<img class="naslovni-logo" src="slike/logo1.png" alt="naslovna stranica jabuka" />
</div>




    
      <div class="naslovi" id="onama">
<h1>O nama</h1>
          <br />
  
<p class="onama">Bio Lege je platforma koja na jednom mjestu okuplja sve OPG-ove na području Osječko-baranjske županije. </p>
  <p class="onama">Svaki neregistrirani posjetitelj ima mogućnost pregleda OPG-ova, kao i proizvoda koje ti OPG-ovi nude.</p>
  <p class="onama">Nakon registracije, krajnji korisnik ima mogućnost dodavanja vlastitog OPG-a.</p> 
    <p class="onama">Također, omogućeno je komentiranje svih OPG-ova i njihovih proizvoda. </p>
  <p class="onama">Svaki korisnik ima mogućnost online narudžbe, ako OPG od kojeg želi naručiti ima PayPal račun.</p> 
   <p class="onama"> Ako nema tu mogućnost, tada postoje kontakt podaci OPG-a. </p>
  <p class="onama">Instalacijom mobilne aplikacije, korisniku je omogućeno praćenje OPG-ova, čime se ostvaruje određeni popust (5%) prilikom kupnje.</p>
  <p class="onama">Putem mobilne aplikacije korsnik ima mogućnost primanja obavijesti od OPG-a kojeg prati o određenim akcijama ili novostima.</p>
  <p class="onama">Cilj nam je spojiti OPG-ove s korisnicima te potaknuti zdrav način prehrane kod ljudi, odnosno doprinjeti njihovom zdravom životu.</p>
          
      
      </div>
      


    <div class="naslovi" id="opg" style="margin-top: -10px;">
      <div class="container">
<h1 class="opg-naslov">OPG-ovi</h1>

   <?php
$izraz=$veza->prepare("select * from opg");
$izraz->execute();


$opgi=$izraz->fetchAll(PDO::FETCH_OBJ);
foreach ($opgi as $opg) {
 echo "<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12 col-centered'><p class='naziv-opg'>" . $opg->naziv . "</p><a href='detalji.php?sifra=" . $opg->sifra . "'><img src='" . $opg->avatar . "' alt='avatar'  class='opgavatar img-circle'></a><p class='kratakopis-opg'>" . $opg->kratakopis ."</p></div>";

}
?>     
      
          
         
          </div> 
      </div>



      

   <?php
  if(!isset($_SESSION['autoriziran'])){ 
    ?>  
  <div class="naslovi" id="registracija-odabir">
  <form action="#">
  
<img class="pattern-lijevi hidden-xs" src="slike/pattern.png" alt="pattern" />      
<img class="pattern-desni hidden-xs" src="slike/pattern.png" alt="pattern" />   
      
<h1 class="opg-naslov registracija-naslov" style="padding-bottom: 0.4em;padding-top:0.4em;">Registracija</h1>      
      
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
    </div>    

<?php } ?> 
  
   

      

<?php include 'footer.php'; include 'prijava-modal.php'; 
include 'search-modal.php';
?>

    
<!--korišteni linkovi fotografije korištene slike:
https://pixabay.com/en/field-grass-crop-sky-nature-rural-918534/
https://pixabay.com/en/apples-jonagold-health-improvement-490474/
https://pixabay.com/en/image-basket-apple-straw-841484/
https://pixabay.com/en/apple-fruit-food-700011/
https://pixabay.com/en/pears-fruit-green-market-fruits-620666/
https://pixabay.com/en/pear-tree-orchard-fruit-branch-419187/
https://pixabay.com/en/pear-hand-fruit-man-nature-autumn-970189/
https://pixabay.com/en/grape-green-fruit-curls-870460/
https://pixabay.com/en/winegrowing-grape-vineyard-vine-972891/
https://pixabay.com/en/grapes-vine-grape-vine-wine-908757/
https://pixabay.com/en/cherry-sweet-cherry-red-fruit-167341/
https://pixabay.com/en/cherries-cherry-branch-fruit-red-826113/
https://pixabay.com/en/cherries-fruit-fruits-red-vitamins-807607/
https://pixabay.com/en/peach-fruit-eating-peach-fruit-853879/
https://pixabay.com/en/peach-ripe-fruit-summer-863349/
https://pixabay.com/en/peaches-peach-fruit-rain-824626/
https://pixabay.com/en/peaches-peach-fruit-rain-824627/
https://pixabay.com/en/apricots-market-food-fruit-fresh-433008/
https://pixabay.com/en/apricots-fruit-fruits-food-orange-168502/
https://pixabay.com/en/watermelon-summer-juicy-fruit-813881/
https://pixabay.com/en/watermelon-green-striped-berry-453214/
https://pixabay.com/en/watermelon-summer-tips-cool-296180/
https://pixabay.com/en/strawberries-berries-fruit-close-823782/
https://pixabay.com/en/berry-strawberry-hands-leaves-red-197078/
https://pixabay.com/en/strawberry-healthy-green-799807/
https://pixabay.com/en/wild-fig-common-fig-ficus-carica-279938/
https://pixabay.com/en/fig-fruit-cut-half-halves-sweet-439753/
https://pixabay.com/en/fig-ouazzane-fruit-230873/
https://pixabay.com/en/plum-fruit-red-plum-mature-summer-886224/
https://pixabay.com/en/plums-plum-tree-fruit-food-blue-693538/
https://pixabay.com/en/paprika-green-red-vegetables-65270/
https://pixabay.com/en/sweet-peppers-paprika-red-healthy-499068/
https://pixabay.com/en/paprika-vegetables-food-market-537632/
https://pixabay.com/en/tomato-red-salad-food-fresh-769999/
https://pixabay.com/en/tomatoes-vegetables-tomato-green-905632/
https://pixabay.com/en/tomato-red-tasty-vitamins-three-927273/
https://pixabay.com/en/potatoes-vegetables-eating-856754/
https://pixabay.com/en/bio-potato-field-earth-eat-nature-172200/
https://pixabay.com/en/potatoes-vegetables-raw-food-411975/
https://pixabay.com/en/onion-vegetables-a-vegetable-858465/
https://pixabay.com/en/vegetable-onion-onion-food-shell-499083/
https://pixabay.com/en/onion-vegetable-onion-brown-531974/
https://pixabay.com/en/carrots-vegetables-vegetable-garden-673201/
https://pixabay.com/en/carrots-basket-vegetables-market-673184/
https://pixabay.com/en/carrots-vegetables-food-orange-382686/
https://pixabay.com/en/farmer-tractor-agriculture-farm-880567/
https://pixabay.com/en/vegetables-peas-harvest-food-green-852990/
https://pixabay.com/en/vegetables-peas-vitamins-market-780528/
https://pixabay.com/en/peas-green-hand-655267/
https://pixabay.com/en/real-spinach-spinach-vegetables-73911/
https://pixabay.com/en/spinach-vegetables-vegetable-506616/
https://pixabay.com/en/spinach-gardening-natural-728237/
https://pixabay.com/en/zucchini-vegetables-food-healthy-537001/
https://pixabay.com/en/vegetables-zucchini-food-fresh-878767/
https://pixabay.com/en/zucchini-blossom-bloom-671468/
https://pixabay.com/en/pumpkin-vegetable-orange-no-yellow-756567/
https://pixabay.com/en/pumpkins-fall-harvest-thanksgiving-861968/
https://pixabay.com/en/pumpkins-fruit-trash-autumn-597293/
https://pixabay.com/en/cauliflower-vegetable-healthy-food-651402/
https://pixabay.com/en/cauliflower-kohl-cabbage-food-68791/
https://pixabay.com/en/broccoli-cauliflower-vegetables-5735/
https://pixabay.com/en/radish-hand-green-kitchen-leafs-761591/
https://pixabay.com/en/vegetables-radish-food-700043/
https://pixabay.com/en/radishes-red-vegetables-food-eat-761280/
https://pixabay.com/en/walking-walkers-man-woman-couple-220454/
https://pixabay.com/en/bauer-mountain-farmer-work-meadow-809091/
https://pixabay.com/en/farmer-grain-food-organic-657333/
https://pixabay.com/en/soil-tilling-farmer-tractor-386749/
https://pixabay.com/en/agriculture-farm-farmer-tractor-354679/
https://pixabay.com/en/agriculture-field-rural-nature-91149/
https://pixabay.com/en/farmer-man-standing-agriculture-330388/
https://pixabay.com/en/farmer-people-work-greenhouse-917998/
https://pixabay.com/en/farm-farmer-spring-garden-579944/
https://pixabay.com/en/honey-honey-jars-forest-honey-318175/
https://pixabay.com/en/honey-honey-jars-ranking-166400/
https://pixabay.com/en/honey-honey-jar-sweet-food-5864/
https://pixabay.com/en/apple-orange-juice-glass-drinks-926456/
https://pixabay.com/en/juice-sap-healthy-slowjuice-orange-642128/
https://pixabay.com/en/health-slimming-diet-cleaning-653512/
https://pixabay.com/en/tomato-isolated-vegetarian-meal-316743/
https://pixabay.com/en/brandy-alcohol-drink-bottles-862848/
https://pixabay.com/en/bar-liquor-barman-pouring-close-up-315676/
https://pixabay.com/en/bottles-beverages-cork-alcohol-590935/
https://pixabay.com/en/wine-production-cantine-winery-664833/
https://pixabay.com/en/wine-production-cantine-winery-664826/
https://pixabay.com/en/wine-production-cantine-winery-664832/
https://pixabay.com/en/peas-legumes-vegetables-diet-food-72339/


 -->


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
      $(function(){
      $("#search").click(function(){
     $.ajax({
        type: "POST",
        url: "pretrazi.php",
        data: "uvjet=" + $("#uvjet").val(),
        success: function(msg){
        $('#opg').html("");
        console.log(msg);
        podaci=$.parseJSON(msg);
        $.each(podaci, function(i, item){
          $("#opg").append($("<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12 col-centered'><p class='naziv-opg'>" + item.nazivopg + "</p><a href='detalji.php?sifra=" + item.opgsifra + "'><img src='" + item.avatar + "' alt='avatar'  class='opgavatar img-circle'></a><p class='kratakopis-opg'>" + item.kratakopis + "</p></div>"));
        });
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
        
        
        
        
    $('#hamburger').click(function () {
        $('nav').toggleClass('nav1');
        });
        
        
     $('#hamburger').click(function () {
        $('.odabrane').toggleClass('off-hide');
        });    
        
        </script>

  </body>
</html>