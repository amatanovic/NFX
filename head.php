<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Local boost</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php#home">HOME</a></li>
            <li><a href="index.php#onama">O NAMA</a></li>
            <li><a href="index.php#projekti">PROJEKTI</a></li>
            <?php if(isset($_SESSION['autoriziran'])){
      ?>
      <li><a href="mojiprojekti.php"><li>MOJI PROJEKTI</li></a>
   <?php } ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
                     <?php
    if(isset($_SESSION['autoriziran'])){
      ?>
   <li><a href="logout.php"><li>ODJAVA</li></a>
   <?php } else {?>
            <li><a href="#prijava" id="autorizacijaModal">PRIJAVA</a></li>
            <li><a href="index.php#registracija">REGISTRACIJA</a></li>
              <?php }?>
            <li><span class="glyphicon glyphicon-search"></span></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
      

    <div id="home">  
      
      <img src="slike/milino-jezero.jpg" alt="početna slika" class="pocetnaslika">

    </div>