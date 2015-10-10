<?php
$server="localhost";
$baza="zdravZivot";
$korisnik="root";
$lozinka="admin";
$putanja="/nfx/";
$veza=new PDO("mysql:host=" . $server . ";dbname=" . $baza,$korisnik,$lozinka);
$veza->exec("set names utf8;");
