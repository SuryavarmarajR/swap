<html>
<?php
session_start();
$linksql = mysqli_connect("localhost", "root", "", "mysql");
$linkdb = mysqli_select_db($linksql, "storedb");
$UID = $_SESSION['UID'];
$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
$phone_number = $_POST['number'];
$email = $_POST['email'];
$address = $_POST['address'];
$query= $linksql->prepare("UPDATE users SET user_firstname = ?, user_lastname = ?, 
user_number = ?, user_email = ?, user_address = ? WHERE UID = ?");
$query->bind_param('ssissi', $firstname, $lastname, $phone_number, $email, $address, $UID); 
$query->execute();
echo "<script>alert('Successfully changed profile'); window.location = '/swap/index.php';</script>";
?>
<html>