 <?php
 if (!$_SESSION['loggedin'] == 1|| !$_SESSION['IsAdmin'] == 1){
    header("location:index.php?page=auth&auth=AdminNoAccess");
} else {
	echo '
<div id="tipstrickscategory_form">
	<form method="post" action="../process/process_TipTrickCategory.php">
		'; if (isset($_GET['result'])){
			echo '<p style="color:red">' . $_GET['result'] . '</p>'; 
		} echo '
		<h1> Tips en tricks category </h1>
		<div id ="tipstrickscategorygegevens">
			<label>Category titel</label>				<input type="text" name="categorytitel" placeholder="vul hier de category titel in" size="40" required="">
		</div>
		<div id="submittipstrickscategory_form">
			<input type="submit" name="submit" value="verzenden">
		<div>
	</form>
</div>
';
}
?>