<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=step_final");
    die("");
}

?>

<link rel="stylesheet" href="css/cssCommun.css">


<h1>Step_final</h1>