<?php
session_start();

include_once "libs/maLibUtils.php";
include_once "libs/maLibSQL.pdo.php";
include_once "libs/maLibSecurisation.php";
include_once "libs/modele.php";


if ($action = valider("action"))
{
    ob_start();

    switch($action)
    {
        case "accueil" :
            $qs = "?view=accueil";
            break;

        case "join":
            $qs = "?view=join";
            break;

        case "lobby" :
            $qs = "?view=lobby";
            break;
        case "step":
            $qs = "?view=step";
            break;

        case "step_final" :
            $qs = "?view=step_final";
            break;

        case "header_brainsto":
            $qs = "?view=header_brainsto";
            break;

        case "chat" :
            $qs = "?view=chat";
            break;

        case "connexion":
            break;

        case "creation_compte":
            break;

        case "mes_brainstos":
            break;

        case "rejoindre":
            break;

        case "creer_brainsto":
            break;

        case "ready":
            break;

        case "lancer_brainsto":
            break;

        case "poster":
            if($idBrainsto=valider($idBrainsto
                && $idUser = valider("idUser","SESSION")
                    && $message = valider("message"))){
                envoyerMessage($idBrainsto, $idUser, $message);
            }
            break;
    }

}

// On redirige toujours vers la page index, mais on ne connait pas le répertoire de base
// On l'extrait donc du chemin du script courant : $_SERVER["PHP_SELF"]
// Par exemple, si $_SERVER["PHP_SELF"] vaut /chat/data.php, dirname($_SERVER["PHP_SELF"]) contient /chat

$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
// On redirige vers la page index avec les bons arguments

header("Location:" . $urlBase . $qs);
//qs doit contenir le symbole '?'

// On écrit seulement après cette entête
ob_end_flush();

