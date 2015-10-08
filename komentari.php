<?php
if(!isset($_POST["komentar"]))
exit;
include_once 'konfiguracija.php';
$projekt = $_POST['sifra'];
$izraz = $veza->prepare("insert into komentari (vrijeme, korisnik, komentar, projekt) values ('now()', :korisnik, :komentar, $projekt)");
$izraz->bindValue(':korisnik', $_POST['korisnik']);
$izraz->bindValue(':komentar', $_POST['komentar']);
$izraz->execute();

$izraz = $veza->prepare("select a.ime, a.prezime, b.* from korisnik a inner join komentari b on a.sifra=b.korisnik where projekt=$projekt group by vrijeme DESC;");
$izraz->execute();
$skup=$izraz->fetchALL(PDO::FETCH_OBJ);
echo json_encode($skup);