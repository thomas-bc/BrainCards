<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=lobby");
    die("");
}

?>


<h1>Lobby</h1>

<p id="nomMaster"></p>


<ul id="participants">
</ul>


<div id="formBtn">
    <form action="controleur.php" method="GET">
        <input type="submit" name="action" value="I'm Ready !" />
        <input type="submit" name="action" value="Lancer le Brainsto" />
    </form>
</div>



