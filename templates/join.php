<?php

include_once ("libs/modele.php");
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=join");
    die("");
}



// seul les utilisateurs connectés peuvent se rendre sur join
if( !($idUser = estConnecte()) ){
    header("Location:".dirname($_SERVER[PHP_SELF])."/index.php?view=accueil");
    die("");
}

//on clean les dernières sessions de brainsto
$_SESSION["idBrainstoCourant"] = null;

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

    #btnNouveauBrainsto:hover{
        cursor:pointer;
        background-color:#e5e5e5;
    }

    #mauvaisCode{
        color:#444444;
        font-weight: bold;
        display:none;
    }


    #formAjoutBrainsto{
        display:none;
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

<script src="js/jquery-3.4.1.js"></script>

<script>

    $(document).ready(function(){

        $("#menuMesBrainstos").click(function(){

            if ($("#mesBrainstos").css("display")!=="block"){
                $("#mesBrainstos").slideDown(500);

            }
            else{
                $("#mesBrainstos").slideUp(500);

            }

        });


        $("#btnNouveauBrainsto").click(function(){

            if ($("#formAjoutBrainsto").css("display")!=="block"){
                $("#formAjoutBrainsto").fadeIn(500);

            }
            else{
                $("#formAjoutBrainsto").fadeOut(500);

            }
        });
    })




</script>

<!-- PARTIE HEADER -->

<h1>Braincards</h1>


<!-- FIN PARTIE HEADER -->



<!-- PARTIE "MES BRAINSTOS" -->

<div id="menuMesBrainstos">Mes Brainstos </div>

<div id="mesBrainstos">

    <p id="aucunBrainsto">Désolé, pour le moment
        vous n'avez participé à aucun brainsto</p>

    <ul id="listeMesBrainstos">
        <?php
        $tab_brainsto = getMesBrainstorms($_SESSION["idUser"]); //On récupère les brainstorms de l'user courant dans une table $tab_brainsto
        foreach ($tab_brainsto as $brainsto){
                echo "<li> <a href='controleur.php?action=versStep'>" . $brainsto["br_titre"] . "</a>
                <p>" . "code (" . $brainsto["br_code"] . ")" . "</p></li>"; //on affiche les brainsto de l'utilisateur
            }
        ?>

    </ul>
    <!-- Ici on a ajouté tous les brainstormings liés à un utilisateur -->

</div>

<!-- FIN PARTIE "MES BRAINSTOS" -->

<p id="bienvenue">Bienvenue !</p>


<!-- PARTIE REJOINDRE UN BRAINSTO GRACE AU CODE BRAINSTO -->

<div id="formJoin">
    <form action="controleur.php" method="GET">
        <h3>Code Brainsto :</h3>
        <input id="textInputCodeBrainsto" type="text" name="codeBrainsto" />
        <input class="button" id="btnInputCodeBrainsto" type="submit" name="action" value="Rejoindre" />
    </form>
</div>

<p id="mauvaisCode"> Veuillez rentrer un code Brainsto valide</p>

<!-- FIN PARTIE REJOINDRE UN BRAINSTO GRACE AU CODE -->



<!-- PARTIE CREER UN BRAINSTO -->

<div class="button"  id="btnNouveauBrainsto">+
</div>

<div id="formAjoutBrainsto">
    <form action="controleur.php" method="GET">

        <h3>Titre du Brainsto :</h3>
        <input class="textInput" type="text" name="titreBrainsto" />

        <br>

        <h3>Description :</h3>

        <textarea class="textInput" name="descriptionBrainsto"></textarea>

        <br>

        <input class="button" type="submit" name="action" value="Creer le Brainsto" />

    </form>
</div>

<!-- FIN PARTIE CREER UN BRAINSTO -->

