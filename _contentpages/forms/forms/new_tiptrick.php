
<!--

The author of this file is Ronald HM Hendriks
This file is created on 20/10/2019 at 16:25 AM

Last updated by Ronald HM Hendriks
Last updated on 27/10/2019 at 3:01 PM

 -->
  <?php
 if (!$_SESSION['loggedin'] == 1|| !$_SESSION['IsAdmin'] == 1){
    header("location:index.php?page=auth&auth=AdminNoAccess");
} else {
	echo '
<div id="tiptrick_form">
	<form method="post" action="../process/process_NewTipTrick.php" enctype="multipart/form-data">
			'; if (isset($_GET['result'])){
				echo '<pre><p style="color:red">' . $_GET['result'] . '</p></pre>'; 
			} echo '
			<h1> Tip of tricks toevoegen </h1>
			<div id="tiptrickgegevens">
				<label>Pagina titel<span class="redStar">*</span></label>			<input 	type="text" 	name="paginatitel" pattern="[a-zA-Z\s-]{1,32}"	placeholder="Alleen letters en spaties" 		size="40" 	required="">
				<label>Datum<span class="redStar">*</span></label>					<input 		type="date" 	name="datum" 		placeholder="vul hier de datum in" 							required="">
				<label>Auteur<span class="redStar">*</span></label>					'; $resultoffunction=MySqlDo_DropDown('FirstName', 'Authors', 'Authorname'); echo $resultoffunction['optionfield']; echo '
				<label>Categorie<span class="redStar">*</span><label>				'; $resultoffunction=MySqlDo_DropDown('CategoryTitle', 'TipsTricksCategory', 'categorie'); echo $resultoffunction['optionfield']; echo '
				<label>Inhoud<span class="redStar">*</span></label>					<textarea id="inhoud" name="inhoud" rows="30" cols="100">Hier komt de inhoud....</textarea>
				<label>Bron<span class="redStar">*</span></label>					<textarea id="bron" name="bron" rows="4" cols="45">De bronnen (1 per regel, gescheiden met ,)</textarea>
				<label>Foto of video</label>										<input 	type="file"		name="fotoofvideo" 	placeholder="voeg hier de foto of video toe" 	size="40" >
			</div>
			<div id="submittiptrick_form">
				<input 	type="submit" 	name="submit" 		value="verzenden">
			</div>
	</form>
</div>
';
}
?>