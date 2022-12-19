<?php

logindo($_POST["username"], hash('sha256', $_POST["password"]));

function debug() {
	echo "<pre>";
	echo "--------------------------------------------<br>";
	echo "_SESSION<br>";
	
	echo "_COOKIE<br>";
	print_r($_COOKIE);
	echo "session_name()= " . session_name();
	echo "<br>";
	echo "session_id()= " . session_id();
	echo "<br>";
	echo "</pre>";
}
function logindo($username, $password) {
	
	$con=mysqli_connect("localhost","root",""); //connect to database
	if (!$con){
		die('could not connet:' . mysqli_connect_errno()); //return error if connection fail
	}

    $query = $con->prepare("SELECT UID, username, user_password, user_role FROM storedb.users WHERE username=? AND user_password=? LIMIT 1"); //prepare statements
    $query->bind_param('ss', $username, $password); 
    $query->execute();
    $query->bind_result($UID, $username, $password, $user_role);
    $query->store_result();
	
    if($query->num_rows == 1)  //To check if the row exists
        {
            $query->fetch(); //fetching the contents of the row
			session_start();
            $_SESSION['username'] = $username;
			$_SESSION['role'] = $user_role;
			$_SESSION['CREATED'] = time();
			$_SESSION['UID'] = $UID;
			debug();
            echo "<pre><b>GRATS ON LOGGING IN<b><pre>";
			$con->close();
			header('Location: /swap/index.php');
            exit();			
    }
	else {
		$con->close();
		echo "<script>alert('Username or password is wrong'); window.location = './loginform.php';</script>";
		exit();
    }
};