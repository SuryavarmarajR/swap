<?php
if (isset($_SESSION['CREATED'])){
	
	if (time() - $_SESSION['CREATED'] > 100){
	session_unset();
	session_destroy();
	echo "<script>alert('Your session has expired! Please Sign in again'); window.location = '/loginform.php';</script>";
	}
	if (!isset($_SESSION["username"]))
    {
		echo "<script>alert('Please sign in first'); window.location = '/loginform.php';</script>";
	}
    else{
        $conn=mysqli_connect("suryadb.mysql.database.azure.com", "SuryaAdmin", "Gundam@2017","storedb");
        if(!$conn){
            die('Could not Connect My Sql:' .mysql_error());
        }
		
		//check if user has purchased the product
		$query = $conn->prepare("SELECT order_UID FROM storedb.orders WHERE order_PID = ? AND order_UID = ?"); //prepare statements
		$query->bind_param('ii', $_SESSION['last_PID'], $_SESSION['UID']); 
		$query->execute();
		$result = $query->get_result();
		$UID = $result->fetch_assoc();;
		
        
		if($UID['order_UID'] !== $_SESSION['UID']){
			echo "<script>alert('You need to purchase the product before you can review!'); window.location = './index.php'; </script>";
		}else{
		
        $review_PID = $_SESSION['last_PID'];
        $review_UID = $_SESSION['UID'];
        $review_rating = $_POST['review_rating'];
        $review_comment = $_POST['review_comment'];
        $review_postedDate = date("Y-m-d h:i:sa");
        
        //prepare
        $stmt = $conn->prepare("INSERT INTO product_reviews (review_PID, review_UID, review_rating, review_comment, review_postedDate) VALUES (?, ?, ?, ?, ?)");
        $stmt ->bind_param('sssss',$review_PID,$review_UID,$review_rating,$review_comment, $review_postedDate);
        $stmt->execute();

        $stmt->close();
        $conn->close();
        echo "<script>alert('Your review has been added!'); window.location = './index.php'; </script>";
		}
    }
    
}
else{
    echo "<script>alert('You have not logged in, please log in'); window.location = './loginform.php';</script>";

	die("");
}

?>

