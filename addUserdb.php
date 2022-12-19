<html>
<body>
<?php
	//connect to mysql
	$linksql = mysqli_connect("suryadb.mysql.database.azure.com", "SuryaAdmin", "Gundam@2017", "mysql");
	$linkdb = mysqli_select_db($linksql, "storedb");
	//check connection
	if($linksql === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    elseif ($linkdb === false){
        die("ERROR: Could link database " . mysqli_connect_error());
    }

	$pattern="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i"; // i behind the pattern is for case insensitive
	$ismatch=preg_match($pattern,$_POST["signUpEmailAddress"]);
	//if email is not valid, alert user and redirect back to sign up
	if (!$ismatch || $ismatch==0) {
		echo "<script>alert('Email is not valid'); window.location = './signUpForm.php';</script>";
		die();
	}

	//check if email exist in DB
	$query = "SELECT `user_email` FROM `users` WHERE `user_email` = '".$_POST['signUpEmailAddress']."'";
	$duplicateEmailCheck = mysqli_query($linksql, $query);
		if(mysqli_num_rows($duplicateEmailCheck)) {
    		echo "<script>alert('Email already exists'); window.location = './signUpForm.php';</script>";
			die();
		}

	//check if phone number exist in DB
	$query = "SELECT `user_number` FROM `users` WHERE `user_number` = '".$_POST['signUpPhoneNumber']."'";
	$duplicateNumberCheck = mysqli_query($linksql, $query);
		if(mysqli_num_rows($duplicateNumberCheck)) {
    		echo "<script>alert('Number already exists'); window.location = './signUpForm.php';</script>";
			die();
		}

		
	//if password not the same, alert user and redirect back to signup
    if ($_POST["signUpPassword"] != $_POST["signUpComfirmPassword"]) {
        echo "<script>alert('passwords are not the same'); window.location = './signUpForm.php';</script>";
		die();
    }
	
	//assign variables
	$firstName=$_POST['signUpFirstName'];
    $lastName=$_POST['signUpLastName'];
	$address=$_POST['signUpHomeAddress'];
	$username=$_POST['signUpUsername'];
	$password=hash('sha256',$_POST['signUpPassword']);
	$gender=$_POST['signUpGender'];
	$email=$_POST['signUpEmailAddress'];
    $number=$_POST['signUpPhoneNumber'];
	$role="User";

	adduser($firstName,$lastName,$address,$username,$password,$gender,$email,$number,$role,$linksql); //add current link into method so sql does not need to link twice	

	function adduser($firstName,$lastName,$address,$username,$password,$gender,$email,$number,$role,$linksql) {
		
		$query= $linksql->prepare("INSERT INTO storedb.users (username, user_firstName, user_lastName, user_email, user_address, user_gender, user_number, user_password, user_role) 
			VALUES (?,?,?,?,?,?,?,?,?)");
    	$query->bind_param('ssssssiss', $username, $firstName, $lastName, $email, $address, $gender, $number, $password, $role); 
		$query->execute();
		mysqli_close($linksql);
		echo "<script>alert('Account Created Successfully!'); window.location = '/loginform.php';</script>";
	}
?>
</html>
</body>

