<?php 
include 'konfiguracija.php'; 
session_start();
if(!isset($_SESSION['autoriziran'])){
  header("location: logout.php");  
}
include 'head.php';
?>

<div class="container" id="mojiprojekti">
<?php
$korisnik = $_SESSION['autoriziran']->sifra;
$izraz=$veza->prepare("select * from projekt where korisnik=$korisnik");
$izraz->execute();
$projekti=$izraz->fetchAll(PDO::FETCH_OBJ);
if ($projekti==null) {
  echo "Nemate projekata";
}
else {
foreach ($projekti as $projekt) {
  echo "<p>" . $projekt->naziv . "</p>";
  echo "<a class='button' href='promjena.php?sifra=" . $projekt->sifra . "' style='width: 100%'>Izmjeni</a>";
}
}
?>

</div>
<div class="container">
<a class='button' href="noviprojekt.php?sifra=<?php echo $korisnik; ?>" style='width: 100%'>Dodaj novi projekt</a>
</div>
<br />
<br />
<?php include_once 'podnozje.php'; ?>   
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
   
  </script> 
  </body>
</html>