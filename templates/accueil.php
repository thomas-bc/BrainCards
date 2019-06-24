<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=accueil");
    die("");
}

?>


<h1>Accueil</h1>

<p>BrainCards est un site de Brainstorming à Distance. Il permet à l’organisateur du Brainstorming (le
    « Master » ) de faire respecter les différents temps du Brainstorming. Il permet également d’afficher les
    traditionnels « Post-it » sous une forme différente, plus complète et plus à même d’alimenter
    l’imagination des différents participant.</p>


<div id="formLogin">
    <form action="controleur.php" method="GET">
        Login : <input type="text" name="login" /><br />
        Passe : <input type="password" name="passe" /><br />
        <input type="submit" name="action" value="Connexion" />
    </form>
</div>


<div id="formLoginJoin">
    <form action="controleur.php" method="GET">
        Login : <input type="text" name="login" /><br />
        Passe : <input type="password" name="passe" /><br />
        Passe à nouveau : <input type="password" name="passe2" /><br />
        <input type="submit" name="action" value="Créer un compte" />
    </form>
</div>

<p id="mauvaiseCorrespondance">Les deux mots de passe ne correspondent pas</p>
<p id="pseudoDejaExistant">Le pseudo est déjà pris</p>
<p id="reussi">Votre comtpe a bien été crée ! Vous pouvez désormais vous connecter.</p>


<p>Pas encore inscrit ?</p>
<a href="index.php?view=join">Cliquez ici</a>
