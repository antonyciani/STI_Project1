<?php
// Start the session
session_start();
if (!isset($_SESSION['id'])){
	header("location:login.php");
	exit;
}


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

    <!-- Fixed navbar -->
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
            <li><a href="index.php">Accueil</a></li>
				<li class=\" active dropdown\">
              <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Menu <span class=\"caret\"></span></a>
              <ul class=\"dropdown-menu\">
                <li><a href=\"utilisateur.php\">Compte</a></li>
                <li><a href=\"recherche.php\">Recherche Trajet</a></li>
                <li><a href=\"ajouttrajet.php\">Ajout Trajet</a></li>
                <li><a href=\"ajoutcredit.php\">Ajout Crédits</a></li>
                <li><a href=\"deconnexion.php\">Deconnexion</a></li>
              </ul>
            </li>
            <li><a href="about.php">A propos</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
		  <?php
		  if(!isset($_SESSION["id"])){
			  print("<form action=\"connexion.php\" method=\"post\" class=\"navbar-form navbar-right\">
		  
            <div class=\"form-group\">
              <input type=\"text\" name=\"email\" placeholder=\"Email\" class=\"form-control\">
            </div>
            <div class=\"form-group\">
              <input type=\"password\" name=\"password\" placeholder=\"Mot de passe\" class=\"form-control\">
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
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Le covoiturage, plus facile!</h1>
      </div>
    </div>

	<div class="container">
      <!-- Example row of columns -->
	  <div class="row">
		<div class="col-md-6">
		  <h1>Informations du compte<h1>
        </div>
		
	  </div>
	  <?php
			if(isset($_SESSION["id"])){
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "covoiturage";

				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);

				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 
				
				// Set session variables
				$id = $_SESSION["id"];
				$sql = "SELECT Email, Nom, Prenom, Adresse, NoTelephone, Credit FROM utilisateur INNER JOIN compte_credits ON utilisateur.CompteId = compte_credits.CompteId WHERE UtilisateurId = " . $id."";
				//echo $sql;
				$result = $conn->query($sql);

				//Infos generales
				if ($result->num_rows > 0) {
					// output data of each row
					$data = $result->fetch_assoc();
					$email = $data["Email"];
					$nom = $data["Nom"];
					$prenom = $data["Prenom"];
					$adresse = $data["Adresse"];
					$numTel = $data["NoTelephone"];
					$credit = $data["Credit"];
					print("<div class=\"row\">
					  <div class=\"col-md-6\">
						<h3>Informations générales<h3>
						  <table class=\"table table-striped\">
							<tbody>
							  <tr>
								<td><h4><strong>Nom:</strong></h4></td>
								<td><h4>".$nom."</h4></td>
							  </tr>
							  <tr>
								<td><h4><strong>Prénom:</strong></h4></td>
								<td><h4>".$prenom."</h4></td>
							  </tr>
							  <tr>
								<td><h4><strong>Email:</h4></strong></td>
								<td><h4>".$email."</h4></td>
							  </tr>
							  <tr>
								<td><h4><strong>Adresse:</strong></h4></td>
								<td><h4>".$adresse."</h4></td>
							  </tr>
							  <tr>
								<td><h4><strong>N° de téléphone</strong></h4></td>
								<td><h4>".$numTel."</h4></td>
							  </tr>
							   <tr>
								<td><h4><strong>Crédits:</strong></h4></td>
								<td><h4>".$credit." CHF</h4></td>
							  </tr>
							</tbody>
						  </table>
						</div>
					  </div>");
					
				} else {
					echo "0 results";
					header('Location: erreurconnexion.php');

				}
				
				//Infos si conducteur
				$sql2 = "SELECT Immatriculation, Marque, Couleur FROM voiture INNER JOIN conducteur ON conducteur.VoitureId = voiture.VoitureId WHERE conducteur.UtilisateurId = " . $id."";
				//echo $sql2;
				$result2 = $conn->query($sql2);

				
				if ($result2->num_rows > 0) {
					// output data of each row
					$data = $result2->fetch_assoc();
					$immatriculation = $data["Immatriculation"];
					$marque = $data["Marque"];
					$couleur = $data["Couleur"];
					
					print("<div class=\"row\">
					  <div class=\"col-md-6\">
						<h3>Voiture<h3>
						  <table class=\"table table-striped\">
							<tbody>
							  <tr>
								<td><h4><strong>Immatriculation:</strong></h4></td>
								<td><h4>".$immatriculation."</h4></td>
							  </tr>
							  <tr>
								<td><h4><strong>Marque:</strong></h4></td>
								<td><h4>".$marque."</h4></td>
							  </tr>
							  <tr>
								<td><h4><strong>Couleur:</h4></strong></td>
								<td><h4>".$couleur."</h4></td>
							  </tr>
							</tbody>
						  </table>
						</div>
					  </div>");
					
				} else {
					print("<div class=\"row\">
					  <div class=\"col-md-6\">
							<h3>Voiture<h3>
						  <table class=\"table table-striped\">
							<tbody>
							  <tr>
								<td><h4><strong>Pas de voiture</strong></h4></td>
								<td><form action=\"ajoutvoiture.php\" method=\"post\" class=\"navbar-form navbar-right\">
												
												<button type=\"submit\" class=\"btn btn-primary\">Ajouter &raquo</button>
											</form><td>
							  </tr>
							</tbody>
						  </table>
						</div>
					  </div>");
					

				}
				
				//Trajets proposés
				
				$sql3 = "SELECT trajet.IdTrajet, NbPlacesDispo, DateDepart, Prix, LieuDepart, LieuDestination FROM propose INNER JOIN trajet ON propose.IdTrajet = trajet.IdTrajet WHERE propose.UtilisateurId = " . $id."";
				//echo $sql3;
				$result3 = $conn->query($sql3);

				if ($result3->num_rows > 0) {
					// output data of each row
					
					print("<div class=\"row\">
							  <div class=\"col-md-9\">
							  <h3>Trajets proposés<h3>
								  <table class=\"table table-striped\">
									<tbody>
										<tr>
										<td><h5><strong>IdTrajet:</strong></h5></td>
										<td><h5><strong>Date de départ:</strong></h5></td>
										<td><h5><strong>Lieu de départ:</strong></h5></td>
										<td><h5><strong>Lieu de destination:</strong></h5></td>
										<td><h5><strong>Prix:</strong></h5></td>
										</tr>");
						while($data = $result3->fetch_assoc()){
							$idTrajet = $data["IdTrajet"];
							$dateDepart = $data["DateDepart"];
							$lieuDepart = $data["LieuDepart"];
							$lieuDestination = $data["LieuDestination"];
							$prix = $data["Prix"];
							print("<tr>
										<td><h5>".$idTrajet."</h5></td>
										<td><h5>".$dateDepart."</h5></td>
										<td><h5>".$lieuDepart."</h5></td>
										<td><h5>".$lieuDestination."</h5></td>
										<td><h5>".$prix."</h5></td>
										</tr>");
							
						}
						
						print("</tbody>
							  </table>
							  </div>
							  </div>");
					
				} else {
					print("<div class=\"row\">
					  <div class=\"col-md-6\">
					  <h3>Trajets proposés<h3>
						  <table class=\"table table-striped\">
							<tbody>
							  <tr>
								<td><h4><strong>Pas de trajets proposés</strong></h4></td>
							  </tr>
							</tbody>
						  </table>
						</div>
					  </div>");
					

				}
				
				//Trajets reservés
				
				$sql4 = "SELECT trajet.IdTrajet, NbPlacesDispo, DateDepart, Prix, LieuDepart, LieuDestination FROM reserve INNER JOIN trajet ON reserve.IdTrajet = trajet.IdTrajet WHERE reserve.UtilisateurId = " . $id."";
				//echo $sql4;
				$result4 = $conn->query($sql4);

				if ($result4->num_rows > 0) {
					// output data of each row
					
					print("<div class=\"row\">
							  <div class=\"col-md-9\">
							  <h3>Trajets reservés<h3>
								  <table class=\"table table-striped\">
									<tbody>
										<tr>
										<td><h5><strong>IdTrajet:</strong></h5></td>
										<td><h5><strong>Date de départ:</strong></h5></td>
										<td><h5><strong>Lieu de départ:</strong></h5></td>
										<td><h5><strong>Lieu de destination:</strong></h5></td>
										
										</tr>");
						while($data = $result4->fetch_assoc()){
							$idTrajet = $data["IdTrajet"];
							$dateDepart = $data["DateDepart"];
							$lieuDepart = $data["LieuDepart"];
							$lieuDestination = $data["LieuDestination"];
								
							print("<tr>
										<td><h5>".$idTrajet."</h5></td>
										<td><h5>".$dateDepart."</h5></td>
										<td><h5>".$lieuDepart."</h5></td>
										<td><h5>".$lieuDestination."</h5></td>
										
										</tr>");
							
						}
						
						print("</tbody>
							  </table>
							  </div>
							  </div>");
					
				} else {
					print("<div class=\"row\">
					  <div class=\"col-md-6\">
					  <h3>Trajets reservés<h3>
						  <table class=\"table table-striped\">
							<tbody>
							  <tr>
								<td><h4><strong>Pas de trajets reservés</strong></h4></td>
							  </tr>
							</tbody>
						  </table>
						</div>
					  </div>");
				}
				
				
				//Avis
				
				
				
				
				
				
			}
			else{
				header('Location: index.php');
			}
			
		?>
	  
      </div>
    </div> <!-- /container -->
	
    <div class="container">
      <!-- Example row of columns -->
	  <hr>	  
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
