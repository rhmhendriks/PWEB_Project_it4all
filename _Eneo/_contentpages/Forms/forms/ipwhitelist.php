<?php
/**
 * The ipwhitelist file displays the ip-whitelist form.
 * 
 * @author Rienan Poortvliet
 * @version 2.0
 */

/* IsAdmin should be IsEneo or IsEneoAdmin */
//if (!$_SESSION['loggedin'] == 1|| !$_SESSION['IsAdmin'] == 1){ 
    //header("location:index.php?page=auth&auth=AdminNoAccess");
//} else {
    echo '
    <div id="general_form">
		<form method="post" action="../process/process_IPWhitelist.php">
			'; if (isset($_GET['result'])){
				echo '<p style="color:red">' . $_GET['result'] . '</p>'; 
			} echo '
			<h1>Whitelist a new IP address</h1>
			<div id="inputgeneral">
                <label>IP address<span class="redStar">*</span></label>		    <input type="text" name="ipaddress" placeholder="Use numbers seperated by dots, like 0.0.0.0 (max. 255 per section)" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$" size="40" required=""> '; /* should be changed to digits */ echo '
                <label>Reason<span class="redStar">*</span></label>		        <input type="text" name="reason" placeholder="Only use letters and numbers (max. 200)" pattern="[0-9a-Z\s-]{1,200}" size="40" required="">
                <label>Valid until<span class="redStar">*</span></label>        <input type="date" name="validuntil" placeholder="Fill in the the validation date (max. 3 months forward from registration)" pattern="[0-9a-Z\s-]{1,200}" size="40" required=""> '; /*Should be changed to a date max 3 months later */ echo '
			</div>
			<div id="submitgeneral">
				<input type="submit" name="submit" value="submit">
			</div>
		</form>
    </div>
';
//}
?>