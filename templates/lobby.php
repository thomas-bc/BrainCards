<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=lobby");
    die("");
}

    include("templates/chat.php");
?>

<link rel="stylesheet" href="css/cssCommun.css">


<p id="nomMaster"></p>

<p id="descriptionBrainsto"></p>



<ul id="participants">
</ul>


<div id="formBtn">
    <form action="controleur.php" method="GET">

        <h3>Nombre de tours :</h3>
        <input type="text" name="nbTours" /><br />

        <h3>Temps par tour :</h3>
        <input type="text" name="tpsTour" /><br />

        <h3>Temps de relecture :</h3>
        <input type="text" name="tpsRelecture" /><br />

        <input type="submit" name="action" value="I'm Ready !" />
        <input id="launchBrainsto" type="submit" name="action" value="Lancer le Brainsto" />
    </form>
</div>



