<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<?php
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
echo "Connected successfully";



if(isset($_POST["email"]) && isset($_POST["pass"] )){
	$email = $_POST["email"];
	$mdp = $_POST["pass"];
	if(isset($_POST["nom"])){
		$nom = $_POST["nom"];
	}
	else{
		$nom = "NULL";
	}
	
	if(isset($_POST["prenom"])){
		$prenom = $_POST["prenom"];
	}
	else{
		$prenom = "NULL";
	}
	if(isset($_POST["adresse"])){
		$adresse = $_POST["adresse"];
	}
	else{
		$adresse = "NULL";
	}
	if(isset($_POST["noTel"])){
		$noTel = $_POST["noTel"];
	}
	else{
		$noTel = "NULL";
	}
}
else{
	header('Location: inscription.php');
}

$sql = "INSERT INTO utilisateur (UtilisateurId, motDePasse , Email, Nom, Prenom, Adresse, NoTelephone) VALUES (NULL, \"".$mdp."\" , \"".$email."\", \"".$nom."\", \"".$prenom."\", \"".$adresse."\", \"".$noTel."\")";
echo $sql;
$result = $conn->query($sql);

if ($result === TRUE) {
    echo "Inscription reussie.";
	header('Location: inscriptionreussie.php');
} else {
    echo "Inscription problem";
	header('Location: inscription.php');

}


exit();
?>




</body>
</html>