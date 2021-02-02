<html>
    <head>
        <title>Learn Make Graphic with PHP</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
        <style type="text/css">
            .container {
                width: 60%;
                margin: 1px auto;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <canvas id="myChart" width="100" height="80"></canvas>
        </div>
        <script>
            <?php
                /**
                 * The index file shows the graph to the website.
                 * 
                 * @author Jurre de Vries, Luc Willemse and Ronald H.M. Hendriks
                 * @version 2.0
                 */

                // Get data from database
                // Make a logical datum partition

                $labels = '["' . $value;
                $value = '["' . $value;            
            
            ?> 
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["1", "2", "3", "4", "5", "6"], // X axis
                    datasets: [{
                            label: 'Weather Data',
                            data: <?php echo $data1; ?>[5, 10, 13, 12, 8, 2],  // Y axis
                            backgroundColor: [
                                'rgba(157, 219, 250, 0.4)',
                            ],
                            borderColor: [
                                'rgba(13, 105, 165, 10)',
                            ],
                            borderWidth: 1
                        },{
                            label: 'None',
                            data: [],  // Y axis
                            backgroundColor: [
                                'rgba(250, 172, 207, 0.4)',
                            ],
                            borderColor: [
                                'rgba(232, 0, 104, 10)',
                            ],
                            borderWidth: 1
                        },{
                            label: 'None',
                            data: [],  // Y axis
                            backgroundColor: [
                                'rgba(57, 92, 50, 0.2)',
                            ],
                            borderColor: [
                                'rgba(13, 69, 1, 10)',
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