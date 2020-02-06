<div id="artikelgroep_form">
		<form method="post" action="../_php/formulieren/process_ArtikelGroep.php">
			<?php if (isset($_GET['result'])){
				echo '<p style="color:red">' . $_GET['result'] . '</p>'; 
			} ?>
			<h1>Nieuwe artikelgroep toevoegen</h1>
			<div id="artikelgroep_toevoegen">
				<label>Groeptitel<span class="redStar">*</span></label>		<input type="text" name="groepstitel" placeholder="Alleen letters en getallen (max. 60)" pattern="[0-9a-Z\s-]{1,60}" size="40" required="">
			</div>
			<div id="submitartikelgroep_toevoegen">
				<input type="submit" name="submit" value="verzenden">
			</div>
		</form>
</div>