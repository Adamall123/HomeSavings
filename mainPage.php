<?php
	session_start();
	
	if(!isset($_SESSION['loggedin'])){
		header('Location: index.php');
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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital@0;1&display=swap" rel="stylesheet">
    <title>HomeSavings</title>
    <script src="resources/js/homesaves.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
	
	    <header>
        <div class="container">

            <div id="overlay"><img src="resources/img/logoTree.gif" alt="logo" /></div>
            <h1>HomeSavings</h1>
        </div>
    </header>
    
     <div class="topnav" id="myTopnav" >
        <a href="mainPage.php" class="mainPage" ><i class="fas fa-home"></i> Home</a>
        <a class="balance" ><i class="fas fa-chart-pie"></i> Balance</a>
        <a class="income " ><i class="fas fa-coins"></i> Add Income</a>
        <a class="expence"><i class="fas fa-shopping-cart"></i> Add Expence</a>
       
             <a href="settings.php" class="settings topnav-right"><i class="fas fa-cogs"></i> Setting</a>
            <a class="logout" href="logout.php" ><i class="fas fa-sign-out-alt"></i> Logout</a>
      
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
   <?php
		
		echo "<p >Hello ".$_SESSION['user']."!</p>";
	?>
	<main>
	
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-xl-3">
                <div class="balance text-center">
                    <h2>Balance</h2>
                    <h5>On this page you can check your summary of incomes and expences.</h5>
                    <div class="iconmain"><img src="resources/img/balance.png" alt="balance" /></div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3">
                <div class="income text-center">
                    <h2>Add income</h2>
                    <h5>Provide the amount, select one specific category.</h5>
                    <div class="iconmain"><img src="resources/img/income.png" alt="income" /></div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3">
                <div class="expence text-center">
                    <h2>Add expence</h2>
                    <h5>Provide the amount, select <strong>payment method</strong> and select one specific category.</h5>
                    <div class="iconmain"><img src="resources/img/expence3.png" alt="expence" /></div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3">
                <div class="settings text-center">
                    <h2>Settings</h2>
                    <h5>Delete, edit and add categories. Delete recently added income and expences.</h5>
                    <div class="iconmain"><img src="resources/img/settings.png" alt="setting" /></div>
                </div>
            </div>

        </div>
    </div>
	</main>
	
	<footer>

       

    </footer>

     
    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>
	
</body>

</html>