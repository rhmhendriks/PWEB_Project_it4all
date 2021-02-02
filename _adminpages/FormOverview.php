<?php
/**
 * The FormOverview file shows an overview of the available forms.
 * 
 * @author Rienan Poortvliet, Jurre de Vries, Luc Willemse and Ronald H.M. Hendriks
 * @version 2.0
 */
 if (!$_SESSION['loggedin'] == 1|| !$_SESSION['IsAdmin'] == 1){
    header("location:index.php?page=auth&auth=AdminNoAccess");
} else {
	echo '
	<h1 class="formovertitle">Formulieren en overzichten</h1>
<div id="adminlist">
	<div id="formulierenlist">
		<h2>Formulieren</h2>
		<a href="https://it4all.rhmhendriks.nl/index.php?inc=y&formtype=admin&page=forms&form=add_company">Add a company</a>
		<a href="https://it4all.rhmhendriks.nl/index.php?inc=y&formtype=admin&page=forms&form=add_user_role">Add a user role</a>
		<a href="https://it4all.rhmhendriks.nl/index.php?inc=y&formtype=admin&page=forms&form=toevoegen_artikel">Artikel toevoegen</a>
		<a href="https://it4all.rhmhendriks.nl/index.php?inc=y&formtype=admin&page=forms&form=admin_form">Admin toevoegen</a>
		<a href="https://it4all.rhmhendriks.nl/index.php?inc=y&formtype=admin&page=forms&form=toevoegen_klant">Klant toevoegen</a>
		<a href="https://it4all.rhmhendriks.nl/index.php?inc=y&formtype=admin&page=forms&form=tips_tricks_category">Tip-trick categorie toevoegen</a>
		<a href="https://it4all.rhmhendriks.nl/index.php?inc=y&formtype=admin&page=forms&form=new_tiptrick">Tip trick toevoegen</a>
		<a href="https://it4all.rhmhendriks.nl/index.php?inc=y&formtype=admin&page=forms&form=contactformulier">Contactformulier</a>
		<a href="https://it4all.rhmhendriks.nl/index.php?inc=y&formtype=admin&page=forms&form=author_toevoegen">Auteur toevoegen</a>
		<a href="https://it4all.rhmhendriks.nl/index.php?inc=y&formtype=admin&page=forms&form=artikelgroep_toevoegen">Artikelgroep toevoegen</a>
		<a href="https://it4all.rhmhendriks.nl/index.php?inc=y&formtype=admin&page=auth&auth=ForgotPassword">Wachtwoord vergeten?</a>
		<a href="https://it4all.rhmhendriks.nl/index.php?inc=y&formtype=admin&page=auth&auth=SignUp">Registreren</a>
		<a href="https://it4all.rhmhendriks.nl/index.php?inc=y&formtype=admin&page=auth&auth=Activate">Activeer je account</a>
		<a href="https://it4all.rhmhendriks.nl/index.php?inc=y&formtype=admin&page=auth&auth=RenewActivation">Opnieuw activeren </a>
		</div>
	<div id="overzichtenlist">
		<h2>Overzichten</h2>
		<a href="https://it4all.rhmhendriks.nl/index.php?inc=y&page=admin&admin=overview&overview=Article">Artikelenoverzicht</a>
		<a href="https://it4all.rhmhendriks.nl/index.php?inc=y&page=admin&admin=overview&overview=Customer">Klantenoverzicht</a>
		<a href="https://it4all.rhmhendriks.nl/index.php?inc=y&page=admin&admin=overview&overview=ArticleGroup">Artikelgroep weergeven</a>
		<a href="https://it4all.rhmhendriks.nl/index.php?inc=y&page=admin&admin=overview&overview=Author">Auteursoverzicht</a>
		<a href="https://it4all.rhmhendriks.nl/index.php?inc=y&page=admin&admin=overview&overview=Tip_Trick">Tip-trick overzicht</a>
		<a href="https://it4all.rhmhendriks.nl/index.php?inc=y&page=admin&admin=overview&overview=TipsGroup">Tip trick groep overzicht</a>
		<a href="https://it4all.rhmhendriks.nl/index.php?inc=y&page=admin&admin=overview&overview=User">Gebruikersoverzicht</a>
		<a href="https://it4all.rhmhendriks.nl/index.php?inc=y&page=admin&admin=overview&overview=Media">Media overzicht</a>
		<a href="https://it4all.rhmhendriks.nl/index.php?inc=y&page=admin&admin=overview&overview=Contactform">Contactformulier overzicht</a>
	</div>
</div>';}
?>