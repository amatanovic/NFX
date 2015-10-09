<?php
include_once '../konfiguracija.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$veza=new PDO("mysql:host=" . $server . ";dbname=" . $baza,$korisnik,$lozinka);
$veza->exec("set names utf8");
$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$sifra = $request->sifra;
$izraz=$veza->prepare("select * from transakcije where projekt=$sifra ORDER BY vrijeme DESC");
$izraz->execute();
$transakcije=$izraz->fetchALL(PDO::FETCH_OBJ);
echo json_encode($transakcije);