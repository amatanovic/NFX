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

<div class="container">
<?php
$izraz=$veza->prepare("select * from opg where sifra=:sifra");
$izraz->bindValue(":sifra",$_GET['sifra']);
$izraz->execute();
$opg=$izraz->fetch(PDO::FETCH_OBJ);
?>

<div class="row">
    <div class="col-lg-12">
        <img src="<?php echo $opg->avatar ?>" style="width:15em;height:15em;margin-top:2em;margin-left:41%;border-radius:20px;" />
    </div>
</div>
<h1 style="text-align:center"><?php echo $opg->naziv; ?></h1>
<p><?php echo $opg->kratakopis; ?></p>
</div>

<div class="container">
<?php
$opgID = $opg->sifra;
$izraz=$veza->prepare("select * from proizvod where opg=$opgID");
$izraz->execute();
$proizvodi=$izraz->fetchALL(PDO::FETCH_OBJ);
foreach ($proizvodi as $proizvod) { ?>
<p>Proizvod: <?php echo $proizvod->naziv; ?> <br /> 
Cijena: <?php echo $proizvod->cijena; ?> <br />
Kategorija: 
<?php 
$izraz1=$veza->prepare("select * from kategorija");
$izraz1->execute();
$kategorije=$izraz1->fetchALL(PDO::FETCH_OBJ);
foreach ($kategorije as $kategorija) {
  if ($kategorija->sifra == $proizvod->kategorija) { 
    echo $kategorija->naziv;
 }
}
?>
<br />
<img src="<?php echo $proizvod->slika ?>" style="width:25%" />
</p>
<?php
}
?>

</div>

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

<?php include 'prijava-modal.php'; ?>
  
      

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>

    </script>
  </body>
</html>