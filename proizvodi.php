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
<img class="pattern-lijevi uredi-pattern hidden-xs hidden-sm" src="slike/pattern3.png" alt="pattern" />      
<img class="pattern-desni uredi-pattern hidden-xs hidden-sm" src="slike/pattern3.png" alt="pattern" />   
<div class="container">
 <?php 
    $izraz = $veza->prepare("select * from proizvod where opg=:opg");
    $izraz->bindValue(":opg",$_GET['sifra']); 
    $izraz->execute();
    $entitet=$izraz->fetchALL(PDO::FETCH_OBJ);
    if ($entitet==null) {
      echo "<p>Nemate proizvoda</p>";
    }
    else {
      foreach($entitet as $e) {
        echo "<br /><br /><h2 class='moj-proizvod'>" . $e->naziv . "</h2><a style='padding:6px 12px' href='promjenaProizvoda.php?sifra=" . $e->sifra . "' class='alert button btn btn-primary btn-proizvod'>Uredi proizvod</a>";
      }
    }

    ?>
    

    <p class="proizvodi-button">
    <a style="margin-bottom:0;padding:6px 12px" href="noviProizvod.php?sifra=<?php echo $_GET['sifra']; ?>" class="alert button btn novi-button btn-secondary">Novi proizvod</a>
     <a style="margin-bottom:0;padding:6px 12px" href="urediprofil.php" class="alert button btn natrag-button btn-secondary">Natrag</a>
    </p>
    <br />
    <br />
    <br />
        <?php include 'footer.php';?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
   
  </script> 
  </body>
</html>