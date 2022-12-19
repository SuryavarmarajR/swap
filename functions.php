<?php
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = "suryadb.mysql.database.azure.com";
    $DATABASE_USER = "SuryaAdmin";
    $DATABASE_PASS = "Gundam@2017";
    $DATABASE_NAME = 'storedb';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}
// Template header, feel free to customize this
function template_header($title) {

    // Get the amount of items in the shopping cart, this will be displayed in the header.
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

if (isset($_SESSION['CREATED'])){
    echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
        <header>
            <div class="content-wrapper">
                <h1>TP AMC Store</h1>
                <nav>
                    <a href="index.php">Recently Added</a>
                    <a href="index.php?page=products">Products</a>
                </nav>
                <div class="link-icons">
                    <a href="profile.php"><i class="far fa-user-circle" style="font-size:30px; margin:auto;"></i></a>
                    <a href="index.php?page=cart">
						<i class="fas fa-shopping-cart"></i><span>$num_items_in_cart</span>
					</a>
                </div>
            </div>
        </header>
        <main>
EOT;
}else{
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
        <header>
            <div class="content-wrapper">
                <h1>TP AMC Store</h1>
                <nav>
                    <a href="index.php">Recently Added</a>
                    <a href="index.php?page=products">Products</a>
                </nav>
                <div class="link-icons">
                    <a href="loginform.php">Sign in/Sign up</a>
                    <a href="index.php?page=cart">
						<i class="fas fa-shopping-cart"></i><span>$num_items_in_cart</span>
					</a>
                </div>
            </div>
        </header>
        <main>
EOT;
}
}
// Template footer
function template_footer() {
$year = date('Y');
echo <<<EOT
        </main>
        <footer>
            <div class="content-wrapper">
                <p>&copy; $year, TP AMC</p>
            </div>
        </footer>
        <script src="script.js"></script>
    </body>
</html>
EOT;
}

function checkSession(){
    if (isset($_SESSION['CREATED'])){
	    if (time() - $_SESSION['CREATED'] > 100){
            session_unset();
            session_destroy();
            echo "<script>alert('Your session has expired! Please Sign in again'); window.location = '/swap/loginform.php';</script>";
            //echo "<script>confirm('Your session is expiring, do you want to extend it?')</script>";
            //echo "$extend";
            //if($extend == "cancel"){
                //session_unset();
                //session_destroy();
                // echo "<script>alert('Your session has expired! Please Sign in again'); window.location = '/swap/loginform.php';</script>";
	            //}
            //else{   
               // $_SESSION['CREATED'] = time();
            //}
        }
    }
}   
?>