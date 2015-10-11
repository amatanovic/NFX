<?php
include_once '../konfiguracija.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$veza=new PDO("mysql:host=" . $server . ";dbname=" . $baza,$korisnik,$lozinka);
$veza->exec("set names utf8");
$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$email = $request->email;
    @$lozinka = $request->lozinka;
    @$device = $request->device;
$izraz=$veza->prepare("select sifra, email, ime, prezime from korisnik where email=:email and lozinka=:lozinka");
$izraz->bindValue(":email", $email); 
$izraz->bindValue(":lozinka", md5($lozinka));
$izraz->execute();
$korisnik=$izraz->fetch(PDO::FETCH_OBJ);
if($korisnik!=null){
	echo json_encode($korisnik);
}
else{
	echo "false";
}