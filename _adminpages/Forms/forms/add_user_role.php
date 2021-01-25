<?php
if (!$_SESSION['loggedin'] == 1|| !$_SESSION['IsAdmin'] == 1){
    header("location:index.php?page=auth&auth=AdminNoAccess");
} else {
    echo '
    <div id="adduserrole_form">
		<form method="post" action="../process/process_AddUserRole.php">
			'; if (isset($_GET['result'])){
				echo '<p style="color:red">' . $_GET['result'] . '</p>'; 
			} echo '
			<h1>Add a new user role</h1>
			<div id="inputadduserrole">
                <label>Role<span class="redStar">*</span></label>		        <input type="text" name="role" placeholder="Only use letters and numbers (max. 60)" pattern="[0-9a-Z\s-]{1,60}" size="40" required="">
                <label>Description<span class="redStar">*</span></label>		<input type="text" name="description" placeholder="Only use letters and numbers (max. 200)" pattern="[0-9a-Z\s-]{1,200}" size="40" required="">
			</div>
			<div id="submitadduserrole">
				<input type="submit" name="submit" value="submit">
			</div>
		</form>
    </div>
';
}
?>