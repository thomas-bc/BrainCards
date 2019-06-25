<?php

include_once ("libs/modele.php");
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=join");
    die("");
}


?>

<link rel="stylesheet" href="css/cssCommun.css">

<style>


    body{
        text-align: center;
    }

    h1{
        margin-bottom:30px;
    }

    #bienvenue{
        text-align: center;
        margin-top:25px;
    }


    #menuMesBrainstos{
        margin:auto;
        width:120px;
        padding:5px;
        margin-bottom:25px;


        text-align: center;
        background-color: white;
        color: #ED7D31;
        font-weight: bold;
        border-radius:5px;
    }

    #menuMesBrainstos:hover {
        cursor:pointer;
        background-color:#e5e5e5;
    }


    #mesBrainstos{
        margin:auto;
        padding:10px;
        background-color: #444444;
        color:white;
        width:50%;
        min-width:500px;
        max-height:325px;
        overflow:auto;
        display:none;

        border-radius: 10px;
    }

    #mesBrainstos ul{
        padding:0;

    }

    #mesBrainstos ul li{
        display:block;
        margin-bottom:5px;
        border-radius: 5px;
        padding:5px;
        color:#444444;
        background-color: white;

    }

    #formJoin{
        margin-top:0;
    }

    h3{
        display: inline-block;
        margin-bottom:0;
    }

    #textInputCodeBrainsto{
        width:50%;
        margin-right:15px;
        border-radius: 5px;
        padding:5px 10px;
        border:none;
    }

    #btnNouveauBrainsto{
        background-color: white;
        color: #ED7D31;
        width:40px;
        height: 40px;
        padding:0;
        margin:auto;
        font-size:3em;
        line-height:40px;
        border-radius: 30px;
    }

    #btnNouveauBrainsto{
        cursor:pointer;
        background-color:#e5e5e5;
    }



    #formAjoutBrainsto{
        display:block;
    }


    #formAjoutBrainsto textarea{
        height:50px;
        width:400px;
        border:1px solid white;
        color:white;
        border-radius:5px;
        margin-top:10px;

    }

    #formAjoutBrainsto h3{
        display:block;
    }

    #formAjoutBrainsto .button{
        margin-top:15px;
    }

</style>

<!-- PARTIE HEADER -->

<h1>Braincards</h1>


<!-- FIN PARTIE HEADER -->



<!-- PARTIE "MES BRAINSTOS" -->

<div id="menuMesBrainstos">Mes Brainstos </div>

<div id="mesBrainstos">

    <p id="aucunBrainsto">Désolé, pour le moment
        vous n'avez participé à aucun brainsto</p>

    <ul id="listeMesBrainstos">
        <li>brainsto 1</li>
        <li>brainsto 2</li>

    </ul>
    <!-- Ici on ajoutera tous les brainstormings liés à un utilisateur -->

</div>

<!-- FIN PARTIE "MES BRAINSTOS" -->

<p id="bienvenue">Bienvenue !</p>


<!-- PARTIE REJOINDRE UN BRAINSTO GRACE AU CODE BRAINSTO -->

<div id="formJoin">
    <form action="controleur.php" method="GET">
        <h3>Code Brainsto :</h3>
        <input id="textInputCodeBrainsto"type="text" name="codeBrainsto" />
        <input class="button" id="btnInputCodeBrainsto" type="submit" name="action" value="Rejoindre" />
    </form>
</div>

<p id="mauvaisCode"> Veuillez rentrer un code Brainsto valide</p>

<!-- FIN PARTIE REJOINDRE UN BRAINSTO GRACE AU CODE -->



<!-- PARTIE CREER UN BRAINSTO -->

<div id="btnNouveauBrainsto">+
</div>

<div id="formAjoutBrainsto">
    <form action="controleur.php" method="GET">

        <h3>Titre du Brainsto :</h3>
        <input class="textInput" type="text" name="titreBrainsto" />

        <br>

        <h3>Description :</h3>

        <textarea class="textInput" form="formAjoutBrainsto" name="descriptionBrainsto">

        </textarea>

        <br>

        <input class="button" type="submit" name="action" value="Créer le Brainsto" />

    </form>
</div>

<!-- FIN PARTIE CREER UN BRAINSTO -->

