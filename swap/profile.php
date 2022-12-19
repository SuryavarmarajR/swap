<html>
<head>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <style>
        .profileForm {
            background-color: #ffffff;
            width: 400px;
            margin: 100px auto 10px auto;
            padding: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px -3px #333;
            box-sizing: border-box;
        }
        
        .profileFormLeft {
            border-radius: 100px;
            padding: 10px 15px;
            width: 49%;
            border: 1px solid #D9D9D9;
            outline: none;
            display: block;
            float:left;
        }

        .profileFormRight {
            border-radius: 100px;
            padding: 10px 15px;
            width: 49%;
            border: 1px solid #D9D9D9;
            outline: none;
            display: block;
            float:right;
        }
        .signInFormBoxSeperator {
            padding-top: 20px;
        }

        .submitButton {
            margin-top: 1%;
            background-color: white;
            border: none;
            color: #28A8BC;
            float: right;
            cursor: pointer;
        }
        .submitButton:hover {
			cursor: pointer;
		}
        .logOutButton {
            margin-top: 1%;
            background-color: white;
            border: none;
            color: #28A8BC;
            float: left;
            cursor: pointer;
        }
        .submitButton:hover {
			cursor: pointer;
		}

    </style>
</head>
<body>
<?php
    $db = mysqli_connect('localhost', 'root', '') or
    die ('Unable to connect. Check your connection parameters.');
    mysqli_select_db($db, 'storedb' ) or die(mysqli_error($db));
    session_start();

    $id=$_SESSION['username'];
    $query=mysqli_query($db,"SELECT * FROM users where username ='$id'")or die(mysqli_error());
    $row=mysqli_fetch_array($query)
?>            


    <form method="post" action="profileChange.php" class="profileForm">
        <div class="signInFormBoxSeperator" style="text-align:center;">
            <i class="far fa-user-circle" style="font-size:70px; margin:auto;"></i>
        </div>
        <div class="signInFormBoxSeperator">
            <label>First name</label>
            <input type="text" class="profileFormLeft" name="fname" style="width:20em;" 
                placeholder="Enter your Firstname" value="<?php echo $row['user_firstName']; ?>" required />
        </div>
        <div class="signInFormBoxSeperator">
            <label>last name</label>
            <input type="text" class="profileFormLeft" name="lname" style="width:20em;" 
                placeholder="Enter your Lastname" value="<?php echo $row['user_lastName']; ?>" required />
        </div>
        <div class="signInFormBoxSeperator">
            <label>Phone number</label>
            <input type="tel" class="profileFormLeft" name="number" style="width:20em;" 
                placeholder="Enter your contact n0." pattern="[6-9]{1}[0-9]{7}" value="<?php echo $row['user_number']; ?>" required />
        </div>
        <div class="signInFormBoxSeperator">
            <label>Email Address</label>
            <input type="text" class="profileFormLeft" name="email" style="width:20em;" 
                placeholder="Enter your Email" value="<?php echo $row['user_email']; ?>">
        </div>
        <div class="signInFormBoxSeperator">
            <label>Address</label>
            <input type="text" class="profileFormLeft" name="address" style="width:20em;"  
                placeholder="Enter your Address" value="<?php echo $row['user_address']; ?>" required></textarea>
        </div>
        <div class="signInFormBoxSeperator">
        <input type="submit" value="Submit" class="submitButton">
        <a onclick="window.location='/swap/logout.php'" class="logOutButton">Log out</a>
    </div>
  </form>
</body>
</html>