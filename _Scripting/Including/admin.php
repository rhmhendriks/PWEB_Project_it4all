<?php

if(isset($_GET['admin'])) {
	$admin = CheckValue($_GET['admin']);
	include "_adminpages/$admin.php";
}
?>