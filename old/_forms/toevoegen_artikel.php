<!-- 	Geschreven door: Luc Willemse
		Gaat over: formulier, toevoegen Artikel.
		Laatste update: 16:48, 21-10-2019
-->
<form method="post" action="../_php/formulieren/process_newarticle.php" enctype="multipart/form-data">
	<fieldset>

		<legend><h1>Toevoegen Artikel</h1></legend> <!-- titel in de header -->
		<br>

		<?php if (isset($_GET['result'])){
			echo '<p style="color:red">' . $_GET['result'] . '</p>'; 
		} ?>

		<br>

		<pre>Artikel naam:			<input type="text"		name="artikelnaam"		id="artikelnaam"	size="40" 	placeholder="Vul hier de artikel naam in" 	enctype="multipart/form-data" required=""></pre>
		<pre>Artikel omschrijving:	<textarea rows="5" 		cols="50" name="artikelomschrijving" 	placeholder="Vul hier de artikel omschrijving in" 	id="artikelomschrijving" required=""></textarea></pre><!--invoer veld artikel omschrijving-->
		<pre>Artikelgroep:			<?php $resultoffunction=MySqlDo_DropDown('GroupTitle', 'ArticleGroups', 'Articlegroup'); echo $resultoffunction['optionfield']; ?> </pre>
		<pre>Aantal Artikel:			<input type="number" 	name="aantalartikel" size="40" placeholder="Vul hier het aantal artikelen in" 	id="aantalartikel" required=""></pre><!--invoer veld aantal artikelen-->
		<pre>Verkoopprijs: 		 &euro;	<input type="text" 		name="verkoopprijs"	size="40" placeholder="Vul hier de verkoopprijs in" 	id="verkoopprijs" 				pattern="[0-9 _,]*" required=""></pre><!--invoer veld verkoopprijs-->
		<pre>Inkoopprijs:		 &euro;	<input type="text" 		name="inkoopprijs"	size="40" placeholder="Vul hier de inkoopprijs in" 	id="inkoopprijs" 					pattern="[0-9 _,]*"	required=""></pre><!--invoer veld inkoopprijs-->
		<pre>Afbeeldingen:			<input type="file" 		name="foto"				id="foto" multiple></pre><!--invoer veld foto-->
		
		<pre><h3>Bevestigen: <input type="submit" name="submit" value="Artikel Toevoegen"></h3></pre>

	</fieldset>
</form>