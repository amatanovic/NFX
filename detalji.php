<?php 
include 'konfiguracija.php'; 
session_start();
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
      <img src="img_chania.jpg" alt="Chania">
    </div>

    <div class="item">
      <img src="img_chania2.jpg" alt="Chania">
    </div>

    <div class="item">
      <img src="img_flower.jpg" alt="Flower">
    </div>

    <div class="item">
      <img src="img_flower2.jpg" alt="Flower">
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
<form>
    <fieldset>
      <input type="hidden" name="sifra" value="<?php echo $_GET['sifra']?>" id="sifra"> <br />
      <input type="hidden" name="korisnik" value="<?php echo $korisnik?>" id="korisnik"> <br />
      <label for="komentar">Komentar</label> <input type="komentar" id="komentar" /> <br />
      <a id="komentiraj" href="#" class="button" style="width: 100%" type="submit">Komentiraj</a>
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
    $('#autorizacija').modal('hide');

    $('#autorizacijaModal').click(function () {
        $('#autorizacija').modal('show');
    });
    $('#donacija').click(function(){
      $('#porukaDonacija').html('Da biste mogli donirati, molimo Vas da se prijavite!');
    });

    $(function(){
    $("#komentiraj").click(function(){
      console.log("here");
     $.ajax({
        type: "POST",
        url: "komentari.php",
        data: "sifra=" + $("#sifra").val() + "&komentar=" + $("#komentar").val() + "&korisnik=" + $("#korisnik").val(),
        success: function(msg){
             podaci = $.parseJSON(msg);
              $("#komentari").html("");
              $.each(podaci,function(i,item){
             // $("#komentari").append($("<p>" + item.vrijeme + " Korisnik " + item.ime + " " + item.prezime "</p><p>" + item.komentar + "</p>"));
                console.log("here");
        });
      }
    });
    return false;
    });
  
  
    
  });
  </script> 
  </body>
</html>