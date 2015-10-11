<?php
include_once '../konfiguracija.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$veza=new PDO("mysql:host=" . $server . ";dbname=" . $baza,$korisnik,$lozinka);
$veza->exec("set names utf8");
$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$sifraOPG = $request->sifraOPG;
    @$sifraKorisnik = $request->sifraKorisnik;
	$izraz=$veza->prepare("insert into pracenje (opg, korisnik) values ($sifraOPG, $sifraKorisnik)");
	$izraz->execute();