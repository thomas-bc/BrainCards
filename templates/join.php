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
    Code Brainsto : <input type="text" name="codeBrainsto" /><br />
    <input type="submit" name="action" value="Rejoindre" />
    </form>
</div>

<p id="mauvaisCode"> Veuillez rentrer un code Brainsto valide</p>


<div id="divNouveauBrainsto">
    <button id="btnNouveauBrainsto">+</button>
</div>

<div id="formAjoutBrainsto">
    <form action="controleur.php" method="GET">
        Titre du Brainsto : <input type="text" name="titreBrainsto" /><br />
        Nombre de participants : <input type="text" name="nombreParticipantsBrainsto" /><br />
        Description : <input type="text" name="descriptionBrainsto" /><br />
        <input type="submit" name="action" value="Créer le Brainsto" />
    </form>

</div>

