<?php

if(isset($_GET['statement'])) {
	$statement = CheckValue($_GET['statement']);
	include "_statements/$statement.php";
}
?>