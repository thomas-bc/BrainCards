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


</style>

<div id="headerBrainsto">


<div id="codeBrainsto">#10258</div>


<h2 id="titreBrainsto">Titre du Brainsto</h2>

<h3 id="sousTitreBrainsto">Sous-titre brainsto</h3>

</div>

