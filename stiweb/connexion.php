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
$_SESSION["connerror"] = true;
	header('Location: index.php');
    die("Connection failed: " . $conn->connect_error);
	
} 
echo "Connected successfully";
// Set session variables
$email = $_POST["email"];
$mdp = $_POST["password"];
$sql = "SELECT UtilisateurId FROM utilisateur WHERE Email = \"" . $email."\" AND motDePasse = \"". $mdp."\"";
echo $sql;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	session_unset();
	session_destroy();
    $_SESSION["id"] = $result->fetch_assoc()["UtilisateurId"]; 
	
    echo "Session variables are set.";
	header('Location: utilisateur.php');
} else {
    echo "0 results";
	$_SESSION["connerror"] = true;
	header('Location: index.php');

}


exit();
?>




</body>
</html>