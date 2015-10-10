<?php
include_once 'konfiguracija.php';
$opg = $_GET['sifra'];
$izraz = $veza->prepare("insert into proizvod (naziv, cijena, opg, kategorija) values ('Ovdje unesite naziv vašeg proizvoda', 0, $opg, 1)");
$izraz->execute();
header("location: promjenaProizvoda.php?sifra=" .  $veza->lastInsertId() );