<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=step_final");
    die("");
}

    include("templates/chat.php");
    include("header_brainsto.php");
?>

<link rel="stylesheet" href="css/cssCommun.css">


<style>


    /************************* CSS DU stepFinal *************************************/

    #stepFinal *{
        box-sizing: border-box;
    }

    #stepFinal {
        position: absolute;
        right: 25%;
        left: 0px;
        margin: 0px;
        top: 120px;
    }

    #stepFinal ul li{
        display:block;
        float:left;
        margin:10px;
        width:400px;
        height:200px;
        line-height: 200px;
        text-align:center;
        background-color: #444444;
        border-radius:10px;
        font-size:1.5em;
    }

    #stepFinal ul li:hover{
        cursor:pointer;
    }

    #bigView{
        display:none;
        position:fixed;

        right: 28%;
        left: 3%;
        margin: 0px;
        top: 120px;

        bottom:5px;
        border-radius: 5px;
        background-color: #444444;
    }

    #bigView img{
        max-width: 40px;
        margin:10px;
    }

    #bigView img:hover{
        cursor:pointer;
    }

</style>

<script src="js/jquery-3.4.1.js"></script>

<script>

    $(document).ready(function() {

        $("li").click(function(){
            $("#bigView").css("display","block");

        });


        $("#flecheRetour").click(function(){
            $("#bigView").css("display","none");
        });

    });


</script>

<div id="stepFinal">



    <div id="listCards">
    <ul>
        <li>Card de Participant1</li>
        <li>Card de Participant1</li>
        <li>Card de Participant1</li>
        <li>Card de Participant1</li>
        <li>Card de Participant1</li>

    </ul>
    </div>
</div>


<div id="bigView">

    <img id="flecheRetour" src="res/flecheRetour.png">
    <div id="cardView">

    </div>
</div>
