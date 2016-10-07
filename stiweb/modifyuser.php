<?php
// Start the session
session_start();

if (!isset($_SESSION['id'])){

	header("location:index.php");
	exit;
}

if(isset($_SESSION['role'])){
	if($_SESSION['role'] != 1){
		header("location:index.php");
	}
}
else{
	header("location:index.php");

}

?>
<!DOCTYPE html>
<html>
<body>
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
		
		$userName = $_POST["username"];
		$newPassword = $_POST['password'];
		$role = $_POST['role'];
		$active = $_POST['active'];
		
		$sql = "SELECT id FROM users WHERE username = \"" . $userName."\"";
		
		echo $sql;
		$result = $file_db->query($sql);
		$resultArray = $result->fetchAll();
		$nbResults =  count($resultArray);
		
		if ($nbResults > 0) {
			
			$password = $resultArray[0]["password"];
			
			if($oldPassword == $password && $newPassword == $confirmation){
			
				$sql2 = "UPDATE users SET password = \"" . $newPassword."\" WHERE id = \"" . $userId."\"";
				echo $sql2;
				$result = $file_db->query($sql2);
				$_SESSION["passchangesuccess"] = 1;
				
			}
			else{
			
				$_SESSION["passchangesuccess"] = 0;
			
			}

		}
		else{
			
				$_SESSION["passchangesuccess"] = 0;
			
		}
		header('Location: account.php');

		exit();
		
	}
	catch(PDOException $e) {
	// Print PDOException message
	echo $e->getMessage();
	}
?>




</body>
</html>