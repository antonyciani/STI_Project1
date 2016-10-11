<?php
// Start the session
session_start();

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
	 
		/**************************************
		* Create tables                       *
		**************************************/
	 
		// Create table messages
		$file_db->exec("
						
						CREATE TABLE IF NOT EXISTS users (
							id INTEGER PRIMARY KEY,
							username TEXT,
							password TEXT,
							role INTEGER,
							active INTEGER
						);
						
						CREATE TABLE IF NOT EXISTS messages (
							id INTEGER PRIMARY KEY, 
							sender INTEGER NOT NULL, 
							receiver INTEGER NOT NULL,
							subject TEXT,
							message TEXT, 
							sendDate TEXT,
							FOREIGN KEY(sender) REFERENCES users(id),
							FOREIGN KEY(receiver) REFERENCES users(id)
						);
						
						
						
						"); 
		echo "Connected successfully";
		// Set session variables
		$email = $_POST["email"];
		$password = $_POST["password"];
		$sql = "SELECT id,role,active FROM users WHERE username = \"" . $email."\" AND password = \"". $password."\"";
		echo $sql;
		$result = $file_db->query($sql);
		
		$resultArray = $result->fetchAll();
		$nbResults =  count($resultArray);
		
		if ($nbResults > 0) {
			echo "hello";
			
			session_unset();
			if($resultArray[0]["active"] == 1){
			
				$_SESSION['id'] = $resultArray[0]["id"];
				$_SESSION['role'] = $resultArray[0]["role"];
					
				
				echo "Session variables are set.";
				header('Location: user.php');
			
			}
			else{
				
				$_SESSION["connerror"] = true;
				header('Location: index.php');	
			
			}
			
		} else {
			echo "0 results";
			$_SESSION["connerror"] = true;
			header('Location: index.php');

		}


		exit();
		
	}
	catch(PDOException $e) {
	// Print PDOException message
	echo $e->getMessage();
	}
?>


</body>
</html>
