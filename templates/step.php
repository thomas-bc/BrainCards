<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=step");
    die("");
}

include("header_brainsto.php");

?>

<link rel="stylesheet" href="css/cssCommun.css">


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
        background-color: blue;
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
        background-color: yellow;
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
        background-color: green;
    }
    #container{
        width: 80%;
        height: 400px;
        border-radius: 30px;
        display:inline-block;

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
        vertical-align: middle;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
        border-radius: 4px;
        margin-bottom: 20px;
        color:white;
    }
    #Idée{
        background-color: blue;
    }
    #Image{
        background-color: yellow;
    }
    #URL{
        background-color: green;
    }
    .titre{
        margin-left: auto;
        margin-right: auto;
        text-align: center;
        color: orangered;
    }
    #canvas{
        background-color: white;
        border-radius: inherit;
        height: 400px;
        width: 100%;
    }
    .draggable_Container{
        border: 1px black dotted;
    }
    #suppress{
        display:none;
        position: absolute;

    }
</style>
<script>





    var container;
    var nb_elements = 0;
    var canvas;
    var ctx;
    var selected = -1;
    var state_suppress=false;
    function click_canvas(event) {
        if(event.target.id=="canvas"){
            if(selected!=-1)document.getElementById(selected).children[1].style.display="none";
            selected = -1;
        }
    }
    function init(){
        container = document.getElementById("container");
        canvas = document.getElementById("canvas");
        ctx = canvas.getContext("2d");
        //ctx.moveTo(10, 10);
        //ctx.lineTo(200, 200);
        //ctx.stroke();
    }
    function drag_start(event) {
        var style = window.getComputedStyle(event.target, null);
        var str = (parseInt(style.getPropertyValue("left")) - event.clientX) + ',' + (parseInt(style.getPropertyValue("top")) - event.clientY) + ',' + event.target.id;
        ctx.stroke();
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
        return false;
    }
    function select(){
        console.log(selected);
        if(selected!=-1)document.getElementById(""+selected).children[1].style.display="none";

        selected = this.id;
        if(state_suppress){
            selected = -1;
            state_suppress=false;
        }
        this.children[1].style.display="inline-block";
    }
    function drag_over(event) {
        event.preventDefault();
        return false;
    }
    function del(){
        var parent = this.parentElement;
        selected = -1;
        state_suppress=true;
        parent.parentElement.removeChild(parent);
    }
    function create(event){
        if(event.target.id=="Idée" || event.target.innerText=="Idée"){
            g = document.createElement('div');
            g.className="draggable_idee";
            g.id=""+nb_elements;
            g.draggable=true;
            g.innerHTML="<p>"+nb_elements+"</p>";
            g.ondragstart=drag_start;
            g.onclick=select;
            b = document.createElement('button');
            b.style.position="absolute";
            b.style.right="-10px";
            b.style.top = "-10px";
            b.style.display = "none";
            b.onclick=del;
            g.appendChild(b);
            b.innerHTML="X";
            b.style.borderRadius="50%";
            container.appendChild(g);
            nb_elements++;
        }
        else if(event.target.id=="Image" || event.target.innerText=="Image") {
            g = document.createElement('div');
            g.className="draggable_img";
            g.id=""+nb_elements;
            g.draggable=true;
            g.innerHTML="<p>"+nb_elements+"</p>";
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
            g.appendChild(b);
            container.appendChild(g);
            nb_elements++;
        }
        else if(event.target.id=="URL" || event.target.innerText=="URL") {
            g = document.createElement('div');
            g.className="draggable_url";
            g.id=""+nb_elements;
            g.draggable=true;
            g.innerHTML="<p>"+nb_elements+"</p>";
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

            g.appendChild(b);
            container.appendChild(g);
            nb_elements++;
        }
    }
</script>



<div id="divCard">
    <div class="wrapper">
        <div id="container" ondragover="drag_over(event)" ondrop="drop(event)" onclick="click_canvas(event)">
            <canvas id="canvas"></canvas>
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


<script type="application/javascript">
    init();
</script>