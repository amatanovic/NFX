<?php
$server="localhost";
$baza="opg1";
$korisnik="root";
$lozinka="admin";
$putanja="/nfx/";
$veza=new PDO("mysql:host=" . $server . ";dbname=" . $baza,$korisnik,$lozinka);
$veza->exec("set names utf8;");
