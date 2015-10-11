<h2 style="text-align:center;font-size:3em;">Uredi profil</h2>

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
<img class="pattern-lijevi uredi-pattern hidden-xs hidden-sm" src="slike/pattern2.png" alt="pattern" />      
<img class="pattern-desni uredi-pattern hidden-xs hidden-sm" src="slike/pattern2.png" alt="pattern" />   
<div class="container">
 <?php 
    $korisnik = $_SESSION['autoriziran']->sifra;
    $izraz = $veza->prepare("select * from opg where korisnik=$korisnik");
    $izraz->execute();
    $entitet=$izraz->fetch(PDO::FETCH_OBJ);
    if ($entitet!=null) {
    ?>
     <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
      <fieldset class="forma-uredi">
        <form action="#" id="promjena">
        <input type="hidden" name="sifra" value="<?php echo $korisnik; ?>"> <br />
        <input type="text" id="naziv" name="naziv" value="<?php echo $entitet->naziv;?>" placeholder="naziv OPG-a" /><br />
        <input type="text" id="paypal" name="paypal" value="<?php echo $entitet->paypal;?>" placeholder="PayPal e-mail" /><br />
            <textarea type="text" id="kratakopis" name="kratakopis" placeholder="kratak opis" rows="5" cols="45" style="font-size:0.8em;"><?php echo $entitet->kratakopis;?></textarea><br />
        <label for="paypal">Avatar</label><br />
        <?php if ($entitet->avatar!=null)  {?>
        <img src="<?php echo $entitet->avatar ?>" style="width:25%;margin-bottom:1em;">
        <?php } else { ?>
        <p>Unesite avatar Vašeg OPG-a</p>
        <?php }?>
        <input class="odaberi-avatar" class="" type="file" name="avatar" id="avatar" accept="image/*"  style="width: 72%;
    margin-left: 16%;" />
        <p>
        <a style="width:5em;margin-bottom:0;padding:6px 12px" href="index.php" class="alert button btn btn-secondary">Natrag</a>
        <input style="width:5em;" type="submit" class="button btn btn-primary" value="Promjeni" name="promjeni" /><br />
        <a style="width:7em;margin-bottom:0;padding:6px 12px;font-size:0.8em;margin-top:1em;" href="proizvodi.php?sifra=<?php echo $entitet->sifra; ?>" class="alert button btn btn-secondary">Proizvodi</a>

        </p>
        </div>
      </fieldset>
    </form>




     <?php } else {?>
     <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
      <fieldset class="forma-uredi">
        <form action="#">
        <input type="hidden" name="sifra" value="<?php echo $korisnik; ?>"> <br />

        <input type="text" id="naziv" name="naziv" placeholder="naziv OPG-a" /><br />

        <input type="text" id="paypal" name="paypal" placeholder="PayPal e-mail" /><br />

            <textarea type="text" id="kratakopis" name="kratakopis" placeholder="kratak opis"></textarea><br />

        <input class="odaberi-avatar" type="file" name="avatar" accept="image/*" />
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

<?php include 'footer.php'; include 'prijava-modal.php'; 
include 'search-modal.php';
?>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
   
  </script> 
  </body>
</html>