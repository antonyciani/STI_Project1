<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Covoiturage</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Covoiturage HEIG</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
		  <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Accueil</a></li>
			<?php
			if(isset($_SESSION["id"])){
				print("<li class=\" dropdown\">
              <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Menu <span class=\"caret\"></span></a>
              <ul class=\"dropdown-menu\">
                <li><a href=\"utilisateur.php\">Compte</a></li>
                <li><a href=\"recherche.php\">Recherche Trajet</a></li>
                <li><a href=\"ajouttrajet.php\">Ajout Trajet</a></li>
                <li><a href=\"ajoutcredit.php\">Ajout Crédits</a></li>
                <li><a href=\"deconnexion.php\">Deconnexion</a></li>
              </ul>
            </li>");
			}
			?>
            <li><a href="about.php">A propos</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
		  <?php
		  if(!isset($_SESSION["id"])){
			  print("<form action=\"connexion.php\" method=\"post\" class=\"navbar-form navbar-right\">
		  
            <div class=\"form-group\">
              <input type=\"email\" name=\"email\" placeholder=\"Email\" class=\"form-control\" required>
            </div>
            <div class=\"form-group\">
              <input type=\"password\" name=\"password\" placeholder=\"Mot de passe\" class=\"form-control\" required>
            </div>
            <button type=\"submit\" class=\"btn btn-success\">Connexion</button>
          </form>");
		  }
		  else{
			   print("<form action=\"deconnexion.php\" method=\"post\" class=\"navbar-form navbar-right\">
						<button type=\"submit\" class=\"btn btn-success\" disabled>Connecté!</button>
						<button type=\"submit\" class=\"btn btn-danger\">Deconnexion</button>
					</form>");
		  }
          
		  ?>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Le covoiturage, plus facile!</h1>
        <?php
		  if(!isset($_SESSION["id"])){
			  print("<p><a class=\"btn btn-primary btn-lg\" href=\"inscription.php\" role=\"button\">Inscris-toi! &raquo;</a></p>");
		  }
		 
          
		?>
		
		
      </div>
    </div>

    <div class="container">
	 <div class="row">
		<div class="col-md-6">
		  <div class="alert alert-success" role="alert">
				<strong>Ajout/Modification de voiture r&eacuteussi!</strong>
			</div>
        </div>
	  </div>
	  <hr>
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
		  <img src="images/hyundai.png" class="img-responsive" alt="hyundai">
        </div>
        <div class="col-md-4">
		  <img src="images/audi1.png" class="img-responsive" alt="hyundai">
        </div>
		<div class="col-md-4">
		  <img src="images/audi.png" class="img-responsive" alt="hyundai">
        </div>
        
      </div>

      <hr>

      <footer>
        <p>&copy; 2015 HEIG-VD, CIANI Antony, HERNANDEZ Thomas</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
