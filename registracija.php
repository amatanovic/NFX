<?php
if(!isset($_POST['emailReg'])){
	echo "false";
	exit;
}
include_once 'konfiguracija.php';
$email = $_POST['emailReg'];
$ime = $_POST['ime'];
$prezime = $_POST['prezime'];
$lozinka = $_POST['lozinkaReg'];
$ziroracun = $_POST['ziroracun'];
$izraz=$veza->prepare("insert into korisnik (email, ime, prezime, lozinka, ziroracun) values ('$email', '$ime', '$prezime', md5('$lozinka'), '$ziroracun');
");
$izraz->execute();
echo "true";