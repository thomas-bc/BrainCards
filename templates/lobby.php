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



<style>

    *{
        box-sizing: border-box;
    }

    h2{
        color:#ED7D31;
        margin-top:20px;
        text-align:center;
    }

    #chat{
        position:absolute;
        background-color: white ;
        width:300px;
        right:0;
        top:0;
        bottom:0;
        color:#ED7D31;
    }

    #chat form{
        position:absolute;
        bottom:10px;
        right:40px;
    }


    .button {
        color: #ED7D31;
    }

    .textInput{
        border-bottom:1px solid #ED7D31;
        color:#ED7D31;
    }

    #affichageChat li{
        display:block;
        margin-left:15px;
    }


    #lobby{
        position:absolute;
        right:300px;
        left:0px;
        z-index:-1;
        background-color: yellow;
        margin:10px;

    }

</style>


<div id="lobby"> <br><br>

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

</div>

