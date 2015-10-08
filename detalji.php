<?php 
session_start();
include 'konfiguracija.php'; 
if(isset($_POST['komentiraj'])){
$projekt = $_POST['sifra'];
$komentar = $_POST['komentar'];
$izraz = $veza->prepare("insert into komentari (vrijeme, korisnik, komentar, projekt) values (now(), :korisnik, '$komentar', $projekt)");
$izraz->bindValue(':korisnik', $_POST['korisnik']);
$izraz->execute();
header("location: detalji.php?sifra=" . $projekt);
}
?>
<?php
include 'head.php';
?>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="slike/avatar.jpg" alt="Chania">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>





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
<?php
if(isset($_SESSION['autoriziran'])){
$korisnik = $_SESSION['autoriziran']->sifra; ?>
<div class="container">
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <input type="hidden" name="sifra" value="<?php echo $_GET['sifra']?>" id="sifra"> <br />
      <input type="hidden" name="korisnik" value="<?php echo $korisnik?>" id="korisnik"> <br />
      <label for="komentar">Komentar</label> <input type="komentar" id="komentar" name="komentar" /> <br />
      <input type="submit" value="Komentiraj" name="komentiraj" />
    </fieldset>
  </form>
</div> 
<div class="container" id="komentari">
<?php 
$izraz=$veza->prepare("select a.ime, a.prezime, b.* from korisnik a inner join komentari b on a.sifra=b.korisnik where projekt=:sifra group by vrijeme DESC;");
$izraz->bindValue(":sifra",$_GET['sifra']);
  $izraz->execute();
  $komentari=$izraz->fetchALL(PDO::FETCH_OBJ);
  if($komentari!=null){
  foreach($komentari as $komentar) {
        echo "<p>" . $komentar->vrijeme . " Korisnik " . $komentar->ime ." " . $komentar->prezime . "</p>
        <p>" . $komentar->komentar . "</p>";
  }
}
?>
</div>
<?php
}
?>  
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>

  </script> 
  </body>
</html>