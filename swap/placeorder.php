<?php

	$linksql = mysqli_connect("localhost", "root", "", "mysql");
	$linkdb = mysqli_select_db($linksql, "storedb");
	if (!$linksql){
		die('could not connet:' . mysqli_connect_errno()); //return error if connection fail
	}
	
	$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
	$products = array();
	$subtotal = 0.00;

	//for each item in the array, do the add order function.
	
	if ($products_in_cart) {
		// There are products in the cart so we need to select those products from the database
		// Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
		$array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
		$stmt = $pdo->prepare('SELECT * FROM products WHERE pid IN (' . $array_to_question_marks . ')');
		// We only need the array keys, not the values, the keys are the id's of the products
		$stmt->execute(array_keys($products_in_cart));
		// Fetch the products from the database and return the result as an Array
		$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Calculate the subtotal
		foreach ($products as $product) {
			$subtotal += (float)$product['product_price'] * (int)$products_in_cart[$product['PID']];
		}
	}
	
	
	

?>


<?=template_header('Cart')?>

<div class="cart content-wrapper">

<body style="background-color: #eeeeee">
        
		<div style="text-align: center;">
			<h1>Order Confirmation</h1>
		</div>
        <form action="placeorderdo.php" method="post" class="loginForm">
          
		Payment Type: <label class="form-check-label" for="Credit Card"></label>
            <input type="radio" class="form-check-input" name="paymenttype" value="Credit Card" required checked />Credit Card
            <div>
                <input type="text" name="cardnumber" placeholder="Card Number" autocomplete="off" class="signInFormLeft" required />
                <input type="text" name="expirydate" placeholder="Expiry date" autocomplete="off" class="signInFormRight" required />
            </div>
            <div class="signInFormBoxSeperator">
                <input type="text" name="cvc" placeholder="CVC" autocomplete="off" class="signInFormLeft" required />
                <input type="text" name="shippingaddress" placeholder="Shipping Address" autocomplete="off" class="signInFormRight" required />
            </div>
			<div>
			<input type="text" name="orderrequest" placeholder="Order Request" autocomplete="off" class="signInFormLeft" required />
			</div>
            <br><br><br>
            
            <br><br>
            <input type="submit" value="Place Order" class="createButton">
        </form>
    
    <form>
        <table>
            <thead>
                <tr>
                    <td colspan="2">Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                </tr>
                <?php else: ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td class="img">
                        <a href="index.php?page=product&id=<?=$product['PID']?>">
                            <img src="imgs/<?=$product['product_image']?>" width="50" height="50" alt="<?=$product['product_name']?>">
                        </a>
                    </td>
                    <td>
                        <a href="index.php?page=product&id=<?=$product['PID']?>"><?=$product['product_name']?></a>
                    </td>
                    <td class="price">&dollar;<?=$product['product_price']?></td>                    
					<td class="quantity"><?=$product['PID']?></td>
                    <td class="price">&dollar;<?=$product['product_price'] * $products_in_cart[$product['PID']]?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="subtotal">
            <span class="text">Subtotal</span>
            <span class="price">&dollar;<?=$subtotal?></span>
        </div>
       
    </form>
</div>

<?=template_footer()?>

    
