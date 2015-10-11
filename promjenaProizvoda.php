<h2 style="text-align:center;font-size:3em;">Uredi proizvod</h2>

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
<img class="pattern-lijevi uredi-pattern hidden-xs hidden-sm" src="slike/pattern.png" alt="pattern" />      
<img class="pattern-desni uredi-pattern hidden-xs hidden-sm" src="slike/pattern3.png" alt="pattern" />   
<div class="container">
 <?php 
    $sifra = $_GET['sifra'];
    $izraz = $veza->prepare("select * from proizvod where sifra=$sifra");
    $izraz->execute();
    $entitet=$izraz->fetch(PDO::FETCH_OBJ);
?>
     <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
      <fieldset class="forma-uredi uredi-proizvod">
        <form action="#" id="promjenaProizvoda">
        <input type="hidden" name="sifra" value="<?php echo $sifra; ?>"> <br />
        <input type="text" name="naziv" value="<?php echo $entitet->naziv;?>" /><br />
        <input type="text" id="cijena" name="cijena" value="<?php echo $entitet->cijena;?>" /><br />
         <select style="width: 16em; background-color: transparent;" id='kategorija' name='kategorija'><br />
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
        <label style="margin-top:2em;" for="slika">Slika</label><br />
        <?php 
          if ($entitet->slika==null) {
            echo "<p style='font-size:0.8em;'>Nemate trenutno izabranu sliku proizvoda.</p>";
          }
          else {
            echo "<img src='" . $entitet->slika . "' style='width:25%'>";
          }
         ?>
        <input class="odaberi-avatar " style="margin-top:1em;width:72%;margin-left: 16%;border: none;" type="file" name="slika" id="slika" accept="image/*" />
        <p>
        <div style="text-align:center">
        <input type="submit" class="button btn btn-primary" value="Promjeni" name="promjeni" />
        <input type="submit" class="button btn btn-secondary" value="Obriši" name="obrisi" />
        </div>
        <a style="margin-bottom:0;padding:6px 12px;margin-top:1em;" href="urediprofil.php" class="alert button btn btn-secondary">Natrag</a>
        </p>
        </div>
      </fieldset>
    </form>
</div>

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