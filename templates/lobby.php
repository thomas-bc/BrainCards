<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=lobby");
    die("");
}

?>


<h1>Lobby</h1>

<p id="codeBrainsto"></p>

<h1 id="titreBrainsto"></h1>

<p id="nomMaster"></p>





