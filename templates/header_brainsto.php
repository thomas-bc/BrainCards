<?php
// Si la page est appelée directement par son adresse, on redirige vers la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php");
    die("");
}

?>


<p id="codeBrainsto"></p>

<h1 id="titreBrainsto"></h1>
