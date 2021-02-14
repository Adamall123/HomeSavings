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
		//$email = $_POST['email'];
		$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); //(źródło danych wejściowych, indeks zmiennej, rodzaj filtru)
		//$emailS = filter_var($email, FILTER_SANITIZE_EMAIL); //Remove all illegal characters from an email address
		if(empty($email)){
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
		$check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
		
		$answer = json_decode($check);
		
		if (!($answer->success)){
			$all_OK = false; 
			$_SESSION['e_bot'] = "Confirm that you are not a bot!";
		}
		
		$_SESSION['fr_nick'] = $_POST['username'];
		$_SESSION['fr_email'] =  $_POST['email'];
		$_SESSION['fr_password1'] = $_POST['password1'];
		$_SESSION['fr_password2'] = $_POST['password2'];

		require_once 'database.php';
		$query = $db->prepare("SELECT id FROM users WHERE email= :email");
		$query->bindValue(':email', $email, PDO::PARAM_STR);
		$query->execute();
		$amount_of_mails = $query->rowCount();
		if($amount_of_mails > 0){
			$all_OK = false;
			$_SESSION['e_email'] = "The account with given email exists.";
		}
		$query = $db->prepare("SELECT id FROM users WHERE username= :username");
		//if(!$query) throw new Exception($connection->error);
		$query->bindValue(':username', $nick, PDO::PARAM_STR);
		$query->execute();
		$amount_of_nicks = $query->rowCount();
		if($amount_of_nicks > 0){
			$all_OK = false;
			$_SESSION['e_nick'] = "The account with given nickname exists.";
		}
		if($all_OK){ 
			$query = $db->prepare('INSERT INTO users  VALUES (NULL, :username, :password, :email)');
			$query->bindValue(':username', $nick, PDO::PARAM_STR);
			$query->bindValue(':password', $password1, PDO::PARAM_STR);
			$query->bindValue(':email', $email, PDO::PARAM_STR);
			if($query->execute())
			{
				$user_id_query  = $db->prepare("SELECT id FROM users ORDER BY id DESC");
				$user_id_query->execute(); 
				$user = $user_id_query->fetch();
				$highest_id = $user[0];
				//insert new data with user_id 
				$query = $db->prepare("INSERT INTO incomes_category_assigned_to_users(user_id,name)
				SELECT users.id as user_id, name FROM incomes_category_default,users WHERE users.id=:id");
				$query->bindValue(':id', $highest_id, PDO::PARAM_INT);
				$query->execute();
				$query = $db->prepare("INSERT INTO expenses_category_assigned_to_users(user_id,name)
				SELECT users.id as user_id, name FROM expenses_category_default,users WHERE users.id=:id");
				$query->bindValue(':id', $highest_id, PDO::PARAM_INT);
				$query->execute();
				$query = $db->prepare("INSERT INTO payment_methods_assigned_to_users(user_id,name)
				SELECT users.id as user_id, name FROM payment_methods_default,users WHERE users.id=:id");
				$query->bindValue(':id', $highest_id, PDO::PARAM_INT);
				$query->execute();
				$_SESSION['passedRegistration'] = true;
				header('Location: login.php');
			}
			else{
				//throw new Exception($connection->error);
			}
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
							
                            <div class="g-recaptcha" data-sitekey="6Lck-z8aAAAAAAvsfLI1iUrgtZyoDIS0FXApfSpb"></div>
                            <?php 
								if(isset($_SESSION['e_bot'])){
									echo '<p class="error">'.$_SESSION['e_bot'].'</p>';
									unset($_SESSION['e_bot']);
								}
							?>
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