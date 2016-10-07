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
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		$role = $_POST['role'];
		$active = $_POST['active'];

		$sql = "INSERT INTO users VALUES (NULL, \"".$username."\", \"".$password."\",\"".$role."\",\"".$active."\")";
		echo $sql;
		$result = $file_db->query($sql);
		
		echo "User added";
		$_SESSION['useraddsuccess'] = 1;
		

		
	}
	catch(PDOException $e) {
	// Print PDOException message
	echo $e->getMessage();
	}


?>