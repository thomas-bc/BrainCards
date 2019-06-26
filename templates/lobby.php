<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=lobby");
    die("");
}

    include("templates/chat.php");
    include("header_brainsto.php");
    include("header_debug_php.php");
?>

<link rel="stylesheet" href="css/cssCommun.css">


<style>


    /************************* CSS DU LOBBY *************************************/

    #lobby *{
        box-sizing: border-box;
    }

    #lobby{
        position:absolute;
        right:300px;
        left:0px;
        margin:10px;
        top:120px;
    }

    #lobby h3{
        display:inline-block;
        margin:5px;
        vertical-align: top;
    }

    #lobby p{
        display:inline-block;
        margin:5px;
        vertical-align: top;
    }

    #lobby #hautLobby::after{
        content: "";
        clear: both;
        display: table;
       }

    #lobby #infoBrainsto{
        width:60%;
        /*background-color: yellow;*/
    }

    #lobby .column{
        float:left;
    }

    #lobby + div{
        width:40%;
    }
    #lobby #formMaster{
        border-radius: 10px;
        border:1px solid white;
        padding:10px;
    }


    /* This is to remove the arrow of select element in IE */
    select{
        color: #ED7D31;
        padding:5px 10px;
        background-color: white;
        border:none;
        border-radius: 5px;
        font-weight: bold;
        text-align: center;
        text-align-last:center;
    }

    #lobby .selectList:hover{
        cursor:pointer;
    }

    #lobby #divLaunchBrainsto{
        margin-top:15px;
        margin-bottom:10px;
        width: 100%;
        text-align:center;
    }


    #lobby #divParticipants{
        text-align:center;
    }


</style>

<?php //on récupère les infos du brainsto par la session
$idBrainsto = $_SESSION["idBrainstoCourant"];

$titreBrainsto = getChamp('br_titre', 'brainstorm', 'br_id', $idBrainsto);
$descriptionBrainsto = getChamp('br_description', 'brainstorm', 'br_id', $idBrainsto);
$idMasterBrainsto = getChamp('br_master_id', 'brainstorm', 'br_id', $idBrainsto);
$nomMaster = getChamp('user_username', 'user', 'user_id', $idMasterBrainsto);
?>

<div id="lobby">

    <div id="hautLobby">

        <div id="infoBrainsto" class="column">

            <h3> Nom du Master : </h3>
            <p id="nomMaster"><?php echo $nomMaster ?></p>

            <br>

            <h3>Description du Brainsto :</h3>

            <br>


            <p id="descriptionBrainsto">
                <?php echo $descriptionBrainsto ?>
            </p>

        </div>



        <form action="controleur.php" method="GET">

            <div class="column">

                <div id="formMaster" >

                    <h3>Nombre de tours :</h3>
                    <select class="selectList" size="1" name="nbTours" >
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>

                    <br />

                    <h3>Temps par tour (min):</h3>
                    <select class="selectList" size="1" name="tpsTour" >
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>10</option>

                    </select>

                    <br />

                    <h3>Temps de relecture (min):</h3>
                    <select class="selectList " size="1" name="tpsRelecture">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>10</option>
                    </select>

                    <br />



                </div>

                <div id="divLaunchBrainsto">
                    <input id="launchBrainsto" class="button" type="submit" name="action" value="Lancer le Brainsto" />
                </div>

            </div>

        </form>

    </div>


    <div id="divParticipants">



        <ul id="participants">
        </ul>



        <div id="formBtn">
            <form action="controleur.php" method="GET">

                <input id="ready" class="button" type="submit" name="action" value="I'm Ready !" />
            </form>
        </div>

    </div>


</div>

