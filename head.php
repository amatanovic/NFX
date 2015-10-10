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
    <link href='https://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
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
            <li><a href="index.php#opg">OPG-OVI</a></li>
            <?php if(isset($_SESSION['autoriziran'])){ ?>                
            <li><a href="#">UREDI PROFIL</a></li>
            <li><a href="odjava.php">ODJAVA</a></li>
            <?php } else {?>
            <li><a href="index.php#registracija-odabir">REGISTRACIJA</a></li>
            <li><a href="#prijava" id="autorizacijaModal">PRIJAVA</a></li>
            <?php } ?>
            <li class="searchikona"><a href="#search" id="searchNav"><span class="glyphicon glyphicon-search"></span></a></li>  
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
      


    