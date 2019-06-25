<?php
// Si la page est appelée directement par son adresse, on redirige vers la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php");
    die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");

// On récupère l'id de la conversation à afficher, dans idConv
$idBrainsto = getValue("BR_id");

if (!$idBrainsto)
{
    die("idBrainsto manquant");
}

// Les messages
$messages = getMessages($idBrainsto);

echo '<div id="recupChat">';

foreach($messages as $dataMessage) {
    echo '<li>';
    echo "[" . $dataMessage["msg_auteur_id"] . "] " ;
    echo $dataMessage["msg_contenu"];
    echo "</li>\n";
}

echo '</div>';
?>

<link rel="stylesheet" href="css/cssCommun.css">

<style>

    h2{
        color:#ED7D31;
        margin-top:20px;
        text-align:center;
    }

    li{
        color:#ED7D31;
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

    form{
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

    #recupChat li{
        display:block;
        margin-left:15px;
    }

</style>

<script src="js/jquery-3.4.1.js"></script>


<script>

    $(document).ready(function(){

        $("#affichageChat").append($("#recupChat"));


    })






    // DANS 10 SECONDES, Raffraichir la page
        window.setTimeout(fnReload,10000);

        function fnReload(){
            document.location.reload();
        }
</script>






<div id="chat">
    <h2>Chat</h2>

    <div id="affichageChat"></div>

    <form action="controleur.php" method="GET" >

        <input class="textInput" type="text" name="message" >
        <input type="hidden" name="idBrainsto" value="$idBrainsto" >
        <input class="button" type="submit" name="action" value="Poster" >

        </form>


</div>

