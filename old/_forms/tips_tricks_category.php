<form method="post" action="../_php/formulieren/process_TipTrickCategory.php">
	<fieldset>

		<legend><h1>Tips en tricks category</h1></legend> <!-- titel in de header -->
		<br>

		<?php if (isset($_GET['result'])){
			echo '<p style="color:red">' . $_GET['result'] . '</p>'; 
		} ?>

		<br>

		<pre>Category titel	<input type="text" name="categorytitel" placeholder="vul hier de category titel in" size="40" required=""></pre>
		
		<pre>Bevestigen:	<input type="submit" name="submit" value="verzenden"></pre>

	</fieldset>
</form>
