<?php  
 

if (isset($_POST['name']) && isset($_POST['pass'])) {
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
	$pass = validate($_POST['pass']);

	if ( empty($name)|| empty($pass)) {
		header("Location: admin.html");
	}else {

		$sql2 = "SELECT * FROM admin WHERE name='$name' and password='$pass' ";
        $res2 = mysqli_query($conn, $sql2);

        $sql = "SELECT * FROM contact";
		$res = mysqli_query($conn, $sql);

		if (mysqli_fetch_array($res2)>0) {
			echo "All user!";
		?>

<html>
    <body>
    <table border="2">
             <tr>
             <th> Name </th>
             <th> Email </th>
             <th> Message </th>
            
             </tr>
             <tr>
                <?php
                while($row=mysqli_fetch_array($res)){

                    ?>
                <td> <?php echo $row['name'];?> </td>
                <td> <?php echo $row['email'];?> </td>
                <td> <?php echo $row['message'];?> </td>
             </tr>
                    <?php
                }

                ?>
             
    </table>
</body>
</html>
        
<?php

}else {
    echo "Wrong Email or Password!";
}
}

}else {
header("Location: admin.html");
}

?>