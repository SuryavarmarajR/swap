<?php
// Get the 3 most recently added products
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY product_dateAdded DESC LIMIT 3');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Home')?>

<div class="featured">
    <h2>TP AMC</h2>
    <p>Essential Products for everyday use</p>
</div>
<div class="recentlyadded content-wrapper">
    <h2>Recently Added Products</h2>
    <div class="products">
        <?php foreach ($recently_added_products as $product): ?>
        <a href="index.php?page=product&id=<?=$product['PID']?>" class="product">
            <img src="imgs/<?=$product['product_image']?>" width="200" height="200" alt="<?=$product['product_name']?>">
            <span class="name"><?=$product['product_name']?></span>
            <span class="price">
                &dollar;<?=$product['product_price']?>
                <?php if ($product['product_retailPrice'] > 0): ?>
                <span class="rrp">&dollar;<?=$product['product_retailPrice']?></span>
                <?php endif; ?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<?=template_footer()?>