<?php
/**
 * The ipwhitelistcheck file displays the ip-whitelist check form, which checks if an user has a valid IP address.
 * 
 * @author Rienan Poortvliet
 * @version 2.0
 */

/* IsAdmin should be IsEneo or IsEneoAdmin */
//if (!$_SESSION['loggedin'] == 1|| !$_SESSION['IsAdmin'] == 1){
  //  header("location:index.php?page=auth&auth=AdminNoAccess");
//} else {
    echo '
    <div id="general_form">
		<form method="post" action="../process/process_IPWhitelistCheck.php">
			'; if (isset($_GET['result'])){
				echo '<p style="color:red">' . $_GET['result'] . '</p>'; 
			} echo '
			<h1>Check if an IP is whitelisted</h1>
			<div id="inputgeneral">
                <label>IP address<span class="redStar">*</span></label>		<input type="text" name="ipaddress" placeholder="Fill in the IP address" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$" size="40" required="">
			</div>
			<div id="submitgeneral">
				<input type="submit" name="submit" value="check IP">
			</div>
		</form>
    </div>
';
//}
?>