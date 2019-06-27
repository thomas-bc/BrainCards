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


        case "ready":
            if($idUser=valider("idUser", "SESSION")) {
                deb("je suis dans ready dans le dataprovider");
                $ready = getUserReady($idUser);
                if($ready["user_ready"]==1) {
                    setUserReady($idUser, $ready["user_ready"]-1);
                }
                else { setUserReady($idUser, $ready["user_ready "]+1); }
            }
            break;


        case "majLobby":
            $idBrainsto = $_SESSION["idBrainstoCourant"];
            $lesParticipants=getListUser($idBrainsto);

            $recupParticipant="";

            $nbTourNv=1;
            $tpsTourNv=1;
            $tpsRelectureNv=1;

            $isMaster=valider("isMaster");
            if($isMaster){
                setParametres($idBrainsto, "nb_tours",$nbTour=valider("nbTour") );
                setParametres($idBrainsto, "timer_tour" ,$tpsTour=valider("tpsTour") );
                setParametres($idBrainsto, "relecture_timer",$tpsRelecture=valider("tpsRelecture") );
            }
            $nbTourNv=getChamp('br_nb_tours', 'brainstorm', 'br_id', $idBrainsto);
            $tpsTourNv=getChamp('br_timer_tour', 'brainstorm', 'br_id', $idBrainsto);
            $tpsRelectureNv=getChamp('br_relecture_timer', 'brainstorm', 'br_id', $idBrainsto);

            foreach($lesParticipants as $user){
                $userId=$user["user_id"];
                $userUsername=$user["user_username"];
                $userReady=$user["user_ready"];

                if($userReady==1){
                    $couleur="green";
                }
                else{ $couleur="darkred"; }

                $recupParticipant .= "<li><p id='pseudoParticipant'>". $userUsername . "</p><div id='btnViewReady' style='background-color:" . $couleur . "' ></div></li>";
            }

            $brainstoLance = nbCardBrainsto($idBrainsto);

            $retour = array ('recupParticipant' => $recupParticipant, 'nbTour' => intval($nbTourNv), 'tpsTour' => intval($tpsTourNv), 'tpsRelecture' => intval($tpsRelectureNv), 'brainstoLance' => ($brainstoLance > 0));
            echo json_encode($retour);
            break;


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

    }
}



// surveiller le lancement du brainsto
if ($variable2 = valider("variable2"))
{

    $idBrainsto = $_SESSION["idBrainstoCourant"];
    $brainstoLance = nbCardBrainsto($idBrainsto);

    $data["goToStep"] = ($brainstoLance > 0);

    echo json_encode($data);

}











// On écrit seulement après cette entête
ob_end_flush();
?>
