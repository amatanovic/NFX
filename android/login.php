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
$izraz=$veza->prepare("select sifra, email, ime, prezime from korisnik where email=:email and lozinka=:lozinka");
$izraz->bindValue(":email", $email); 
$izraz->bindValue(":lozinka", md5($lozinka));
$izraz->execute();
$korisnik=$izraz->fetch(PDO::FETCH_OBJ);
if($korisnik!=null){
	$sifra = $korisnik->sifra;
	$izraz=$veza->prepare("select distinct a.sifra, a.naziv, a.avatar, b.opg from opg a inner join pracenje b on a.sifra=b.opg where b.korisnik != $sifra");
	$izraz->execute();
	$opgovi=$izraz->fetchALL(PDO::FETCH_OBJ);
	foreach ($opgovi as $opg) {
	$opgovi->korisnik = $sifra;
	$opg->avatar = base64_encode(file_get_contents("http://oziz.ffos.hr/OMS20142015/0122215735/hackathon/" . $opg->avatar));
}

	echo json_encode($opgovi);
}