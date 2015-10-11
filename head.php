<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Zdrav život</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen and (max-width: 1119px)" href="css/styles-medium.css" />
    <link rel="stylesheet" type="text/css" media="screen and (max-width: 991px)" href="css/styles-small.css" />
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300' rel='stylesheet' type='text/css'>
      <link rel="icon" href="slike/logo.ico" type="image/x-icon">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <nav class="navbar navbar-fixed-bottom">
      <div class="container">
        <div class="navbar-header">

        </div>
        <div id="navbar" class="navbar-collapse collapse  visible-lg visible-md visible-sm visible-xs">
          <ul class="nav navbar-nav">
            <li class="hidden-lg hidden-md"><a id="hamburger" href="#"><span class="glyphicon glyphicon-menu-hamburger"></span></a></li>
            <li class="mobile-home"><a href="index.php#home">NASLOVNICA</a></li>
            <li><a href="index.php#onama">O NAMA</a></li>
            <li><a href="index.php#opg">OPG-OVI</a></li>
            <?php if(isset($_SESSION['autoriziran'])){ ?>                
            <li><a href="urediprofil.php">UREDI PROFIL</a></li>
            <li><a href="odjava.php">ODJAVA</a></li>
            <?php } else {?>
            <li><a href="index.php#registracija-odabir">REGISTRACIJA</a></li>
            <li><a href="#" id="autorizacijaModal">PRIJAVA</a></li>
            <?php } ?>
            <li class="searchikona"><a href="#opg" id="trazenjeNav"><span id="hamburger" class="glyphicon glyphicon-search"></span></a></li> 
            <li class="hidden-lg hidden-md" style="position: absolute;bottom: 0"><a id="chevron-up" href="#"><span class="glyphicon glyphicon-chevron-up"></span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
      
      
