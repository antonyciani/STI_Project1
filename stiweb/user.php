<?php
// Start the session
session_start();

if (!isset($_SESSION['id'])){
	header("location:index.php");
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

    <title>STI-Messenger</title>

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
          <a class="navbar-brand" href="index.php">STI-Messenger</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
		  <ul class="nav navbar-nav">
            <li><a href="index.php">Accueil</a></li>

            <li class="active"><a href="user.php">Réception</a></li>
            <li><a href="writemessage.php">Envoi</a></li>
			<li><a href="account.php">Compte</a></li>
			<?php
				if(isset($_SESSION['role'])){
				
					//if($_SESSION['role'] == 1){
			?>
			<li><a href="admin.php">Admin</a></li>
			<?php
					//}
				}
				
			?>
			
			
          </ul>
		  <form action="deconnexion.php" method="post" class="navbar-form navbar-right">
						<button type="submit" class="btn btn-success disabled">Connecté!</button>
						<button type="submit" class="btn btn-danger ">Deconnexion</button>
		  </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Bienvenue dans la messagerie</h1>
        
		 
		 
		
		
      </div>
    </div>
	
	<div class="container">
		<div class="row">
		
		
		<h3>Boite de r&eacuteception </h3>
		<?php
			
			// Set default timezone
			date_default_timezone_set('UTC');
		 
			try {
				/**************************************
				* Create databases and                *
				* open connections                    *
				**************************************/
			 
				// Create (connect to) SQLite database in file
				//$file_db = new PDO('sqlite:/var/www/databases/database.sqlite');
				$file_db = new PDO('sqlite:../databases/messengerDatabase.sqlite');
				// Set errormode to exceptions
				$file_db->setAttribute(PDO::ATTR_ERRMODE, 
										PDO::ERRMODE_EXCEPTION); 
			 
				
				echo "Connected successfully";
				$userId = $_SESSION['id'];
				$sql = "SELECT * FROM messages WHERE receiver = \"" . $userId."\" ORDER BY sendDate DESC";
				echo $sql;
				$result = $file_db->query($sql);
				
				$resultArray = $result->fetchAll();
				$nbResults =  count($resultArray);
				
				if ($nbResults > 0) {
					echo "hello";
									
					print("
					
						<table class=\"table table-hover\">
					<thead>
					  <tr>
						<th>Date</th>
						<th>Expéditeur</th>
						<th>Sujet</th>
						<th></th>
					  </tr>
					</thead>
					<tbody>");
					
					foreach($resultArray as $row){
					
						$sql2 = "SELECT username FROM users WHERE id = \"" .$row['sender']."\"";
						$result2 = $file_db->query($sql2);
						$resultArray2 = $result2->fetchAll();
						
						$senderName = $resultArray2[0]['username'];
						$date = new DateTime();
						$date->setTimestamp($row['sendDate']);
						
						
						
						print("
							<tr>
							<td>".$date->format('d/m/Y H:i:s')."</td>
							<td>".$senderName."</td>
							<td>".$row['subject']."</td>
							<td>
								<form action=\"deletemessage.php\" method=\"post\" class=\"navbar-form navbar-right\">
									<input type=\"hidden\" name=\"messageid\" value=\"".$row['id']."\">
									<button type=\"submit\" class=\"btn btn-danger\">Supprimer </button>
								</form>
								<form action=\"writemessage.php\" method=\"post\" class=\"navbar-form navbar-right\">
									<input type=\"hidden\" name=\"messageid\" value=\"".$row['id']."\">
									<input type=\"hidden\" name=\"senderid\" value=\"".$row['sender']."\">
									<button type=\"submit\" class=\"btn btn-info\">Répondre </button>
								</form>
								<form action=\"showmessage.php\" method=\"post\" class=\"navbar-form navbar-right\">
									<input type=\"hidden\" name=\"messageid\" value=\"".$row['id']."\">
									<button type=\"submit\" class=\"btn btn-success\">Ouvrir </button>
								</form>
							</td>
							</tr>
						");
					
					}
					  
					  
					print("</tbody>
					</table>");
					
					
				}
				else{
					print("<div class=\"alert alert-danger\" role=\"alert\">
							<strong>Pas de messages reçus</strong>
						</div>");
				
				}
				

				
			}
			catch(PDOException $e) {
			// Print PDOException message
			echo $e->getMessage();
			}
			
			
			
		?>
		
			
		
		</div>
	
	
	
	</div>
	
	
	
	

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
		  <img src="images/greenbubble.png" class="img-responsive" alt="bubble">
        </div>
        <div class="col-md-4">
		  <img src="images/greenbubble.png" class="img-responsive" alt="bubble">
        </div>
		<div class="col-md-4">
		  <img src="images/greenbubble.png" class="img-responsive" alt="bubble">
        </div>
        
      </div>

      <hr>

      <footer>
        <p>&copy; 2016 HEIG-VD, CIANI Antony, HERNANDEZ Thomas</p>
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
