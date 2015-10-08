<?php
include_once '../konfiguracija.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$veza=new PDO("mysql:host=" . $server . ";dbname=" . $baza,$korisnik,$lozinka);
$veza->exec("set names utf8");
$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$email = $request->email;
    @$password = $request->password;
$izraz=$veza->prepare("select sifra, email, ime, prezime from korisnik where email=:email and lozinka=:password");
$izraz->bindValue(":email", $email); 
$izraz->bindValue(":password", md5($password));
$izraz->execute();
$korisnik=$izraz->fetch(PDO::FETCH_OBJ);
if($korisnik!=null){
	$sifra = $korisnik->sifra;
	$izraz=$veza->prepare("select a.naziv, a.sifra, b.putanja from projekt a inner join slike b on a.sifra=b.projekt where b.avatar=1 and a.korisnik=$sifra;");
	$izraz->execute();
	$projekti=$izraz->fetchALL(PDO::FETCH_OBJ);
	foreach ($projekti as $projekt) {
	$projekt->putanja = base64_encode(file_get_contents("http://localhost/nfx/" . $projekt->putanja));
}
	echo json_encode($projekti);
}
else{
	echo "false";
}