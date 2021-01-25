<?php /* IsAdmin should be IsEneo or IsEneoAdmin */
if (!$_SESSION['loggedin'] == 1|| !$_SESSION['IsAdmin'] == 1){
    header("location:index.php?page=auth&auth=AdminNoAccess");
} else {
    echo '
    <div id="retrieveapiurl_form">
		<form method="post" action="../process/process_RetrieveAPIURL.php">
			'; if (isset($_GET['result'])){
				echo '<p style="color:red">' . $_GET['result'] . '</p>'; 
			} echo '
			<h1>Retrieve an API URL?</h1>
			<div id="inputretrieveapiurl">
                <label>Reason<span class="redStar">*</span></label>		            <input type="text" name="reason" placeholder="Only use letters and numbers (max. 200)" pattern="[0-9a-Z\s-]{1,200}" size="40" required="">
                <label>Valid until<span class="redStar">*</span></label>            <input type="text" name="validuntil" placeholder="Only use letters and numbers (max. 200)" pattern="[0-9a-Z\s-]{1,200}" size="40" required=""> '; /*Should be changed to a date max 3 months later */ echo '
			</div>
			<div id="submitretrieveapiurl">
				<input type="submit" name="submit" value="check IP">
			</div>
		</form>
    </div>
';
}
?>