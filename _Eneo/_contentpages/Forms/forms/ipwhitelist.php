<?php /* IsAdmin should be IsEneo or IsEneoAdmin */
//if (!$_SESSION['loggedin'] == 1|| !$_SESSION['IsAdmin'] == 1){ 
    //header("location:index.php?page=auth&auth=AdminNoAccess");
//} else {
    echo '
    <div id="ipwhitelist_form">
		<form method="post" action="../process/process_IPWhitelist.php">
			'; if (isset($_GET['result'])){
				echo '<p style="color:red">' . $_GET['result'] . '</p>'; 
			} echo '
			<h1>Whitelist a new IP address</h1>
			<div id="inputipwhitelist">
                <label>IP address<span class="redStar">*</span></label>		    <input type="text" name="ipaddress" placeholder="Only use numbers (max. 12)" pattern="[0-9]{1,12}" size="40" required=""> '; /* should be changed to digits */ echo '
                <label>Reason<span class="redStar">*</span></label>		        <input type="text" name="reason" placeholder="Only use letters and numbers (max. 200)" pattern="[0-9a-Z\s-]{1,200}" size="40" required="">
                <label>Valid until<span class="redStar">*</span></label>        <input type="text" name="validuntil" placeholder="Only use letters and numbers (max. 200)" pattern="[0-9a-Z\s-]{1,200}" size="40" required=""> '; /*Should be changed to a date max 3 months later */ echo '
			</div>
			<div id="submitipwhitelist">
				<input type="submit" name="submit" value="submit">
			</div>
		</form>
    </div>
';
//}
?>