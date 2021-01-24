<?php
class API {
    $connect = '';
    
    function __construct() {
        dbConnection();
    }

    function dbConnection() {
        $connect = new PDO("mysql:host=localhost:3306;dbname=unwdmi_ron", "java", "J@va2020!"); # Databasename needs to be specified with the table "Meting".
    }

    function outputData() {
        $select = $connect->prepare("SELECT * FROM Meting ORDER BY id"); // Moet aangepast worden
        if($select->execute()) {
            while($row = $select->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
    }
}

?>