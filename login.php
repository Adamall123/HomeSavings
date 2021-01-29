<?php 
	session_start();
		//pop up window
		//delete global session
	if((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] == true)){
		header('Location: mainPage.php');
		exit();
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  
      <link rel="stylesheet" type="text/css" href="resources/css/style.css">
      <link rel="stylesheet" type="text/css" href="vendors/css/registerStyle.css">
    <script src="resources/js/homesaves.js"></script>
    <title>HomeSavings</title>
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
                        Homesave
                    </div>
                    <form class="form" action="log.php" method="post">
                        <div class="inputfield">
                            <label>Email Address</label>
                            <input type="text" name="login" class="input">
                        </div>
                        <div class="inputfield">
                            <label>Password</label>
                            <input type="password" name="password" class="input">
                        </div>
                        <div class="inputfield btn-warning">
                            <input type="submit" value="log-in" class="mainPage btn"  >
                        </div>
                          <p><a href="register.php">Register as a new manager of your finanse</a></p>
                    </form>
					<?php
						if(isset($_SESSION['mistake']))
						echo $_SESSION['mistake'];
					?>
                </div>
            </div>
        </div>
    </div>
    </main>
	
	<script src="vendors/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>