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
        case "versStep":
            $qs= "?view=step";
            break;
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

        case "Connexion":
            $qs = "?view=accueil";
            if ($login = valider("login"))
                if ($passe = valider("passe"))
                {
                    // On verifie l'utilisateur, et on crée des variables de session si tout est OK
                    // Cf. maLibSecurisation
                    if(verifUser($login,$passe))
                        $qs = "?view=join";
                }
        break;

        case "Inscription":
            deb("inscription");
            $qs = "?view=accueil";
            if ($login = valider("login"))
            if ($pass = valider("pass"))
            if ($pass2 = valider("pass2"))
            {
                if($pass == $pass2){
                    if(createUser($login, $pass)){
                        deb("user " . $login. " créée");
                        $qs = "?view=join";
                    }
                    else{
                        deb("user " . $login. " existe deja");
                    }
                }
                else{
                    deb("password non identique");
                }

            }

        break;

        case "Mes Brainsto's":
            break;

        case "Rejoindre":
            if($idUser=valider("idUser","SESSION")){
                if ($codeBrainstoCourant = valider("codeBrainsto")) {
                    rejoindreBrainsto($idUser, $codeBrainstoCourant);
                    $qs = "?view=lobby";
                }
            };
            break;

        case "Creer le Brainsto":
            if($idUser=valider("idUser","SESSION")) {
                if ($titreBrainsto = valider("titreBrainsto")) {
                    if ($descriptionBrainsto = valider("descriptionBrainsto")){
                        $idBrainsto = creerBrainsto($idUser, $titreBrainsto, $descriptionBrainsto);
                        $qs = "?view=lobby";
                    }
                }
            }
            break;


        case "I'm Ready !":
            break;


        case "Lancer le Brainsto":
            break;


        case "Poster":
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

