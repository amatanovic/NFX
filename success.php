<?php
  include 'konfiguracija.php';
  date_default_timezone_set("Europe/Zagreb");
  $vrijeme = date('Y-m-d H:i:s', time());
  $iznos = $_GET['amount'];
  $projekt = $_GET['sifra'];
  $izraz = $veza->prepare("insert into transakcije(projekt, vrijeme, iznos) values ($projekt, '$vrijeme', $iznos)"); 
  $izraz->execute();
  header('location: index.php');