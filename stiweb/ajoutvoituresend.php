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



if(isset($_POST["immatriculation"]) && isset($_POST["marque"] ) && isset($_POST["couleur"] )){
	$immatriculation = $_POST["immatriculation"];
	$marque = $_POST["marque"];
	$couleur = $_POST["couleur"];
	
}
else{
	header('Location: ajoutvoiture.php');
}
$idUser = $_SESSION["id"];
$sql = "INSERT INTO voiture VALUES (NULL, \"".$immatriculation."\" , \"".$marque."\", \"".$couleur."\")";
$sql2 = "INSERT INTO conducteur VALUES (".$idUser.", LAST_INSERT_ID())";

echo $sql;
echo $sql2;
$conn->autocommit(FALSE);
$result1 = $conn->query($sql);
$result2 = $conn->query($sql2);
if ($result1 === TRUE && $result2 === TRUE) {
    
	$conn->commit();
	$conn->autocommit(TRUE);
    echo "Ajout voiture reussi.";
	header('Location: ajoutvoiturereussi.php');
} else {
    echo "Ajout voiture problem";
	header('Location: ajoutvoiture.php');

}


exit();
?>




</body>
</html>