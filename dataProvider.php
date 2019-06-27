<?php

session_start();

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




if ($variable = valider("variable"))
{
    ob_start();

    switch($variable) {
        case "majMessage":
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
                $recupChat .= "<li>";
                $recupChat .= "[" . $dataMessage["user_username"] . "] " ;
                $recupChat .= $dataMessage["msg_contenu"];
                $recupChat .= "</li>";
            }


            echo json_encode($recupChat);
            break;


        case "posterMessage":
            deb('ok');
            if($idBrainsto = valider("idBrainstoCourant","SESSION")){
                deb("ok1");
                if ($idUser = valider("idUser", "SESSION")) {
                    deb("ok2");
                    if ($message = valider("message")) {
                        deb("ok3");
                        envoyerMessage($idBrainsto, $idUser, $message);
                    }
                }
            }
            echo "";
            break;


        case "lancerBrainsto": //ne va en fait que créer les cards du brainsto, le chargement de la page se fait par requête asynchrone
            if($idBrainsto = valider("idBrainstoCourant","SESSION")){
                if ($idUser = valider("idUser", "SESSION")) {
                    $lesParticipants = getListUser($idBrainsto);
                    foreach ($lesParticipants as $participant){
                        createCard($idBrainsto, $participant["user_id"]);
                    }
                }
            }
            break;
    }
}
// On écrit seulement après cette entête
ob_end_flush();
?>
