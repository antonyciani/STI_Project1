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
// Set session variables


if(isset($_POST["dateDepart"]) && isset($_POST["heureDepart"] ) && isset($_POST["nbPlaces"] ) && isset($_POST["lieuDepart"] ) && isset($_POST["lieuDestination"] ) && isset($_POST["prix"] )){
	$dateDepart = $_POST["dateDepart"]." ".$_POST["heureDepart"];
	$nbPlaces = $_POST["nbPlaces"];
	$lieuDepart = $_POST["lieuDepart"];
	$lieuDestination = $_POST["lieuDestination"];
	$prix = $_POST["prix"];
}
else{
	header('Location: ajouttrajet.php');
}

$idUser = $_SESSION["id"];



$sql = "INSERT INTO trajet  VALUES (NULL, ".$nbPlaces." , \"".$dateDepart."\", ".$prix.", \"".$lieuDepart."\", \"".$lieuDestination."\")";
$sql2 = "INSERT INTO propose  VALUES (".$idUser.", LAST_INSERT_ID() )";
$sql3 = "INSERT INTO conducteur VALUES(".$idUser.", )";
echo $sql;
echo $sql2;
$conn->autocommit(FALSE);
$result1 = $conn->query($sql);
$result2 = $conn->query($sql2);

if ($result1 === TRUE && $result2 === TRUE) {
    
	$conn->commit();
	$conn->autocommit(TRUE);
    echo "Ajout trajet reussi.";
	header('Location: ajouttrajetreussi.php');
} else {
    echo "Ajout trajet problem";
	header('Location: ajouttrajet.php');

}


exit();
?>




</body>
</html>