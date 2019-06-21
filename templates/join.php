<?php

include_once ("libs/modele.php");
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=join");
    die("");
}

//test des fonctions du modele.php
$res=inscrireUser('ajout', 'deux');
echo "$res";
//

?>

<hr/>
<h1>Join</h1>

