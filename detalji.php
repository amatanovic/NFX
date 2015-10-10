<?php 
include 'konfiguracija.php';
session_start(); 
include 'head.php';
 ?>

<div class="container">
<?php
$izraz=$veza->prepare("select * from opg where sifra=:sifra");
$izraz->bindValue(":sifra",$_GET['sifra']);
$izraz->execute();
$opg=$izraz->fetch(PDO::FETCH_OBJ);
?>

<div class="row">
    <div class="col-lg-12">
        <img src="<?php echo $opg->avatar ?>" style="width:15em;height:15em;margin-top:2em;margin-left:41%;border-radius:20px;" />
    </div>
</div>
<h1 style="text-align:center"><?php echo $opg->naziv; ?></h1>
<p><?php echo $opg->kratakopis; ?></p>
</div>

<div class="container">
<?php
$opgID = $opg->sifra;
$izraz=$veza->prepare("select * from proizvod where opg=$opgID");
$izraz->execute();
$proizvodi=$izraz->fetchALL(PDO::FETCH_OBJ);
foreach ($proizvodi as $proizvod) { ?>
<p>Proizvod: <?php echo $proizvod->naziv; ?> <br /> 
Cijena: <?php echo $proizvod->cijena; ?> <br />
Kategorija: 
<?php 
$izraz1=$veza->prepare("select * from kategorija");
$izraz1->execute();
$kategorije=$izraz1->fetchALL(PDO::FETCH_OBJ);
foreach ($kategorije as $kategorija) {
  if ($kategorija->sifra == $proizvod->kategorija) { 
    echo $kategorija->naziv;
 }
}
?>
<br />
<img src="<?php echo $proizvod->slika ?>" style="width:25%" />
</p>
<?php
}
?>

</div>

<?php include 'prijava-modal.php'; ?>
  
      

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>

    </script>
  </body>
</html>