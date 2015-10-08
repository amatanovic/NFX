<?php 
include 'konfiguracija.php'; 
session_start();
include 'head.php';
?>

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
}
?>

</div>
<div class="container">
<?php
if(!isset($_SESSION['autoriziran'])){ ?>
  <a class='button' style='width: 100%' id="donacija">Doniraj</a>
<?php } else { ?>
  <a class='button' href="doniraj.php" style='width: 100%'>Doniraj</a>
  <?php
}
?>
<p id="porukaDonacija"></p>
</div>   
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
    $('#autorizacija').modal('hide');

    $('#autorizacijaModal').click(function () {
        $('#autorizacija').modal('show');
    });
    $('#donacija').click(function(){
      $('#porukaDonacija').html('Da biste mogli donirati, molimo Vas da se prijavite!');
    });
  </script> 
  </body>
</html>