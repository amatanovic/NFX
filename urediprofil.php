<?php
session_start();
if (!isset($_SESSION['autoriziran'])) {
  header('location: odjava.php');
}
else {
include 'konfiguracija.php'; 
include "head.php";
}
?>
<?php
if(isset($_POST['promjeni'])){
  $izraz = $veza->prepare("update opg set naziv=:naziv, paypal=:paypal, kratakopis=:kratakopis where korisnik=:sifra");
  $izraz->bindValue(":sifra",$_POST['sifra']);
  $izraz->bindValue(":naziv",$_POST['naziv']); 
  $izraz->bindValue(":paypal",$_POST['paypal']);
  $izraz->bindValue(":kratakopis",$_POST['kratakopis']);
  $izraz->execute();
  $korisnikID = $_POST['sifra'];
  if ($_FILES['avatar']) {
    $slike_dir = "slike/";
    $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $slika_datoteka = $slike_dir . "avatar_" . $korisnikID . "." . $ext;
    $izraz1 = $veza->prepare("update opg set avatar='$slika_datoteka' where korisnik=$korisnikID");
    $izraz1->execute();
    echo $slika_datoteka;
    move_uploaded_file($_FILES["avatar"]["tmp_name"], $slika_datoteka);
  }
  header("location: urediprofil.php");
}
if(isset($_POST['unosOPG'])){
  $izraz = $veza->prepare("insert into opg(naziv, paypal, kratakopis, korisnik) values (:naziv, :paypal, :kratakopis, :sifra)");
  $izraz->bindValue(":sifra",$_POST['sifra']);
  $izraz->bindValue(":naziv",$_POST['naziv']); 
  $izraz->bindValue(":paypal",$_POST['paypal']);
  $izraz->bindValue(":kratakopis",$_POST['kratakopis']);
  $izraz->execute();
  $korisnikID = $_POST['sifra'];
  if ($_FILES['avatar']) {
    $slike_dir = "slike/";
    $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $slika_datoteka = $slike_dir . "avatar_" . $korisnikID . "." . $ext;
    $izraz1 = $veza->prepare("update opg set avatar='$slika_datoteka' where korisnik=$korisnikID");
    $izraz1->execute();
    echo $slika_datoteka;
    move_uploaded_file($_FILES["avatar"]["tmp_name"], $slika_datoteka);
  }
  header("location: urediprofil.php");
}
?>
<div class="container">
 <?php 
    $korisnik = $_SESSION['autoriziran']->sifra;
    $izraz = $veza->prepare("select * from opg where korisnik=$korisnik");
    $izraz->execute();
    $entitet=$izraz->fetch(PDO::FETCH_OBJ);
    if ($entitet!=null) {
    ?>
     <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
      <fieldset>
        <form action="#" id="promjena">
        <input type="hidden" name="sifra" value="<?php echo $korisnik; ?>"> <br />
        <label for="naziv">Naziv</label><br />
        <input type="text" id="naziv" name="naziv" value="<?php echo $entitet->naziv;?>" /><br />
        <label for="paypal">PayPal račun</label><br />
        <input type="text" id="paypal" name="paypal" value="<?php echo $entitet->paypal;?>" /><br />
        <label for="paypal">Kratak opis</label><br />
        <input type="text" id="kratakopis" name="kratakopis" value="<?php echo $entitet->kratakopis;?>" /><br />
        <label for="paypal">Avatar</label><br />
        <?php if ($entitet->avatar!=null)  {?>
        <img src="<?php echo $entitet->avatar ?>" style="width:25%">
        <?php } else { ?>
        <p>Unesite avatar Vašeg OPG-a</p>
        <?php }?>
        <input type="file" name="avatar" id="avatar" accept="image/*" />
        <p>
        <div style="text-align:right">
        <a style="margin-bottom:0;padding:6px 12px" href="index.php" class="alert button btn btn-default">Natrag</a>
        <input type="submit" class="button btn btn-default" value="Promjeni" name="promjeni" />
        <a style="margin-bottom:0;padding:6px 12px" href="proizvodi?sifra=<?php echo $entitet->sifra; ?>" class="alert button btn btn-default">Unos proizvoda</a>
        </div>
        </p>
        </div>
      </fieldset>
    </form>
     <?php } else {?>
     <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
      <fieldset>
        <form action="#">
        <input type="hidden" name="sifra" value="<?php echo $korisnik; ?>"> <br />
        <label for="naziv">Naziv</label><br />
        <input type="text" id="naziv" name="naziv" /><br />
        <label for="paypal">PayPal račun</label><br />
        <input type="text" id="paypal" name="paypal" /><br />
        <label for="paypal">Kratak opis</label><br />
        <input type="text" id="kratakopis" name="kratakopis" /><br />
        <label for="paypal">Avatar</label><br />
        <input type="file" name="avatar" accept="image/*" />
        <p>
        <div style="text-align:right">
        <a style="margin-bottom:0;padding:6px 12px" href="index.php" class="alert button btn btn-default">Natrag</a>
        <input type="submit" class="button btn btn-default" value="Registrirajte svoj OPG" name="unosOPG" />
        </div>
        </p>
        </div>
      </fieldset>
    </form>
     <?php } ?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
   
  </script> 
  </body>
</html>