<?php
 /**
 * The author_toevoegen file adds a new author.
 * 
 * @author Rienan Poortvliet and Jurre de Vries
 * @version 2.0
 */
 if (!$_SESSION['loggedin'] == 1|| !$_SESSION['IsAdmin'] == 1){
    header("location:index.php?page=auth&auth=AdminNoAccess");
} else {
	echo '
<div id="author_form">
	<form method="post" action="../process/process_newauthor.php">
			'; if (isset($_GET['result'])){
				echo '<p style="color:red">' . $_GET['result'] . '</p>'; 
			} echo '
			<h1>Een nieuwe auteur aanmaken</h1>
			<div id="AuteursGegevens">
				<label>Voornaam<span class="redStar">*</span></label>		<input type="text" name="voornaam" placeholder="Vul hier alleen kleine- en grote letters in"	size="40"	pattern="[a-zA-Z\s- ]{1,65}" required="">
				<label>Achternaam<span class="redStar">*</span></label>		<input type="text" name="achternaam" placeholder="Vul hier alleen kleine- en grote letters in"	size="40"	pattern="[a-zA-Z\s-]{1,65}" required="">
				<label>Login ID<span class="redStar">*</span></label>	 	<input type="email" name="loginid" placeholder="Vul een geldig emailadres in"	size="40" pattern="[a-Z0-9._-]+@[a-Z0-9.-]+\.[a-Z]{2,}$" required="">
			</div>
			<div id="submitauthor_form">
				<input type="submit" name="submit" value="verzenden">
			</div>
	</form>
</div>
';
}
?>