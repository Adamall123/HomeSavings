<?php
	session_start();
	unset($_SESSION['mistake']); 
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
    <main>
        <br><br><br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>Make money and be funny </h1>
                    <p>This is a simple, intuitive tool for everyday use.This website allows you to control incomes and expences.You can display all your statistics to optimize managin your money.</p>
					<a href = "register.php"type="button" class="btn btn-warning button1" >get Started!</a>
					<a href = "login.php"type="button" class="btn btn-warning button1" >login</a>
                </div>
                <div class="col-md-6">
                    <!-- <div id="office"><img src="resources/img/money3.png" alt="statistics" /></div> -->
                    <div class="slider">
                        <h3>Budget Manager!</h3>
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="resources/img/balance.png" alt="First slide">
                                    <div class="carousel-caption  d-md-block">
                                        <h5>Check Balance</h5>
                                        <p><strong>Get analysis from your incomes and expences !</strong></p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="resources/img/income.png" alt="Second slide">
                                        <div class="carousel-caption d-md-block">
                                        <h5>Add Income</h5>
                                        <p><strong>Add all incomes into one place !</strong></p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="resources/img/expence3.png" alt="Third slide">
                                    <div class="carousel-caption  d-md-block">
                                        <h5>Check Expence</h5>
                                        <p><strong>Be aware of where you are spending most money!</strong></p>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="false"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="false"></span>
                                <span class="sr-only">Next</span>
                            </a>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
   
    <footer>
		
    </footer>

     
        <script src="vendors/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>