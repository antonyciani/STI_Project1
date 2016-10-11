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
	

	// Set default timezone
  	date_default_timezone_set('UTC');

	try {
		
		$file_db = new PDO('sqlite:../databases/messengerDatabase.sqlite');
		// Set errormode to exceptions
		$file_db->setAttribute(PDO::ATTR_ERRMODE, 
								PDO::ERRMODE_EXCEPTION);
	 
		
		echo "Connected successfully";
		// Set session variables
		$sender = $_SESSION["id"];
		$receiverName = $_POST["destinataire"];
		$subject = $_POST["subject"];
		$message = $_POST["message"];
		$date = new DateTime();
		
		$sql2 = "SELECT id FROM users WHERE username = \"" .$receiverName."\"";
		echo $sql2;
		$result2 = $file_db->query($sql2);
		$resultArray2 = $result2->fetchAll();
		$nbResults2 =  count($resultArray2);
		
		if($nbResults2 > 0){
		
			$receiverId = $resultArray2[0]['id'];
			
			$sql = "INSERT INTO messages VALUES (NULL, \"".$sender."\", \"".$receiverId."\",\"".$subject."\",\"".nl2br($message)."\",\"".$date->getTimestamp()."\")";
			echo $sql;
			$result = $file_db->query($sql);
			
			echo "message sent";
			$_SESSION['messagesent'] = 1;
			
			header("location:writemessage.php");
		
		}
		else{
		
			echo "user doestn exist";
			$_SESSION['messagesent'] = 0;
			header("location:writemessage.php");
		
		}
		
	}
	catch(PDOException $e) {
		// Print PDOException message
		echo $e->getMessage();
	}
	
	
	
?>




</body>
</html>
