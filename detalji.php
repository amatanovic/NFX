<?php 
session_start();
include 'konfiguracija.php'; 
if(isset($_POST['komentiraj'])){
$projekt = $_POST['sifra'];
$komentar = $_POST['komentar'];
$izraz = $veza->prepare("insert into komentari (vrijeme, korisnik, komentar, projekt) values (now(), :korisnik, '$komentar', $projekt)");
$izraz->bindValue(':korisnik', $_POST['korisnik']);
$izraz->execute();
header("location: detalji.php?sifra=" . $projekt);
}
?>
<?php
include 'head.php';
?>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="slike/avatar.jpg" alt="Chania">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>





<div class="container" id="detalji">
<?php
$izraz=$veza->prepare("select * from projekt where sifra=:sifra");
$izraz->bindValue(":sifra",$_GET['sifra']);
$izraz->execute();
$projekt=$izraz->fetchALL(PDO::FETCH_OBJ);
foreach ($projekt as $p) {
  echo "<p>" . $p->naziv . "</p>
  <p>" . $p->kratakopis . "</p>
  <p>" . $p->detaljanopis . "</p>
  <p>" . $p->tag ."</p>";
  $izraz=$veza->prepare("select * from kategorija");
  $izraz->execute();
  $kategorije=$izraz->fetchALL(PDO::FETCH_OBJ);
  foreach($kategorije as $kategorija) {
    if ($p->kategorija == $kategorija->sifra) {
        echo "<p>" . $kategorija->naziv . "</p>";
    }
  }
  $izraz=$veza->prepare("select * from slike where avatar != 1");
  $izraz->execute();
  $slike=$izraz->fetchALL(PDO::FETCH_OBJ);
  foreach($slike as $slika) {
    if ($p->sifra == $slika->projekt) {
        echo "<p><img src='" . $slika->putanja . "'/></p>";
    }
  }
  $izraz=$veza->prepare("select * from korisnik");
  $izraz->execute();
  $korisnici=$izraz->fetchALL(PDO::FETCH_OBJ);
  foreach($korisnici as $korisnik) {
    if ($p->korisnik == $korisnik->sifra) {
        $paypal_id = $korisnik->email;
        $userId = $korisnik->sifra;
        $sifraProjekta = $p->sifra;
    }
  }
}
?>



</div>
</div>
<div class="container">
<h4>Doniraj</h4>
<?php
$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr';
?>
    <div class="btn">
    <form action="<?php echo $paypal_url; ?>" method="post" name="frmPayPal1" id="paypalForma">
    <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" value="Local Boost">
    <input type="hidden" name="item_number" value="1">
    <input type="hidden" name="credits" value="510">
    <input type="text" name="amount" placeholder="Unesite iznos željene uplate" onfocusout="plati()" id="amount">
    <input type="hidden" name="userid" value="<?php echo $userId;?>">
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <div id="returnDiv">
    <input type="hidden" name="return" value="http://localhost/nfx/success.php?sifra=<?php echo $sifraProjekta;?>&amount=" id="return">
    </div>
    <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form> 
    </div>
</div>
</div>
<?php
if(isset($_SESSION['autoriziran'])){
$korisnik = $_SESSION['autoriziran']->sifra; ?>
<div class="container">
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <input type="hidden" name="sifra" value="<?php echo $_GET['sifra']?>" id="sifra"> <br />
      <input type="hidden" name="korisnik" value="<?php echo $korisnik?>" id="korisnik"> <br />
      <label for="komentar">Komentar</label> <input type="komentar" id="komentar" name="komentar" /> <br />
      <input type="submit" value="Komentiraj" name="komentiraj" />
    </fieldset>
  </form>
</div> 
<div class="container" id="komentari">
<?php 
$izraz=$veza->prepare("select a.ime, a.prezime, b.* from korisnik a inner join komentari b on a.sifra=b.korisnik where projekt=:sifra group by vrijeme DESC;");
$izraz->bindValue(":sifra",$_GET['sifra']);
  $izraz->execute();
  $komentari=$izraz->fetchALL(PDO::FETCH_OBJ);
  if($komentari!=null){
  foreach($komentari as $komentar) {
        echo "<p>" . $komentar->vrijeme . " Korisnik " . $komentar->ime ." " . $komentar->prezime . "</p>
        <p>" . $komentar->komentar . "</p>";
  }
}
?>
</div>
<?php
}
?> 

<?php include_once 'podnozje.php'; ?> 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
    function plati() {
      var value = $("#return").val().concat($("#amount").val());
      $("#returnDiv").html("");
      $("#returnDiv").append("<input type='hidden' name='return' value='" + value + "' id='return'>");
    }
    
    </script> 
  </body>
</html>