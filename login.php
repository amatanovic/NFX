<?php
if(!isset($_POST['email'])){
	echo "false";
	exit;
}
include_once 'konfiguracija.php';
$izraz=$veza->prepare("select * from korisnik where email=:email and lozinka=:lozinka");
$izraz->bindValue(":email", $_POST['email']); 
$izraz->bindValue(":lozinka", md5($_POST['lozinka']));
$izraz->execute();
$operater=$izraz->fetch(PDO::FETCH_OBJ);
if($operater!=null){
	session_start();
	$_SESSION['autoriziran']=$operater;
	echo "true";
}
else{
	echo "false";
}