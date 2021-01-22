<?php
class API {
    private $connect = '';
    
    function __construct() {
        $this->dbConnection();
    }

    function dbConnection() {
        $this->connect = new PDO("mysql:host=localhost:3306;dbname=IT4all NEW", "it4alldbuser", "It4llit4all2019!"); # Databasename, username and password haven't been specified yet.
    }

    function outputData() {
        $select = $this->connect->prepare("SELECT * FROM to_do ORDER BY id");
        if($select->execute()) {
            while($row = $select->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
    }
}

?>