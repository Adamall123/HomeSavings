<?php
	session_start();
	unset($_SESSION['mistake']); 
	if (isset($_POST['email'])){
		$all_OK = true; 
		$nick = $_POST['username'];
		if((strlen($nick) < 3) || (strlen($nick) > 20)) {
			$all_OK = false;
			$_SESSION['e_nick'] = "Nick must have between 3 and 20 characters!";
		}
		if (!ctype_alnum($nick)){
			$all_OK = false;
			$_SESSION['e_nick'] = "Nick can consist only of letters and numbers";
		}
		$email = $_POST['email'];
		$emailS = filter_var($email, FILTER_SANITIZE_EMAIL); //Remove all illegal characters from an email address
		
		if((!filter_var($emailS, FILTER_VALIDATE_EMAIL)) || ($emailS!=$email)){
			$all_OK = false; 
			$_SESSION['e_email'] = "Give correct e-mail!";
			}
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		
		if (strlen($password1) < 8 || strlen($password1) > 20){
			$all_OK = false; 
			$_SESSION['e_password'] = "Password must have between 8 and 20 characters!";
		}
		if (!($password1 == $password2)){
			$all_OK = false; 
			$_SESSION['e_password'] = "passwords are not the same!";
		}
		
		$password_hash = password_hash($password1, PASSWORD_DEFAULT) ;
		
		$secret = "6Lck-z8aAAAAANHvM7cul2QF999cFNCc-r8hPX-4";
		//verfied if not bot 
		/*$check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
		
		$answer = json_decode($check);
		
		if (!($answer->success)){
			$all_OK = false; 
			$_SESSION['e_bot'] = "Confirm that you are not a bot!";
		}
		*/
		//remember provided data
		
		$_SESSION['fr_nick'] = $nick;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_password1'] = $password1;
		$_SESSION['fr_password2'] = $password2;
		
		require_once "connect.php"; 
		mysqli_report(MYSQLI_REPORT_STRICT);
		try{
			$connection = new mysqli($host, $db_user,$db_password,$db_name);
			if($connection->connect_errno!=0){
				throw new Exception(mysqli_connect_errno());
			}
			else 
			{
				$result = $connection->query("SELECT id FROM users WHERE email='$email'");
				if(!$result) throw new Exception($connection->error);
				$amount_of_mails = $result->num_rows;
				if($amount_of_mails > 0){
					$all_OK = false;
					$_SESSION['e_email'] = "The account with given email exists.";
				}
				
				$result = $connection->query("SELECT id FROM users WHERE username='$nick'");
				if(!$result) throw new Exception($connection->error);
				$amount_of_nicks = $result->num_rows;
				if($amount_of_nicks > 0){
					$all_OK = false;
					$_SESSION['e_nick'] = "The account with given nickname exists.";
				}
				
				
				if($all_OK){
				//add user to database, and here we need to add more..... 
					if($connection->query("INSERT INTO users VALUES(NULL,'$nick','$password_hash','$email')"))
					{
						//get user_id 
						$query = "SELECT id FROM users ORDER BY id DESC";
						$result = mysqli_query($connection, $query);
						$row = mysqli_fetch_row($result);
						$highest_id = $row[0];
						//insert new data with user_id 
						$connection->query("INSERT INTO incomes_category_assigned_to_users(user_id,name)
						SELECT users.id as user_id, name FROM incomes_category_default,users WHERE users.id='$highest_id'");
						$connection->query("INSERT INTO expenses_category_assigned_to_users(user_id,name)
						SELECT users.id as user_id, name FROM expenses_category_default,users WHERE users.id='$highest_id'");
						$connection->query("INSERT INTO payment_methods_assigned_to_users(user_id,name)
						SELECT users.id as user_id, name FROM payment_methods_default,users WHERE users.id='$highest_id'");
						$_SESSION['passedRegistration'] = true;
						header('Location: login.php');
					}
					else{
						throw new Exception($connection->error);
					}
				}
				$connection->close();
			}
		}
		catch(Exception $e){
			echo '<span style="color:red;">Error server! We are sorry for all inconveniences and please register in another time</span>';
		}	
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="resources/css/style.css">
    <link rel="stylesheet" type="text/css" href="vendors/css/registerStyle.css">
    <script src="resources/js/homesaves.js"></script>
    <title>HomeSavings - add new account</title>
    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>

<body>
    <header>
        <div class="container">
		<a href="index.php">
            <div id="overlay"><img src="resources/img/logoTree.gif" alt="logo" /></div>
            <h1>HomeSavings</h1>
		</a>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="wrapper">
                        <div class="title">
                            Create a new finanse manager account.
                        </div>
                        <form class="form" method="post">
                            <div class="inputfield">
                                <label>Nickname</label>
                                <input type="text" value="<?php
								if(isset($_SESSION['fr_nick'])){
									echo $_SESSION['fr_nick'];
									unset($_SESSION['fr_nick']);
								}
							?>" name="username" class="input">
                            </div>
                            <?php 
								if(isset($_SESSION['e_nick'])){
									echo '<p class="error">'.$_SESSION['e_nick'].'</p>';
									unset($_SESSION['e_nick']);
								}
							?>
                            <div class="inputfield">
                                <label>Email Address</label>
                                <input type="text" value="<?php
								if(isset($_SESSION['fr_email'])){
									echo $_SESSION['fr_email'];
									unset($_SESSION['fr_email']);
								}
							?>" name="email" class="input">
                            </div>
                            <?php 
								if(isset($_SESSION['e_email'])){
									echo '<p class="error">'.$_SESSION['e_email'].'</p>';
									unset($_SESSION['e_email']);
								}
							?>
                            <div class="inputfield">
                                <label>Password</label>
                                <input type="password" value="<?php
								if(isset($_SESSION['fr_password1'])){
									echo $_SESSION['fr_password1'];
									unset($_SESSION['fr_password1']);
								}
							?>" name="password1" class="input">
                            </div>
                            <?php 
								if(isset($_SESSION['e_password'])){
									echo '<p class="error">'.$_SESSION['e_password'].'</p>';
									unset($_SESSION['e_password']);
								}
							?>
                            <div class="inputfield">
                                <label>Repeat password</label>
                                <input type="password" value="<?php
								if(isset($_SESSION['fr_password2'])){
									echo $_SESSION['fr_password2'];
									unset($_SESSION['fr_password2']);
								}
							?>" name="password2" class="input">
                            </div>
							<!--
                            <div class="g-recaptcha" data-sitekey="6Lck-z8aAAAAAAvsfLI1iUrgtZyoDIS0FXApfSpb"></div>
                            <?php 
								/*if(isset($_SESSION['e_bot'])){
									echo '<p class="error">'.$_SESSION['e_bot'].'</p>';
									unset($_SESSION['e_bot']);
								}*/
							?>
							-->
                            <div class="inputfield btn-warning">

                                <input type="submit" value="Register" class="btn">
                            </div>
                            <p><a href="login.php">Already have an account? Log in</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>