<?php
session_start();

/* FOR KEEP LOGIN
if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] > 10) {
    // session started more than 30 minutes ago
    session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
    $_SESSION['CREATED'] = time();  // update creation time
}*/
function debug() {
	echo "<pre>";
	echo "--------------------------------------------<br>";
	echo "_SESSION<br>";
	print_r($_SESSION);
	echo "_COOKIE<br>";
	print_r($_COOKIE);
	echo "session_name()= " . session_name();
	echo "<br>";
	echo "session_id()= " . session_id();
	echo "<br>";
	echo "</pre>";
	}

if (isset($_SESSION['CREATED'])){
	
	if (time() - $_SESSION['CREATED'] > 100){
	session_unset();
	session_destroy();
	header('Location: /swap/expiredsession.php');
	}else {
		echo "<pre><b>For authorised administrators only</b><br></pre>";

		if (isset($_SESSION["username"]) && $_SESSION["role"]=="Admin")
	{
		echo "<pre><h3>You are clear to access this page, <u>" . $_SESSION['username']. "</u></h3></pre>";
		echo "<pre><hr>Session time left:" . (100 - (time()-$_SESSION['CREATED'])). "</h3></pre>";
		debug();
	}
		elseif (!isset($_SESSION["username"]))
	{
		echo "<pre><h3><a href=loginform.php>You have not logged in. Please go back to login page</a></h3></pre>";
			debug();
			die("");
	}
		else {
			echo "<pre><h3><a href=loginform.php>You have not logged in as an administrator. This page is only for authorised administrators</a></h3></pre>";
			debug();
			die("");
	}

	
	
	}
}else{
	echo "<pre><h3><a href=loginform.php>You have not logged in. Please go back to login page</a></h3></pre>";
	die("");
}
?>