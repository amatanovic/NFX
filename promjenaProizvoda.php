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
  $izraz = $veza->prepare("update proizvod set naziv=:naziv, cijena=:cijena, kategorija=:kategorija where sifra=:sifra");
  $izraz->bindValue(":sifra",$_POST['sifra']);
  $izraz->bindValue(":naziv",$_POST['naziv']); 
  $izraz->bindValue(":cijena",$_POST['cijena']);
  $izraz->bindValue(":kategorija",$_POST['kategorija']);
  $izraz->execute();
  $proizvodID = $_POST['sifra'];
  if ($_FILES['slika']) {
    $slike_dir = "slike/";
    $ext = pathinfo($_FILES['slika']['name'], PATHINFO_EXTENSION);
    $slika_datoteka = $slike_dir . "slika_" . $proizvodID . "." . $ext;
    $izraz1 = $veza->prepare("update proizvod set slika='$slika_datoteka' where sifra=$proizvodID");
    $izraz1->execute();
    echo $slika_datoteka;
    move_uploaded_file($_FILES["slika"]["tmp_name"], $slika_datoteka);
  }
  header("location: urediprofil.php");
}
if(isset($_POST['obrisi'])){
  $izraz = $veza->prepare("delete from proizvod where sifra=:sifra");
  $izraz->bindValue(":sifra",$_POST['sifra']);
  $izraz->execute();
  header("location: urediprofil.php");
}
?>
<div class="container">
 <?php 
    $sifra = $_GET['sifra'];
    $izraz = $veza->prepare("select * from proizvod where sifra=$sifra");
    $izraz->execute();
    $entitet=$izraz->fetch(PDO::FETCH_OBJ);
?>
     <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
      <fieldset>
        <form action="#" id="promjenaProizvoda">
        <input type="hidden" name="sifra" value="<?php echo $sifra; ?>"> <br />
        <label for="naziv">Naziv</label><br />
        <input type="text" name="naziv" value="<?php echo $entitet->naziv;?>" /><br />
        <label for="cijena">Cijena</label><br />
        <input type="text" id="cijena" name="cijena" value="<?php echo $entitet->cijena;?>" /><br />
        <label for="kategorija">Kategorija</label><br />
         <select id='kategorija' name='kategorija'><br />
       <?php
          $izraz = $veza->prepare("select * from kategorija");
          $izraz->execute();
          $entitet1=$izraz->fetchALL(PDO::FETCH_OBJ);
          foreach($entitet1 as $en){
          if ($entitet->kategorija == $en->sifra) {
        echo "<option selected=\"selected\" value=\"" . $en->sifra . "\">" . $en->naziv ."</option>";
        }
        else 
        echo "<option value=\"" . $en->sifra . "\">" . $en->naziv ."</option>";
        }
        echo "</select><br />";
        ?>
        <label for="slika">Slika</label><br />
        <?php 
          if ($entitet->slika==null) {
            echo "Nemate trenutno izabranu sliku proizvoda.";
          }
          else {
            echo "<img src='" . $entitet->slika . "' style='width:25%'>";
          }
         ?>
        <input type="file" name="slika" id="slika" accept="image/*" />
        <p>
        <div style="text-align:right">
        <a style="margin-bottom:0;padding:6px 12px" href="urediprofil.php" class="alert button btn btn-default">Natrag</a>
        <input type="submit" class="button btn btn-default" value="Promjeni" name="promjeni" />
        <input type="submit" class="button btn btn-default" value="Obriši" name="obrisi" />
        </div>
        </p>
        </div>
      </fieldset>
    </form>
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
   
  </script> 
  </body>
</html>