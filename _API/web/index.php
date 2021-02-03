<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container" style="margin-top: 30px;">
        <h3 align="center" style="margin-bottom: 20px;">Lijst</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Columntest</th>
                    <th scope="col">Columntest</th>
                    <th scope="col">Columntest</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <script>
        $<document>.ready(function(){

            outputData();
            
            function outputData(){
                $.ajax({
                    url: "output.php";
                    succes:function(data){
                        $('tbody').html(data);
                    }
                })
            }
        });
    </script>
</body>
</html>