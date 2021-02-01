<html>
    <head>
        <title>Learn Make Graphic with PHP</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
        <style type="text/css">
            .container {
                width: 50%;
                margin: 15px auto;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <canvas id="myChart" width="100" height="80"></canvas>
        </div>
        <script>
            <?php 
                // haal data uit database
                // maak logische datumverdeling 

                $labels = '["' . $value;
                $value = '["' . $value;            
            
            ?> 
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["1", "2", "3", "4", "5", "6"], // X-As
                    datasets: [{
                            label: 'Weather Data',
                            data: [5, 10, 13, 12, 8, 2],  // Y-As
                            backgroundColor: [
                                'rgba(157, 219, 250, 0.4)',
                            ],
                            borderColor: [
                                'rgba(13, 105, 165, 10)',
                            ],
                            borderWidth: 1
                        },{
                            label: 'Weather Data',
                            data: [2, 8, 22, 28, 19, 55],  // Y-As
                            backgroundColor: [
                                'rgba(250, 172, 207, 0.4)',
                            ],
                            borderColor: [
                                'rgba(232, 0, 104, 10)',
                            ],
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        </script>
    </body>
</html>