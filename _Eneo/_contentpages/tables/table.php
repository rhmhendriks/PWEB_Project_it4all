<!DOCTYPE html>
<html>
<!-- 
    Author: Luc Willemse
-->
<body>

<?php 

// hier moet de goeie json in worden geladen. met value[1] bedoel ik dan hier de temp pakt
$temp = json; 

$lowest = null;
$highest = null;
$total = 0;

foreach ($temp as $value) {
    if($value[1] == "T"){
        $total += $value[1];
        if($value[1] < $lowest) {
            $lowest = $value[1];
        }
        elseif($value[1] > $highest) {
            $highest = $value[1];
        }
    }
}

$average = $total / $temp.size();
?>

</body>
</html>

