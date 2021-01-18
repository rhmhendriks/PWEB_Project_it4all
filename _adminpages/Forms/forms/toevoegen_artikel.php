<!-- 	Geschreven door: Luc Willemse
		Gaat over: formulier, toevoegen Artikel.
		Laatste update: 20:19, 12-11-2019.
		Door: Rienan Poortvliet.
-->
<?php
 if (!$_SESSION['loggedin'] == 1|| !$_SESSION['IsAdmin'] == 1){
    header("location:index.php?page=auth&auth=AdminNoAccess");
} else {
	echo '
<div id ="toevoegen_artikel_form">
	<form method="post" action="../process/process_newarticle.php" enctype="multipart/form-data">
		'; if (isset($_GET['result'])){
			echo '<p style="color:red">' . $_GET['result'] . '</p>'; 
		} echo '
		<h1> Toevoegen artikel </h1>
		<div id="artikelgegevens">
			<label>Artikel naam</label>				<input type="text"		name="artikelnaam"		id="artikelnaam"	size="40" 	placeholder="Vul hier de artikel naam in" 	enctype="multipart/form-data" required="">
			<label>Artikel omschrijving</label>		<textarea rows="5" 		cols="50" name="artikelomschrijving" 	placeholder="Vul hier de artikel omschrijving in" 	id="artikelomschrijving" required=""></textarea><!--invoer veld artikel omschrijving-->
			<label>Artikelgroep</label>				'; $resultoffunction=MySqlDo_DropDown('GroupTitle', 'ArticleGroups', 'Articlegroup'); echo $resultoffunction['optionfield']; echo '
			<label>Aantal Artikel</label>			<input type="number" 	name="aantalartikel" size="40" placeholder="Vul hier het aantal artikelen in" 	id="aantalartikel" required=""><!--invoer veld aantal artikelen-->
			<label>Verkoopprijs</label>		 		&euro;	<input type="text" 		name="verkoopprijs"	size="40" placeholder="Vul hier de verkoopprijs in" 	id="verkoopprijs" 				pattern="[0-9 _,]*" required=""><!--invoer veld verkoopprijs-->
			<label>Inkoopprijs</label>				&euro;	<input type="text" 		name="inkoopprijs"	size="40" placeholder="Vul hier de inkoopprijs in" 	id="inkoopprijs" 					pattern="[0-9 _,]*"	required=""><!--invoer veld inkoopprijs-->
			<label>Afbeeldingen</label>				<input type="file" 		name="foto"				id="foto" multiple><!--invoer veld foto-->
		</div>
		<div id="submittoevoegen_artikel_form">
			<input type="submit" name="submit" value="Artikel Toevoegen">
		</div>
	</form>
</div> ';
}
?>