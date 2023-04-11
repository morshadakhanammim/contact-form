<?php  


if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
	//include 'db_conn.php';
	$sname = "localhost";
$uname = "root";
$password = "";

$db_name = "db";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
	exit();
}

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$name = validate($_POST['name']);
	$email = validate($_POST['email']);
	$message = validate($_POST['message']);

	if (empty($message) || empty($name)|| empty($email)) {
		header("Location: index.html");
	}else {

		$sql = "INSERT INTO contact(name, email,  message) VALUES('$name', '$email', '$message')";
		$res = mysqli_query($conn, $sql);

		if ($res) {
			echo "Your message was sent successfully!";
		}else {
			echo "Your message could not be sent!";
		}
	}

}else {
	header("Location: index.html");
}

?>