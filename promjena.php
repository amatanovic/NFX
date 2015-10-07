<?php 
session_start();
include 'konfiguracija.php'; 
if(isset($_POST['obrisi'])){
  $sifra = $_POST['sifra'];
  $izraz = $veza->prepare("delete from slike where projekt=$sifra");
  $izraz->execute();
  $izraz1 = $veza->prepare("delete from projekt where sifra=$sifra");
  $izraz1->execute();
  header("location: mojiprojekti.php");
}
if(isset($_POST['promjeni'])){
  $izraz = $veza->prepare("update projekt set naziv=:naziv, kratakopis=:kratakopis, detaljanopis=:detaljanopis, kategorija=:kategorija, enddate=:enddate, tag=:tag where sifra=:sifra");
  $izraz->bindValue(":sifra",$_POST['sifra']);
  $izraz->bindValue(":naziv",$_POST['naziv']); 
  $izraz->bindValue(":kratakopis",$_POST['kratakopis']);
  $izraz->bindValue(":detaljanopis",$_POST['detaljanopis']);
  $izraz->bindValue(":kategorija",$_POST['kategorija']); 
  $izraz->bindValue(":enddate",$_POST['enddate']);
  $izraz->bindValue(":tag",$_POST['tag']);  
  $izraz->execute();
  $idProjekta = $_POST['sifra'];
  if ($_FILES['avatar']) {
    $slike_dir = "slike/";
    $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $slika_datoteka = $slike_dir . "avatar_" . $idProjekta . "." . $ext;
    $izraz1 = $veza->prepare("insert into slike (projekt, avatar, putanja) values ($idProjekta, 1, '$slika_datoteka')");
    $izraz1->execute();
    echo $slika_datoteka;
    move_uploaded_file($_FILES["avatar"]["tmp_name"], $slika_datoteka);
  }
 header("location: mojiprojekti.php");
}
?>

<?php 
include "head.php";
?>
<div class="container">
 <?php 
    
    $izraz = $veza->prepare("select * from projekt where sifra=:sifra");
    $izraz->bindValue(":sifra",$_GET['sifra']);
    $izraz->execute();
    $entitet=$izraz->fetch(PDO::FETCH_OBJ);
    
    ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
      <fieldset>
        <h4>Podaci u bazi</h4>
        <input type="hidden" name="sifra" value="<?php echo $_GET['sifra']?>"> <br />
        <label for="naziv">Naziv</label><br />
        <input type="text" id="naziv" name="naziv" value="<?php echo $entitet->naziv;?>" /><br />
        <label for="naziv">Kratak Opis</label><br />
        <input type="text" id="kratakopis" name="kratakopis" value="<?php echo $entitet->kratakopis;?>" /><br />
        <label for="naziv">Detaljan opis</label><br />
        <input type="text" id="detaljanopis" name="detaljanopis" value="<?php echo $entitet->detaljanopis;?>" /><br />
        <label for="kategorije">Kategorija</label><br />
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
        <label for="enddate">End date</label><br />
        <input type="text" id="enddate" name="enddate" value="<?php echo $entitet->enddate;?>" /><br />
        <label for="tag">Tag</label><br />
        <input type="text" id="tag" name="tag" value="<?php echo $entitet->tag;?>" /><br />
        <label for="avatar">Avatar</label><br />
         <?php
          $izraz = $veza->prepare("select * from slike where avatar=1");
          $izraz->execute();
          $entitet1=$izraz->fetchALL(PDO::FETCH_OBJ);
          foreach($entitet1 as $en){
          if ($entitet->sifra == $en->projekt) {
            echo "<img src='" . $en->putanja . "' />";
        }
        else if ($en->putanja==null) {
          echo "Vaš projekt trenutno nema avatar";
        }
        
        }
?>
        <input type="file" name="slike" id="slike" accept="image/*" />
        <label for="slike">Slike</label><br />
         <?php
          $izraz = $veza->prepare("select * from slike where avatar != 1");
          $izraz->execute();
          $entitet1=$izraz->fetchALL(PDO::FETCH_OBJ);
          foreach($entitet1 as $en){
          if ($entitet->sifra == $en->projekt) {
            echo "<img src='" . $en->putanja . "' />";
        }
        }
?>
        <input type="file" name="avatar" id="avatar" accept="image/*" />
        <p>
        <a href="mojiprojekti.php" class="alert button">Natrag</a>
        <input type="submit" class="button" value="Promjeni" name="promjeni" />
        <input type="submit" value="Obriši" name="obrisi" />
        </p>
        </div>
        </div>
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