<html>
<style>
    .loginForm {
		background-color: #ffffff;
		width: 400px;
		margin: 100px auto 10px auto;
		padding: 30px;
		border-radius: 8px;
		overflow: hidden;
		box-shadow: 0 2px 10px -3px #333;
	}

    .signInFormLeft {
        border-radius: 100px;
		padding: 10px 15px;
		width: 49%;
		border: 1px solid #D9D9D9;
		outline: none;
		display: block;
		float:left;
    }

    .signInFormRight {
        border-radius: 100px;
		padding: 10px 15px;
		width: 49%;
		border: 1px solid #D9D9D9;
		outline: none;
		display: block;
		float:right;
    }
    .signInFormBoxSeperator{
        padding-top: 50px;
    }

    .createButton {
        margin-top: 1%;
        background-color: white;
        border: none;
        color: #28A8BC;
        float: left;
        cursor: pointer;
    }
</style>

<body style="background-color: #eeeeee">
        <div style="width: 100px; margin: auto">
            
        </div>
        <form action="addUserdb.php" method="post" class="loginForm">
            
		<div style="text-align: center;">
			<h2>Sign up</h2>
		</div>
            <div>
                <input type="text" name="signUpFirstName" placeholder="First name" autocomplete="off" class="signInFormLeft" required />
                <input type="text" name="signUpLastName" placeholder="Last name" autocomplete="off" class="signInFormRight" required />
            </div>
            <div class="signInFormBoxSeperator">
                <input type="text" name="signUpHomeAddress" placeholder="Address" autocomplete="off" class="signInFormLeft" required />
                <input type="text" name="signUpEmailAddress" placeholder="Email" autocomplete="off" class="signInFormRight" required />
            </div>
            <div class="signInFormBoxSeperator">
                <input type="text" name="signUpUsername" placeholder="Username" autocomplete="off" class="signInFormLeft" required />
                <input type="tel"  name="signUpPhoneNumber" placeholder="Phone number" autocomplete="off" class="signInFormRight" pattern="[6-9]{1}[0-9]{7}" required />
            </div>           
            <div class="signInFormBoxSeperator">
                <input type="password" name="signUpPassword" placeholder="Password" autocomplete="off" class="signInFormLeft" required />
                <input type="password" name="signUpComfirmPassword" placeholder="Comfirm password" autocomplete="off" class="signInFormRight" required />
            </div> 
            <br><br><br>
            Gender: <label class="form-check-label" for="Male"></label>
            <label class="form-check-label" for="Female"></label>
            <input type="radio" class="form-check-input" name="signUpGender" value="Male" required checked />Male
            <input type="radio" class="form-check-input" name="signUpGender" value="Female" />Female
            <br><br>
            <input type="submit" value="Create" class="createButton">
        </form>
</body>
</html>