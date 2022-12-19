<?php
//connect to mysql
$linksql = mysqli_connect("suryadb.mysql.database.azure.com", "SuryaAdmin", "Gundam@2017", "mysql", "3306");
//check connection
if($linksql === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

//create schema
$sql = "CREATE SCHEMA IF NOT EXISTS storedb";
if(mysqli_query($linksql, $sql)){
    echo "Database created successfully";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($linksql);
}


//create users table
$sql = "CREATE TABLE IF NOT EXISTS `storedb`.`users` (
    `UID` INT(11) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(20) NOT NULL,
    `user_firstName` VARCHAR(30) NOT NULL,
    `user_lastName` VARCHAR(30) NOT NULL,
    `user_email` VARCHAR(100) NOT NULL,
    `user_address` VARCHAR(100) NOT NULL,
    `user_gender` VARCHAR(10) NOT NULL,
    `user_number` VARCHAR(12) NOT NULL,
    `user_password` VARCHAR(255) NOT NULL,
    `user_picture` VARCHAR(255) NOT NULL,
    `user_role` VARCHAR(10) NOT NULL,
    PRIMARY KEY (`UID`),
    UNIQUE INDEX `username_UNIQUE` (`username` ASC),
    UNIQUE INDEX `UID_UNIQUE` (`UID` ASC),
    UNIQUE INDEX `user_email_UNIQUE` (`user_email` ASC),
    UNIQUE INDEX `user_number_UNIQUE` (`user_number` ASC))
  ";
//check if user table was successfully created
if(mysqli_query($linksql, $sql)){
    echo "Users table created successfully.<br>";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($linksql);
}


//create products table
$sql = "CREATE TABLE IF NOT EXISTS `storedb`.`products` (
    `PID` int(11) NOT NULL AUTO_INCREMENT,
    `product_name` VARCHAR(200) NOT NULL,
    `product_description` text NOT NULL,
    `product_dateAdded` datetime NOT NULL,
    `product_quantity` INT(11) NOT NULL,
    `product_price` decimal(7,2) NOT NULL,
    `product_retailPrice` decimal(7,2) DEFAULT NULL,
    `product_variation` VARCHAR(45) NOT NULL,
    `product_image` VARCHAR(255) NOT NULL,
    `product_filter` VARCHAR(45) DEFAULT NULL,
    PRIMARY KEY (`PID`),
    UNIQUE KEY `PID_UNIQUE` (`PID` ASC))";
//check if products table was successfully created
if(mysqli_query($linksql, $sql)){
    echo "Product table created successfully.<br>";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($linksql);
}


//create product_reviews table
$sql = "CREATE TABLE IF NOT EXISTS `storedb`.`product_reviews` (
    `RID` INT(11) NOT NULL AUTO_INCREMENT,
    `review_PID` INT(11) NOT NULL,
    `review_UID` INT(11) NOT NULL,
    `review_rating` VARCHAR(45) NOT NULL,
    `review_comment` VARCHAR(255) NOT NULL,
    `review_postedDate` DATETIME NOT NULL,
    PRIMARY KEY (`RID`),
    INDEX `product_id_idx` (`review_PID` ASC),
    INDEX `userID_idx` (`review_UID` ASC),
    CONSTRAINT `productID`
      FOREIGN KEY (`review_PID`)
      REFERENCES `storedb`.`products` (`PID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
    CONSTRAINT `userID`
      FOREIGN KEY (`review_UID`)
      REFERENCES `storedb`.`users` (`UID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)";
//check if product_reviews table was successfully created
if(mysqli_query($linksql, $sql)){
    echo "Product_review table created successfully.<br>";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($linksql);
}


//create orders table
$sql = "CREATE TABLE IF NOT EXISTS `storedb`.`orders` (
    `OID` INT(11) NOT NULL AUTO_INCREMENT,
    `order_PID` INT(11) NOT NULL,
    `order_UID` INT(11) NOT NULL,
    `order_username` VARCHAR(20) NOT NULL,
    `order_price` VARCHAR(45) NOT NULL,
    `order_quantity` INT(10) NOT NULL,
    `order_timestamp` DATETIME NOT NULL,
    `order_request` VARCHAR(255) NULL DEFAULT NULL,
    `order_payment` VARCHAR(45) NOT NULL,
    `order_shippingAddress` VARCHAR(100) NOT NULL,
    `order_variation` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`OID`),
    UNIQUE INDEX `OID_UNIQUE` (`OID` ASC),
    INDEX `orderPID_idx` (`order_PID` ASC),
    INDEX `orderUID_idx` (`order_UID` ASC),
    CONSTRAINT `orderPID`
      FOREIGN KEY (`order_PID`)
      REFERENCES `storedb`.`products` (`PID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
    CONSTRAINT `orderUID`
      FOREIGN KEY (`order_UID`)
      REFERENCES `storedb`.`users` (`UID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)";
//check if orders table was successfully created
if(mysqli_query($linksql, $sql)){
    echo "Orders table created successfully.<br>";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($linksql);
}

//create product_variation table
$sql = "CREATE TABLE IF NOT EXISTS `storedb`.`product_variation` (
    `product_variationID` INT(11) NOT NULL AUTO_INCREMENT,
    `variation_PID` INT(11) NOT NULL,
    `variation_name` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`product_variationID`),
    INDEX `variationPID_idx` (`variation_PID` ASC),
    CONSTRAINT `variationPID`
      FOREIGN KEY (`variation_PID`)
      REFERENCES `storedb`.`products` (`PID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)";
//check if product_variation table was successfully created
if(mysqli_query($linksql, $sql)){
    echo "Table created successfully.<br>";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($linksql);
}
 
// Close connection
mysqli_close($linksql);
?>