<?php 
include 'konfiguracija.php';
session_start(); 
include 'head.php';
if(isset($_POST['komentiraj'])){
$opg = $_POST['sifra'];
$korisnik = $_POST['korisnik'];
$komentar = $_POST['komentar'];
$izraz = $veza->prepare("insert into komentar (vrijeme, komentar, opg, korisnik) values (now(), '$komentar', $opg, $korisnik)");
$izraz->execute();
header("location: detalji.php?sifra=" . $opg);
}
 ?>

<div class="detalji-stranica">

<div class="container">
<?php
$izraz=$veza->prepare("select * from opg where sifra=:sifra");
$izraz->bindValue(":sifra",$_GET['sifra']);
$izraz->execute();
$opg=$izraz->fetch(PDO::FETCH_OBJ);
$opgID = $opg->sifra;
?>

    
<div class="container">
<div class="row">
    <div class="col-lg-12">
        <img class="img-circle" src="<?php echo $opg->avatar ?>" style="width:15em;height:15em;margin-top:2em;margin-left:39%" />
    </div>
</div>
</div>
<h1 style="text-align:center"><?php echo $opg->naziv; ?></h1>
<h4 style="text-align:center; width:43%;margin-left: auto;margin-right: auto;"><?php echo $opg->kratakopis; ?></h4>
    <p style="text-align:center;">Trenutno prati korisnika: <span class="glyphicon glyphicon-leaf"></span>
<?php 
  $izraz=$veza->prepare("select count(korisnik) as follow from pracenje where opg=$opgID;");
  $izraz->execute();
  $follow=$izraz->fetch(PDO::FETCH_OBJ);
  echo $follow->follow;
   ?>
 </p>
<p style="text-align:center;">
  <?php 
  $korisnik = $opg->korisnik;
  $izraz=$veza->prepare("select a.ulica, a.mjesto, b.* from korisnik a inner join opg b on a.sifra=b.korisnik where b.korisnik=$korisnik");
  $izraz->execute();
  $adresa=$izraz->fetch(PDO::FETCH_OBJ);
  echo $adresa->ulica . ", " . $adresa->mjesto;
   ?>
</p>

</div>


<?php
$izraz=$veza->prepare("select * from proizvod where opg=$opgID");
$izraz->execute();
$proizvodi=$izraz->fetchALL(PDO::FETCH_OBJ);
foreach ($proizvodi as $proizvod) { ?>
 


<br />
<br />
<br />
<br />
<div class="container">
    <div class="row">
      
        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs"></div>
        
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
<img src="<?php echo $proizvod->slika ?>" style="width:100%" />        
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-6 col-cs-6">
<h4 style="padding-top:1em;">Proizvod: <b><?php echo $proizvod->naziv; ?></b> <br /> <br />
Cijena: 
<b><?php 
if (isset($_SESSION['autoriziran'])) {
$sifraKorisnika = $_SESSION['autoriziran']->sifra;
$izraz=$veza->prepare("select * from pracenje where opg=$opgID and korisnik=$sifraKorisnika");
$izraz->execute();
$pracenje=$izraz->fetch(PDO::FETCH_OBJ);
if ($pracenje != null) {
  $cijena = round($proizvod->cijena - ($proizvod->cijena * 0.05), 2);
  echo $cijena . " (Vaša cijena umanjena je za 5% jer pratite ovaj OPG.)";
 }
 else {
  $cijena = $proizvod->cijena;
  echo $cijena;
 }
 }
 else {
  $cijena = $proizvod->cijena;
  echo $cijena;
 }
 ?>
 </b>
    
<?php 
/*
echo "Kategorija:";
$izraz1=$veza->prepare("select * from kategorija");
$izraz1->execute();
$kategorije=$izraz1->fetchALL(PDO::FETCH_OBJ);
foreach ($kategorije as $kategorija) {
  if ($kategorija->sifra == $proizvod->kategorija) { 
    echo $kategorija->naziv;
 }
}*/
?>
</h4>

<br />
<?php
if ($opg->paypal != null && isset($_SESSION['autoriziran'])) {
$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr';
?>
    <div class="btn">
    <form action="<?php echo $paypal_url; ?>" method="post" name="frmPayPal1" id="paypalForma">
    <input type="hidden" name="business" value="<?php echo $opg->paypal; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" value="<?php echo $opg->naziv; ?>">
    <input type="hidden" name="item_number">
    <input type="hidden" name="credits" value="510">
    <input type="hidden" type="text" name="amount" value="<?php echo $cijena; ?>" id="amount">
    <input type="hidden" name="userid" value="<?php echo $sifraKorisnika;?>">
    <input type="hidden" name="no_shipping" value="1">
     <div id="itemDiv">
    <input type="number" name="quantity" onfocusout="kolicina()" id="itemNumber" placeholder="kg">
         
    </div>
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="return" value="http://localhost/nfx/success.php" id="return">
    <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form> 
    </div>
        
        <?php

}
?>
        
</div>
</div>
</div> 
<br />
<br />
<?php

}
?>


<?php
if(isset($_SESSION['autoriziran'])){
$korisnik = $_SESSION['autoriziran']->sifra; 
?>
<div class="container">
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <input type="hidden" name="sifra" value="<?php echo $_GET['sifra']?>" id="sifra"> <br />
      <input type="hidden" name="korisnik" value="<?php echo $korisnik?>" id="korisnik"> <br />
     <textarea rows="6" cols="50" type="komentar" id="komentar" name="komentar" placeholder="Unesite željeni komentar"></textarea> <br />
      <input type="submit" value="Komentiraj" name="komentiraj" />
    </fieldset>
  </form>
</div> 
<div class="container" id="komentari">
<?php 
$izraz=$veza->prepare("select a.ime, a.prezime, b.* from korisnik a inner join komentar b on a.sifra=b.korisnik where opg=:sifra group by vrijeme DESC;");
  $izraz->bindValue(":sifra",$_GET['sifra']);
  $izraz->execute();
  $komentari=$izraz->fetchALL(PDO::FETCH_OBJ);
  if($komentari!=null){
  foreach($komentari as $komentar) {
        echo "<p style='margin-top:2%;border-top:1px solid #dee1aa;border-left:1px solid #dee1aa;border-right:1px solid #dee1aa;width:35%'>" . $komentar->vrijeme . " Korisnik " . $komentar->ime ." " . $komentar->prezime . "</p>
        <p style='border:1px solid #dee1aa;padding: 2px 3px; background-color:#eceecb;width:50%'>" . $komentar->komentar . "</p>";
  }
}
?>
</div>
<?php
}
?> 

<?php include 'footer.php'; include 'prijava-modal.php'; 
include 'search-modal.php';
?>

</div>  
      

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
    function kolicina() {
      var value = $("#itemNumber").val();
      $("#itemDiv").html("");
      $("#itemDiv").append("<input name='quantity' value='" + value + "' id='itemNumber'>");
    }
      $('#autorizacija').modal('hide');

    $('#autorizacijaModal').click(function () {
        $('#autorizacija').modal('show');
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
              $("#poruka").html("Neispravno uneseno korisniÄŤko ime i lozinka.<br /> Molimo unesite ponovno.");
            }
        }
      });
        

        return false;
      });
        });
    </script>
  </body>
</html>