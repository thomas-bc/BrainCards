<?php
// Si la page est appelée directement par son adresse, on redirige vers la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php");
    die("");
}
?>

<link rel="stylesheet" href="css/cssCommun.css">

<style>

    #headerBrainsto{
        position:absolute;
        right:25%;
        left:0;
        top:0;
        text-align:center;
        }

    #headerBrainsto h2{
        margin-right:20px;
        margin-left:20px;
        margin-top:15px;
        margin-bottom:5px;
        color:white;
    }

    #headerBrainsto #sousTitreBrainsto{
        color:white;
        margin-top:0px;
    }


    #headerBrainsto #codeBrainsto{
        position:absolute;
        top:10px;
        left:10px;

        color: #ED7D31;
        padding:5px 10px;
        background-color: white;
        border:none;
        border-radius: 5px;
        font-weight: bold;
        display:block;

        width:50px;
                    }

    #headerBrainsto #chrono{
        position:absolute;
        top:10px;
        right:10px;

        color: #ED7D31;
        padding:5px 10px;
        background-color: white;
        border:none;
        border-radius: 5px;
        font-weight: bold;
        display:block;

        width:50px;
    }

</style>



<div id="headerBrainsto">

    <?php //on récupère le code et le titre du brainsto grace aux variables de session
    $idBrainsto = $_SESSION["idBrainstoCourant"];
    $code = getChamp('br_code', 'brainstorm', 'br_id', $idBrainsto);
    $titre = getChamp('br_titre', 'brainstorm', 'br_id', $idBrainsto);
    ?>

<div id="codeBrainsto"><?php echo $code?></div>

<h2 id="titreBrainsto"><?php echo $titre?></h2>


<h3 id="sousTitreBrainsto">
    <?php
    if ($view = valider("view")){

        switch($view){
            case "lobby":
                echo "Salle d'attente du Brainstorming";
                break;
            case "step":
                echo "Salle d'attente du Step";
                break;
            case "step_final":
                echo "Salle d'attente du Step Final";
                break;
        }
    }
    ?>
</h3>


    <?php
        if ($view = valider("view")){
            if ($view!="lobby"){
                echo "<div id='chrono'></div>";

            }
        };

    ?>


</div>

