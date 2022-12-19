<?php
 //sources - https://adnan-tech.com/prevent-user-from-login-for-30-seconds-after-3-failed-login-attempts-php/
    session_start();
    if (isset($_SESSION["locked"]))
{
    $difference = time() - $_SESSION["locked"];
    if ($difference > 30)
    {
        unset($_SESSION["locked"]);
        unset($_SESSION["login_attempts"]);
    }
}

     if ($_SERVER["REQUEST_METHOD"] == "POST")
     {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $servername='localhost';
        $username='root';
        $password='';
        $dbname = "storedb";
        $conn=mysqli_connect($servername,$username,$password,"$dbname");
        $sql = "SELECT * FROM users WHERE user_email = '" . $email . "'";
        $result = mysqli_query($conn, $sql);

        
        $result = mysqli_query($conn, $sql);
 
        if (mysqli_num_rows($result) > 0)
        {
            $row =mysqli_fetch_object($result);

            if (password_verify($password, $row ->user_password))
            {

            }
            else
            {
                $_SESSION["login_attempts"] += 1;
                $_SESSION["error"] = "Password does not match";
            }
        }
        else
        {
            $_SESSION["login_attempts"] += 1;
            $_SESSION["error"] = "Username not found";
        }
        
        $user = mysqli_fetch_object($result);
     }

?>
<form method="POST">
     <input type="email" name="email" placeholder="Enter email" required />
     <input type="password" name="password" placeholder="Enter password" required />
<?php
     // In sign-in form submit button
    if ($_SESSION["login_attempts"] > 2 ){
    $_SESSION["locked"] = time();
    echo "<p>Please wait for 30 seconds</p>";
}
    else
{
?>
     <button type="submit" name="login" value="Login">login</button>
 </form>
<?php } ?>