<!DOCTYPE html> 
<html lang="en">  
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="resources/css/style.css">
    <script src="resources/js/balance.js"></script>
    <script src="resources/js/homesaves.js"></script>
    
    
    <title>HomeSavings</title>
</head>

<body>
   
    <div class="container">
        <div id="setDateRangeForm">
            <form id="dateForm" method="post">
                <ul id="setDateRangeList">
                    <li >
                        <span style="font-size: 20px;">Set date range of your transactions:</span>
                    </li>
                    <li class="line"> </li>
                    <li>
                        <input type="radio" class="timePeriodRadio" id="currentMonthRadio">
                        <label for="currentMonthRadio">Current Month</label>
                    </li>
                    <li>
                        <input type="radio" class="timePeriodRadio" id="previousMonthRadio">
                        <label for="currentMonthRadio">Current Month</label>
                    </li>
                    <li>
                        <input type="radio" class="timePeriodRadio" id="currentYearRadio">
                        <label for="currentMonthRadio">Current Year</label>
                    </li>
                    <li>
                        <input type="radio" class="timePeriodRadio" id="totalTimeRadio">
                        <label for="currentMonthRadio">Total time</label>
                    </li>
                    <li>
                        <button type="button" class="btn btn-warning">Other Date Range</button>
                    </li>
                    <li id="otherPeriodOfTimeLabel">2021-01-01 : 2021-01-18</li>
                </ul>
            </form>
        </div>
        
        <section>
            <div class="row">
                <div class="col-lg-6">
                    <div class="Category">
                        <header>
                            <div class="CategoryHeader"><h4>Incomes</h4></div>
                        </header>
                        <div class="CategoryColumn">
                            <ul class="CategoryRow" id="incomes">
                            <li><a>Food: 200.00</a></li>
                                 <li><a>show/hide: example data: 2021-01-15 | 200.00 | Cash</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                     <div class="Category">
                        <header>
                            <div class="CategoryHeader"><h4>Expences</h4></div>
                        </header>
                    </div>
                </div>
            </div>
        </section>
        <div style="clear: both;"></div>
        <section>
            <div id="balanceWindow" style="background-color: green;">
            <h6>
                your balance is: 0.00 (change communication depending on status account)
                <br>
                Well done!
                </h6>
            </div>
        </section>
    
        <section>
            <h6>Results</h6>
            <div class="row">
                <div class="col-xl-6">
                     <div id="piechart_3d_income"></div>
                </div>
                <div class="col-xl-6">
                     <div id="piechart_3d_expence"></div>
                </div>
            </div>
        </section>
    </div>
    


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