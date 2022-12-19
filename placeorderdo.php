<?php

	$linksql = mysqli_connect("suryadb.mysql.database.azure.com", "SuryaAdmin", "Gundam@2017", "mysql");
	$linkdb = mysqli_select_db($linksql, "storedb");
	if (!$linksql){
		die('could not connet:' . mysqli_connect_errno()); //return error if connection fail
	}
	
	session_start();
	
	$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
	$products = array();
	
	
	$i = 0;
	do {				
		$order_UID = $_SESSION['UID']; 
		$order_PID = array_keys($products_in_cart)[$i];				
		$order_username = $_SESSION['username'];
		
		
		$query = $linksql->prepare('SELECT * FROM products WHERE pid = ?');
		$query->bind_param('i', $order_PID);
		$query->execute();
		$result = $query->get_result();
		$product = $result->fetch_assoc();
		
		$order_price = $product['product_price'] * $products_in_cart[$order_PID];
		$order_quantity = $product['PID'];
		
		
		$order_timestamp = "GETDATE()";
		$order_request = $_POST['orderrequest'];
		$order_payment = $_POST['paymenttype'];
		$order_shippingAddress = $_POST['shippingaddress'];
		$order_variation = "test";
		
		$query2 = $linksql->prepare("INSERT INTO storedb.orders (order_PID, order_UID, order_username, order_price, order_quantity, order_timestamp, order_request, order_payment, order_shippingAddress, order_variation) 
					VALUES (?,?,?,?,?,?,?,?,?,?)");
		$query2->bind_param('iississsss', $order_PID, $order_UID, $order_username, $order_price, $order_quantity, $order_timestamp, $order_request, $order_payment, $order_shippingAddress, $order_variation); 
		$query2->execute();
		unset($_SESSION['cart'][$order_PID]);
		$i++;			
		}
		while ($i < count($products_in_cart));
		
		
	header('location: index.php?page=ordersuccess');
?>