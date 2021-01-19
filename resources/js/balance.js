 google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChartIncome);

      function drawChartIncome() {

        var dataIncome = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Salary',     3200.45],
          ['Allegro',      20],
          ['Interest',  293.34]
        ]);

        var options = {
            backgroundColor: 'transparent',
            title: 'Income',
            width: 700,
            height: 400,
            pieSliceText: 'value',
            is3D: true,
            color: 'white',
        };
          
     
          
          
        var chartIncome = new google.visualization.PieChart(document.getElementById('piechart_3d_income'));

        chartIncome.draw(dataIncome, options);
      }

 google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChartExpence);

      function drawChartExpence() {

         var dataExpence = google.visualization.arrayToDataTable([
          ['Expence', 'Amount'],
          ['Food', 600],
          ['Rent', 1000],
          ['Clothes', 40.34],
          ['Transport', 400]
        ]);

         var options = {
             backgroundColor: 'transparent',
             title: 'Expence',
             width: 700,
             height: 400,
             pieSliceText: 'value',
             is3D: true,
             color: 'white'
         };
         var chartExpence = new google.visualization.PieChart(document.getElementById('piechart_3d_expence'));

        chartExpence.draw(dataExpence, options);
      }