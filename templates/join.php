<?php

include_once ("libs/modele.php");
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=join");
    die("");
}


?>

<!-- PARTIE HEADER -->

<h1>Braincards</h1>

<p id="bienvenue"></p>

<!-- FIN PARTIE HEADER -->



<!-- PARTIE "MES BRAINSTOS" -->

<div id="menuMesBrainstos">Mes Brainstos </div>

<div id="mesBrainstos">

    <h1>Mes Brainstos</h1>
    <ul id="listeMesBrainstos">
    </ul>
    <!-- Ici on ajoutera tous les brainstormings liés à un utilisateur -->

</div>

<!-- FIN PARTIE "MES BRAINSTOS" -->



<!-- PARTIE REJOINDRE UN BRAINSTO GRACE AU CODE BRAINSTO -->

<div id="formJoin">
    <form action="controleur.php" method="GET">
        <h3>Code Brainsto :</h3>
        <input type="text" name="codeBrainsto" /><br />
        <input type="submit" name="action" value="Rejoindre" />
    </form>
</div>

<p id="mauvaisCode"> Veuillez rentrer un code Brainsto valide</p>

<!-- FIN PARTIE REJOINDRE UN BRAINSTO GRACE AU CODE -->



<!-- PARTIE CREER UN BRAINSTO -->

<div id="divNouveauBrainsto">
    <button id="btnNouveauBrainsto">+</button>
</div>

<div id="formAjoutBrainsto">
    <form action="controleur.php" method="GET">

        <h3>Titre du Brainsto :</h3>
        <input type="text" name="titreBrainsto" /><br />

        <h3>Description :</h3>
        <input type="text" name="descriptionBrainsto" /><br />

        <input type="submit" name="action" value="Créer le Brainsto" />

    </form>
</div>

<!-- FIN PARTIE CREER UN BRAINSTO -->

