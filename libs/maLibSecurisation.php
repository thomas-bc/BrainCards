<?php

include_once "maLibUtils.php";	// Car on utilise la fonction valider()
include_once "modele.php";	// Car on utilise la fonction connecterUtilisateur()





/**
 * Cette fonction vérifie si le login/passe passés en paramètre sont légaux
 * Elle stocke les informations sur la personne dans des variables de session : session_start doit avoir été appelé...
 * Infos à enregistrer : pseudo, idUser, heureConnexion, isAdmin
 * Elle enregistre l'état de la connexion dans une variable de session "connecte" = true
 * L'heure de connexion doit être stockée au format date("H:i:s")
 * @pre login et passe ne doivent pas être vides
 * @param string $login
 * @param string $password
 * @return false ou true ; un effet de bord est la création de variables de session
 */
function verifUser($login,$password)
{
    if($login != "" && $password != "")
        if($idUserLogin = verifUserBDD($login,$password))
        {
            session_start();
            $_SESSION["pseudo"] = $login;
            $_SESSION["idUser"] = $idUserLogin;
            $_SESSION["heureConnexion"] = date("H:i:s");
            $_SESSION["connecte"] = true;
            return true;
        }
        else return false;
}

/**
 * Créé un nouvel utilisateur dans la base de donnée. La fonction vérifie avant que login et password ne sont pas vides,
 * et que l'utilisateur n'existe pas déjà
 * Renvoie true si l'user a été créé, false sinon
 * @param $login
 * @param $password
 * @return bool|Renvoie
 */
function createUser($login,$password){
    if($login != "" && $password != ""){
        $verif = verifUserBDD($login, $password);
        if($verif==0){ // on vérifie que l'user n'existe pas déjà
            return inscrireUser($login, $password);
        }
        return false;
    }
    return false;
}

function rejoindreBrainsto($idUser, $codeBrainstoCourant){
    $idBrainstoCourant=getChamp('br_id','brainstorm','br_code', $codeBrainstoCourant);
    $_SESSION["idBrainstoCourant"] = $idBrainstoCourant;
    setUserBrainsto($idBrainstoCourant, $idUser);
}