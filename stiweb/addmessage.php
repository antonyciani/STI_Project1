<?php
// Start the session
session_start();

if (!isset($_SESSION['id'])){

	header("location:index.php");
	exit;
}

?>
<!DOCTYPE html>
<html>
<body>
<?php

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
		// Set session variables
		$sender = $_SESSION["id"];
		$receiver = $_POST["destinataire"];
		$subject = $_POST["subject"];
		$message = $_POST["message"];
		$date = new DateTime();
		
		$sql = "INSERT INTO messages VALUES (NULL, \"".$sender."\", \"".$receiver."\",\"".$subject."\",\"".$message."\",\"".$date->getTimestamp()."\")";
		echo $sql;
		$result = $file_db->query($sql);
		
		


		//exit();
		
	}
	catch(PDOException $e) {
		// Print PDOException message
		echo $e->getMessage();
	}
	
	
	
?>




</body>
</html>