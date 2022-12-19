<!DOCTYPE html>
<html>

<body>

    <?php
$servername='localhost';
$username='root';
$password='';
$dbname = "storedb";
$conn=mysqli_connect($servername,$username,$password,"$dbname");
if(!$conn){
	die('Could not Connect My Sql:' .mysql_error());
}




$sql = "SELECT review_PID, review_UID, review_rating, review_comment,review_postedDate FROM product_reviews";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<br> product id: ". $row["review_PID"]. "  Name: ". $row["review_UID"]. "- rating " . $row["review_rating"] . " comments " . $row["review_comment"]." posted on " . $row["review_postedDate"];
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>
</body>

</html>