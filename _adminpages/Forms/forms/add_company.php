<?php
if (!$_SESSION['loggedin'] == 1|| !$_SESSION['IsAdmin'] == 1){
    header("location:index.php?page=auth&auth=AdminNoAccess");
} else {
    echo '
    <div id="addcompany_form">
		<form method="post" action="../process/process_AddCompany.php">
			'; if (isset($_GET['result'])){
				echo '<p style="color:red">' . $_GET['result'] . '</p>'; 
			} echo '
			<h1>Add a new company</h1>
			<div id="inputaddcompany">
				<label>Company<span class="redStar">*</span></label>		        <input type="text" name="company" placeholder="Give the name of the company" pattern="[0-9a-Z\s-]{1,60}" size="40" required="">
				<label>Description<span class="redStar">*</span></label>			<textarea id="description" rows="4" cols="100" maxlength="200" placeholder="Give a description of the new company" required=""></textarea>
			</div>
			<div id="submitaddcompany">
				<input type="submit" name="submit" value="submit">
			</div>
		</form>
    </div>
';
}
?>