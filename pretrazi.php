<?php
include_once 'konfiguracija.php';
$veza->exec("set names utf8;");
$izraz=$veza->prepare("select a.sifra as opgsifra, a.avatar as avatar, a.kratakopis as kratakopis, a.naziv as nazivopg, b.* from opg a inner join proizvod b on a.sifra=b.opg where b.naziv like :uvjet;");
$uvjet=$_POST["uvjet"];
$uvjet="%" . $uvjet . "%";
$izraz->bindParam(":uvjet", $uvjet);
$izraz->execute();
$skup=$izraz->fetchALL(PDO::FETCH_OBJ);
echo json_encode($skup);