<?php 
session_start();
include 'konfiguracija.php'; 
if(isset($_POST['obrisi'])){
  $izraz = $veza->prepare("delete from projekt where sifra=:sifra");
  $izraz->bindValue(":sifra",$_POST['sifra']);
  $izraz->execute();
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
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <fieldset>
        <h4>Podaci u bazi</h4>
        <input name="sifra" value="<?php echo $_GET['sifra']?>">
        <label for="naziv">Naziv</label>
        <input type="text" id="naziv" name="naziv" value="<?php echo $entitet->naziv;?>" />
        <p>
        <a href="index.php" class="alert button">Natrag</a>
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