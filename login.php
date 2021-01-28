<?php 
	session_start();
	
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
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  
      <link rel="stylesheet" type="text/css" href="resources/css/style.css">
      <link rel="stylesheet" type="text/css" href="vendors/css/registerStyle.css">
    <script src="resources/js/homesaves.js"></script>
    <title>HomeSavings</title>
</head>

<body>
	<header>
        <div class="container">

            <div id="overlay"><img src="resources/img/logoTree.gif" alt="logo" /></div>
            <h1>HomeSavings</h1>
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
</body>

</html>