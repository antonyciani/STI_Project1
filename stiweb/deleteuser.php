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
session_unset();
session_destroy();
header('Location: index.php');

exit();
?>




</body>
</html>