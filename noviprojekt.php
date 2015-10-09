<?php
include_once 'konfiguracija.php';
$korisnik = $_GET['sifra'];
$izraz = $veza->prepare("insert into projekt (naziv, kratakopis, detaljanopis, tag, korisnik) values ('Ovdje unesite naziv projekta', 'Ovdje unesite kratak opis', 'Ovdje unesite detaljan opis', 'Ovdje unesite tagove po kojima će korisnici pretraživati razdvojene zarezom', $korisnik);");
$izraz->execute();
header("location: promjena.php?sifra=" .  $veza->lastInsertId() );