<?php
if(!isset($_POST['email'])){
	echo "false";
	exit;
}
include 'konfiguracija.php';
$email = $_POST['email'];
$ime = $_POST['ime'];
$prezime = $_POST['prezime'];
$lozinka = $_POST['password'];
$ulica = $_POST['ulica'];
$mjesto = $_POST['mjesto'];
$kontakt = $_POST['kontakt'];
$izraz=$veza->prepare("insert into korisnik (ime, prezime, email, lozinka, ulica, mjesto, kontakt) values ('$ime', '$prezime', '$email', md5('$lozinka'), '$ulica', '$mjesto', '$kontakt')");
$izraz->execute();
echo "true";