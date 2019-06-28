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

<?php //on récupère les infos du brainsto par la session

$idBrainsto = $_SESSION["idBrainstoCourant"];

$cards = getCardAndPseudo($idBrainsto);

?>


<script>

    var cards = <?php echo json_encode($cards); ?> ;
    var jCard = $("<li>");

    $(document).ready(function() {

        setCards();


        $("li").click(function(){
            $("#bigView").css("display","block");

        });


        $("#flecheRetour").click(function(){
            $("#bigView").css("display","none");
        });

    });


    function setCards(){
        for(var k = 0 ; k < cards.length ; k++){

            var jCardObject = jCard.clone();
            jCardObject.text(cards[k].user_username);
            jCardObject.data("html", cards[k].card_objet_html);
            jCardObject.on("click", function(){
                console.log("on clique sur card");
                $("cardView").html("<p>svqvr</p>");
            });
            $("#listeCards").append(jCardObject);

            // console.log("k : " + k);
            // console.log(jCardObject.data("html"));
        }
    }


</script>



<style>


    /***************** HEADER ***********************/
    #headerBrainsto{
        right:0;
    }
    /*****************STEP ***************************/
    body{
        overflow:hidden;
    }
    #divCard{
        position:absolute;
        top:120px;
        width:99%;
    }
    #divCard h2{
        margin:0;
        color:#ED7D31;
        font-size:1.75em;
        margin-top:20px;
        margin-bottom:20px;
    }
    /*************** INTERIEUR CARD *******************/
    .draggable_idee
    {
        position:  absolute;
        height: 50px;
        left : 40px;
        top : 40px;
        width: 80px;
        display:table;
        vertical-align: middle;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
        border-radius: 4px;
        color:white;
        background-color: #444444;
        padding:5px;

    }
    .draggable_img
    {
        left : 40px;
        top : 40px;
        position:  absolute;
        height: 50px;
        width: 80px;
        display:table;
        vertical-align: middle;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
        border-radius: 4px;
        margin-bottom: 20px;
        color:white;
        background-color: #629dfc;
        padding:5px;

    }
    .draggable_url
    {
        left : 40px;
        top : 40px;
        position:  absolute;
        height: 50px;
        width: 80px;
        display:table;
        vertical-align: middle;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
        border-radius: 4px;
        margin-bottom: 20px;
        color:white;
        background-color: #68768c;
        padding:5px;
    }
    #container{
        width: 600px;
        height: 400px;
        border-radius: 30px;
        display:inline-block;
        background-color: white;

    }
    body{
        display: block;
        margin: 0px;
    }
    #container_elements{
        height: 300px;
        width: 120px;
        display: table;
        margin-left: 30px;
        border-radius: 10px;
        background-color: white;

    }
    .wrapper{
        align-items: center;
        display: flex;
        height: 100%;
        width: 100%;
        margin: 30px;
    }
    .menu_item{
        height: 50px;
        width: 80px;
        display:table;
        line-height: 50px;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
        border-radius: 4px;
        margin-bottom: 20px;
        color:white;
    }
    #Idée{
        background-color: #444444;
    }
    #Image{
        background-color: #629dfc;
    }
    #URL{
        background-color: #68768c;
    }
    .titre{
        margin-left: auto;
        margin-right: auto;
        text-align: center;
        color: orangered;
    }
    #canvas{
        border-radius: inherit;
        background-color: white;
    }
    #suppress{
        display:none;
        position: absolute;

    }
    .image{
        position:absolute;
        width: 150px;
        height: 100px;
        left:10px;
        bottom: 10px;
    }
</style>


<div id="stepFinal">



    <div id="listCards">
    <ul id="listeCards">

    </ul>
    </div>
</div>


<div id="bigView">

    <img id="flecheRetour" src="res/flecheRetour.png">
    <div id="cardView">

    </div>
</div>
