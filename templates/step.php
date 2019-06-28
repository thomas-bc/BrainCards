<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=step");
    die("");
}
// seul les utilisateurs connectés peuvent se rendre sur join
if( !($idUser = estConnecte()) ){
    header("Location:".dirname($_SERVER[PHP_SELF])."/index.php?view=accueil");
    die("");
}



include("header_brainsto.php");

?>

<link rel="stylesheet" href="css/cssCommun.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<!----------- CYCLE FIN STEP  ---------------->
<script src="js/jquery-3.4.1.js"></script>


<?php //on récupère les infos du brainsto par la session

$idBrainsto = $_SESSION["idBrainstoCourant"];

$nbTours = getChamp('br_nb_tours', 'brainstorm', 'br_id', $idBrainsto);
$timeByStep = getChamp('br_timer_tour', 'brainstorm', 'br_id', $idBrainsto);
$numEtape = valider("numEtape", "SESSION");

?>

<style>
    #rejoindreStepFinal{
        display: none;
    }
</style>

<script>

    // TODO rendre le temps d'une step variable avec entrée master (au lieu de 15 s)

    var nbTours = <?php echo $nbTours;?>;
    var timeByStep = <?php echo $timeByStep;?>;
    var numEtape = <?php echo $numEtape;?>;
    function start(counter){
        if(counter > 0){
            setTimeout(function(){
                counter--;
                $("#chrono").html(counter);
                start(counter);
            }, 1000);
        }
        else {
            finDuTemps();
        }
    }

    function finDuTemps(){

        $.ajax({"url":"dataProvider.php",
            "data":{variable:"postHTML",
                cardHTML: $("#container").html()},
            "type":"POST",
            "success":function(){
                console.log("postHTML");
                verifUsers();
            },
        });

    }

    function verifUsers(){
        setTimeout(function(){
            $.ajax({"url":"dataProvider.php",
                "data":{variable:"userReady"},
                "type":"GET",
                "success":function(rep){
                    console.log("reponse verif users ready : " + rep);
                    var data = JSON.parse(rep);
                    var usersReady = data["usersReady"];
                    if(usersReady){
                        console.log("on recharge la page step");
                        MAJ_STEP();
                    }
                    else{
                        console.log("on verifie que tout le monde est ready dans 1s");
                        verifUsers();
                    }
                }
                }
            );
        }, 1000);
    }

    function MAJ_STEP(){
        console.log("MAJ_STEP");
        $.ajax({"url":"dataProvider.php",
            "data":{variable:"majStep"},
            "type":"GET",
            "success":function(rep){
                console.log('après requête : ' + rep);
                if( (parseInt(numEtape) >= parseInt(nbTours) )){
                    console.log("go to final step");
                    document.getElementById("rejoindreStepFinal").click();
                    // TODO
                }
                else{
                    console.log("nouvelle étape");
                    $("#container").html(rep);
                    numEtape = numEtape + 1;
                    start(temp);
                }
            },
        });
    }

    $(document).ready(function() {
        // start(timeByStep*60);
        console.log("ON READY");
        var temp = 15;
        start(temp);
    });

</script>

<!--       FIN CYCLE        -->



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




<script>
    var container;
    var nb_elements = 0;
    var canvas;
    var ctx;
    var selected = -1;
    var state_suppress=false;
    var link = -1;
    var tableLink=[];
    var state_link = false;
    function init(){
        container = document.getElementById("container");
        canvas = document.getElementById("canvas");
        ctx = canvas.getContext("2d");
    }
    function maj(){

        ctx.clearRect(0, 0, canvas.width, canvas.height);

        tableLink.forEach(function(item){
            ctx.beginPath();
            ctx.moveTo(parseInt(document.getElementById(item[0]).style.left,10),
                parseInt(document.getElementById(item[0]).style.top,10));
            ctx.lineTo(parseInt(document.getElementById(item[1]).style.left,10),
                parseInt(document.getElementById(item[1]).style.top,10));
            ctx.stroke();
        });
    }
    function click_canvas(event) {
        if(event.target.id=="canvas"){
            if(selected!=-1){
                document.getElementById(selected).children[1].style.display="none";
                document.getElementById(selected).children[2].style.display="none";
                document.getElementById(selected).children[3].style.display="none";
            }
            selected = -1;
            console.log("click");
            if(link!=-1){link=-1;container.style.cursor="auto";}
        }

    }

    function drag_start(event) {
        var style = window.getComputedStyle(event.target, null);
        var str = (parseInt(style.getPropertyValue("left")) - event.clientX) + ',' + (parseInt(style.getPropertyValue("top")) - event.clientY) + ',' + event.target.id;

        event.dataTransfer.setData("Text", str);
    }

    function drop(event) {
        var offset = event.dataTransfer.getData("Text").split(',');
        var dm = document.getElementById(offset[2]);
        dm.style.left = (event.clientX + parseInt(offset[0], 10)) + 'px';
        dm.style.top = (event.clientY + parseInt(offset[1], 10)) + 'px';
        if(parseInt(dm.style.left, 10)>540)dm.style.left="540px";
        if(parseInt(dm.style.top, 10)>370)dm.style.top="370px";
        if(parseInt(dm.style.left, 10)<40)dm.style.left="40px";
        if(parseInt(dm.style.top, 10)<40)dm.style.top="40px";
        event.preventDefault();
        maj();
        return false;
    }
    function select(){
        if(link==-1){
            if(selected!=-1){document.getElementById(""+selected).children[1].style.display="none";
                document.getElementById(""+selected).children[2].style.display="none";
                document.getElementById(""+selected).children[3].style.display="none";}

            selected = this.id;
            if(state_suppress){
                selected = -1;
                state_suppress=false;
            }
            this.children[1].style.display="inline-block";
            this.children[2].style.display="inline-block";
            this.children[3].style.display="inline-block";
        }
        else{
            if(!state_link){
                container.style.cursor="auto";
                tableLink.push([link,this.id]);
                link = -1;
                maj();
            }
            else{
                state_link = false;

            }
        }
    }
    function drag_over(event) {
        event.preventDefault();
        return false;
    }
    function del_links(id){
        temp = [];
        for(i=0;i<tableLink.length;i++){
            if(tableLink[i][0]!=id && tableLink[i][1]!=id)
                temp.push(tableLink[i]);
        }
        tableLink = temp;

    }
    function del(){
        var parent = this.parentElement;
        selected = -1;
        del_links(this.parentElement.id);
        state_suppress=true;
        parent.parentElement.removeChild(parent);
        maj();
    }
    function edit(){
        reponse=prompt("value : ")
        if(this.parentElement.className=="draggable_idee")
            this.parentNode.children[0].innerHTML=reponse;
        else if(this.parentElement.className=="draggable_img") {
            this.parentNode.children[0].src = reponse;
            this.parentNode.children[0].className = "image";
            this.parentElement.style.height = this.parentNode.children[0].height+20+"px";
            this.parentElement.style.width = this.parentNode.children[0].width+20+"px";
        }
        else if(this.parentElement.className=="draggable_url") {
            this.parentNode.children[0].children[0].href = reponse;
            this.parentNode.children[0].children[0].innerHTML="link";
        }
    }
    function setLink(){
        container.style.cursor = "pointer";
        link=this.parentElement.id;
        console.log(link);
        state_link = true;
    }
    function create(event){
        g = document.createElement('div');
        g.style.top="40px";
        g.style.left="40px";
        g.style.width="80px";
        g.style.height="50px";
        if(event.target.id=="Idée" || event.target.innerText=="Idée"){
            g.className="draggable_idee";
            g.innerHTML="<p></p>";
        }
        else if(event.target.id=="Image" || event.target.innerText=="Image") {
            g.className="draggable_img";
            g.innerHTML="<img>";
        }
        else if(event.target.id=="URL" || event.target.innerText=="URL") {
            g.className="draggable_url";
            g.innerHTML="<p><a></a></p>"
        }
        g.id=""+nb_elements;
        g.draggable=true;
        g.ondragstart=drag_start;
        g.onclick=select;

        b = document.createElement('button');
        b.style.position="absolute";
        b.style.right="-10px";
        b.style.top = "-10px";
        b.style.display = "none";
        b.onclick=del;
        b.innerHTML="X";
        b.style.borderRadius="50%";

        be = document.createElement('button');
        be.style.position="absolute";
        be.style.left="-10px";
        be.style.top = "-10px";
        be.style.display = "none";
        be.onclick=edit;
        be.innerHTML="<i class=\"fa fa-pencil\"></i>";
        be.style.borderRadius="50%";

        bl = document.createElement('button');
        bl.style.position="absolute";
        bl.style.left="-10px";
        bl.style.bottom = "-10px";
        bl.style.display = "none";
        bl.onclick=setLink;
        bl.innerHTML="--";
        bl.style.borderRadius="50%";

        g.appendChild(bl);
        g.appendChild(be);
        g.appendChild(b);
        container.appendChild(g);
        nb_elements++;


    }
</script>

<!--<script src="js/jquery-3.4.1.js"></script>-->


<div id="divCard">
    <div class="wrapper">
        <div id="container" ondragover="drag_over(event)" ondrop="drop(event)" onclick="click_canvas(event)">
            <canvas id="canvas" width="600" height="400"></canvas>
            <button id="suppress">btn</button>
        </div>
        <div id="container_elements">
            <div class="titre"><h2>Outils</h2></div>
            <div class="menu_item" id="Idée" onclick="create(event)"><p>Idée</p></div>
            <div class="menu_item" id="Image" onclick="create(event)"><p>Image</p></div>
            <div class="menu_item" id="URL" onclick="create(event)"><p>URL</p></div>
        </div>
    </div>
</div>

<form action="controleur.php" method="GET">
    <input id="rejoindreStepFinal" type="submit" name="action" value="goToStepFinal"  />
</form>

<script type="application/javascript">
  init();
</script>




<!--<canvas width="600" height="400" id="canvas"></canvas> <button id="suppress">btn</button> <div class="draggable_idee" id="0" style="top: 40px; left: 40px; width: 80px; height: 50px;" draggable="true"><p>master</p><button style="position: absolute; left: -10px; bottom: -10px; display: inline-block; border-radius: 50%;">--</button><button style="position: absolute; left: -10px; top: -10px; display: inline-block; border-radius: 50%;"><i class="fa fa-pencil"></i></button><button style="position: absolute; right: -10px; top: -10px; display: inline-block; border-radius: 50%;">X</button></div>-->

