<?php
include_once 'konfiguracija.php';
$veza->exec("set names utf8;");
$izraz=$veza->prepare("select a.*, b.putanja from projekt a inner join slike b on b.projekt=a.sifra where a.tag like :uvjet and a.kategorija like :uvjet2 and avatar=1");
$uvjet=$_POST["uvjet"];
$uvjet="%" . $uvjet . "%";
$uvjet2=$_POST["uvjet2"];
$uvjet2=$uvjet2 . "%";
$izraz->bindParam(":uvjet", $uvjet);
$izraz->bindParam(":uvjet2", $uvjet2);
$izraz->execute();
$skup=$izraz->fetchALL(PDO::FETCH_OBJ);
echo json_encode($skup);