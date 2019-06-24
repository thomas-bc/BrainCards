<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=join");
    die("");
}

?>


<h1>Join</h1>

<p>BrainCards est un site de Brainstorming à Distance. Il permet à l’organisateur du Brainstorming (le
    « Master » ) de faire respecter les différents temps du Brainstorming. Il permet également d’afficher les
    traditionnels « Post-it » sous une forme différente, plus complète et plus à même d’alimenter
    l’imagination des différents participant.</p>


<div id="formLoginJoin">
    <form action="controleur.php" method="GET">
        Login : <input type="text" name="login" /><br />
        Passe : <input type="password" name="passe" /><br />
        Passe à nouveau : <input type="password" name="passe2" /><br />
        <input type="submit" name="action" value="Créer un compte" />
    </form>
</div>