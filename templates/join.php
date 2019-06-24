<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=join");
    die("");
}

?>


<h1>Join</h1>

<p id="bienvenue"></p>

<div id="formMesBrainsto"
    <form action="controleur.php" method="GET">
    <input type="submit" name="action" value="Mes Brainsto's" />
    </form>
</div>

<div id="formJoin">
    <form action="controleur.php" method="GET">
    Code Brainsto : <input type="text" name="code" /><br />
    <input type="submit" name="action" value="Rejoindre" />
    </form>
</div>

<p id="mauvaisCode"> Veuillez rentrer un code Brainsto valide</p>

<div id="btnNouveauBrainsto">
    <form action="controleur.php" method="GET">
        <input type="submit" name="action" value="+" />
    </form>
</div>

