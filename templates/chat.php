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
$idBrainsto = $_SESSION["idBrainstoCourant"];

if (!$idBrainsto)
{
    die("idBrainsto manquant");
}

// Les messages
$messages = getMessages($idBrainsto);
$recupChat = " ";


foreach($messages as $dataMessage) {
    $recupChat.="<li> [";
    $recupChat.= $dataMessage["user_username"] . "] " ;
    $recupChat.=$dataMessage["msg_contenu"];
    $recupChat.="</li>";
}

?>

<link rel="stylesheet" href="css/cssCommun.css">

<style>

    #chat h2{
        color:#ED7D31;
        margin-top:20px;
        text-align:center;
    }

    #chat{
        position:fixed;
        background-color: white ;
        width:300px;
        right:0;
        height:100%;
        color:#ED7D31;
    }

    #chat #formPoster{
        position:absolute;
        bottom:5px;
        right:40px;
    }






    #chat .button {
        color: white;
        background-color: #ED7D31;
    }

    #chat .textInput{
        border-bottom:1px solid #ED7D31;
        color:#ED7D31;
    }

    #chat #affichageChat{
        position:absolute;
        top:75px;
        bottom:75px;
        right:0;
        left:0;
        overflow:auto;
    }

    #chat #affichageChat li{
        display:block;
        margin-left:15px;
    }

</style>

<script src="js/jquery-3.4.1.js"></script>


<script>



    function timeout(){
        setTimeout(function (){
            $.ajax({"url":"dataProvider.php",
                "data":{variable:"majMessage"},
                "type":"GET",
                "success":function(donnees){
                $("#affichageChat").html(JSON.parse(donnees));
                },
                "error":function(){
                console.log("erreur lors du chargement des messages");
                }
            });
            timeout();
        },1000);
    }

    function posterMessage(e){
        if ( e.keyCode == 13 ){
            $.ajax({
                "url": "dataProvider.php",
                "data": {variable:"posterMessage",message:$("#contenuMessage").val()},
                "type": "GET",
                "success": function(){
                    console.log("ok j'ai cliqué");
                },
                "error": function () {
                    console.log("erreur lors du poste du message");
                }
            });
            $("#contenuMessage").val("");
        }
    }


    $(document).ready(function(){

        var recupChat= "<?php echo $recupChat; ?>";


        $("#affichageChat").append(recupChat);

        timeout();

        $("#btnPoster").click(function() {
                console.log("click");
                $.ajax({
                    "url": "dataProvider.php",
                    "data": {variable:"posterMessage",message:$("#contenuMessage").val()},
                    "type": "GET",
                    "success": function(){
                        console.log("ok j'ai cliqué");
                    },
                    "error": function () {
                        console.log("erreur lors du poste du message");
                    }
                });
                $("#contenuMessage").val("");
            }
        );

    })


</script>







<div id="chat">
    <h2>Chat</h2>

    <div id="affichageChat"></div>
    <div id="formPoster">
    <input id="contenuMessage" class="textInput" type="text" onkeyup="posterMessage(event);">
    <button id="btnPoster" class="button">Poster</button>
    </div>

</div>

