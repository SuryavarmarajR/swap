<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    $_SESSION['last_PID'] = $_GET['id'];
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM products WHERE pid = ?');
    $stmt->execute([$_GET['id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}
function addreview() {
    $conn=mysqli_connect('localhost','root','',"storedb");
    if(!$conn){
        die('Could not Connect My Sql:' .mysql_error());
    }
    
    $review_PID = $_GET['id'];
    $review_UID = $_SESSION['UID'];
    $review_rating = $_POST['review_rating'];
    $review_comment = $_POST['review_comment'];
    $review_postedDate = date("Y-m-d h:i:sa");
    echo "<script>alart($review_PID, $review_UID, $review_rating, $review_comment, $review_postedDate)</script>";
    //prepare
    $stmt = $conn->prepare("INSERT INTO product_reviews (review_PID, review_UID, review_rating, review_comment, review_postedDate) VALUES (?, ?, ?, ?, ?)");
    $stmt ->bind_param('sssss',$review_PID,$review_UID,$review_rating,$review_comment, $review_postedDate);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
?>
<?=template_header('Product')?>

<div class="product content-wrapper">
    <img src="imgs/<?=$product['product_image']?>" width="500" height="500" alt="<?=$product['product_name']?>">
    <div>
        <h1 class="name"><?=$product['product_name']?></h1>
        <span class="price">
            &dollar;<?=$product['product_price']?>
            <?php if ($product['product_retailPrice'] > 0): ?>
            <span class="rrp">&dollar;<?=$product['product_retailPrice']?></span>
            <?php endif; ?>
        </span>
        <form action="index.php?page=cart" method="post">
            <input type="number" name="quantity" value="1" min="1" max="<?=$product['product_quantity']?>" placeholder="Quantity" required>
            <input type="hidden" name="product_id" value="<?=$product['PID']?>">
            <input type="submit" value="Add To Cart">
        </form>
        <form action="index.php?page=addreviews" method="post">
            <h1>Add a review</h1>
            <input type="text" name="review_comment" placeholder="Comment" style="padding:5px" required>
            <input type="number" name="review_rating" min="1" max="5">
            <input type="submit" value="Add review">
        </form>
            
        


        <div class="description">
            <?=$product['product_description']?>
        </div>
    </div>
</div>

<?=template_footer()?>