<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Recensie</title>
  <?php 
    require "../_init/initialize.php";
  ?>
</head>
<body>

<?php 

  if (isset($_GET['page'])) {
    if (CheckValue($_GET['page']) == "article") {
      $article = CheckValue($_GET['ID']);
    } elseif (CheckValue($_GET['page']) == "TipTrick") {
        $TipTrick = CheckValue($_GET['ID']);
      }
  }

?>

<form method="post" action="">
  <fieldset>
    <legend><h1>Recensie</h1></legend>

    <pre>Naam(eventueel):  <input type="text" name="naam" size="40" placeholder="vul hier uw naam in" value=<?php if (isset($_SESSION['FirstName']) &&  isset($_SESSION['LastName'])) {
                                                                                                                    echo '"' . $_SESSION['FirstName'] . $_SESSION['LastName'] . '"' . 'disabled required';
                                                                                                                  } else { 
                                                                                                                      echo '""' . ' ' . "required";
                                                                                                                    }
                                                                                                            ?>>
  </pre>
    <pre>Titel:<span class="redStar">*</span>           <input type="text" name="titel" size="40" placeholder="vul hier de titel in" required=""></pre>
    <pre>Recensie:<span class="redStar">*</span>        <textarea rows="5" cols="50" name="Recensie"  placeholder="Vul hier uw Recensie in" required=""></textarea></pre>

<p>
  <div class="rate">
    <input type="radio" id="star5" name="rate" value="5" />
    <label for="star5" title="text">5 stars</label>
    <input type="radio" id="star4" name="rate" value="4" />
    <label for="star4" title="text">4 stars</label>
    <input type="radio" id="star3" name="rate" value="3" />
    <label for="star3" title="text">3 stars</label>
    <input type="radio" id="star2" name="rate" value="2" />
    <label for="star2" title="text">2 stars</label>
    <input type="radio" id="star1" name="rate" value="1" />
    <label for="star1" title="text">1 star</label>
  </div>
 </p>
 <br>
 <br>
 <br>

<pre>Klant ID: <input type="hidden" name="klantID" value=<?php if (isset($_SESSION['CustomerID'])) {
                                                                    echo '"'. $_SESSION['CustomerID'] . '"';
                                                                    } else {
                                                                      echo '""';
                                                                    }
                                                                   ?>>
</pre>
<pre>Artikel ID: <input type="hidden" name="klantID" value=<?php if (isset($_SESSION['ArtikelID'])) {
                                                                    echo '"'. $article . '"';
                                                                    } else {
                                                                      echo '""';
                                                                    }
                                                                    ?>>
</pre>
<pre>Artikel ID: <input type="hidden" name="klantID" value=<?php if (isset($_SESSION['TipTrickID'])) {
                                                                    echo '"'. $TipTrick . '"';
                                                                    } else {
                                                                      echo '""';
                                                                    }
                                                                    ?>>
</pre>
<pre>Plaats: <input type="submit" name="Plaats" value="Plaats"></pre>

</fieldset>
</form>

</body>
</html>