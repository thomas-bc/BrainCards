<?php

include_once("libs/maLibUtils.php");
include_once("libs/maLibSQL.pdo.php");
include_once("libs/modele.php");



// faire des if pour chaque requete AJAX
if ($ma_valeur_associe_a_mon_mon_cle = valider("mon_mot_cle")) { // si mon mot clé existe

    //j'utilise $ma_valeur_associe_a_mon_mon_cle

    // et je fais des bails genre :

    /*
    $SQL = "SELECT * FROM etudiants WHERE ";
    $users = parcoursRs(SQLSelect($SQL));
    $data["students"] = $users;

    $data["cle"] = "valeur";

    echo json_encode($data);
    */
    // on envoie des données au format JSON
}

if($message = valider("message")){
    // On récupère l'id de la conversation à afficher, dans idConv
    $idBrainsto = getValue("BR_id");
    $idBrainsto = 1;

    if (!$idBrainsto)
    {
        die("idBrainsto manquant");
    }

// Les messages
    $messages = getMessages($idBrainsto);


    $recupChat = "";

    foreach($messages as $dataMessage) {
        $recupChat.='<li>';
        $recupChat.="[" . $dataMessage["user_username"] . "] " ;
        $recupChat.=$dataMessage["msg_contenu"];
        $recupChat.="</li>";
    }

    echo json_encode($recupChat);
}