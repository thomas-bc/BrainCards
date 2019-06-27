<?php

include_once("maLibSQL.pdo.php");
include_once("config.php");

/**
 * Vérifie l'identité d'un utilisateur dont les identifiants sont passés en paramètres.
 * Renvoie l'id de l'user s'il existe dans la base de donnée, false sinon
 * @param $login
 * @param $pass
 * @return false|Int
 */
function verifUserBDD($login, $pass){
    $SQL = "SELECT USER_id FROM USER WHERE USER_USERNAME = '$login' && USER_PASSWORD = '$pass' ";
    return SQLGetChamp($SQL);
}

/**
 * Créer un nouvel utilisateur dans la bdd dont les identifiants sont passés en paramètres.
 * Renvoie l'id de l'user créé ou false si l'inscription a échoué.
 * @param $login
 * @param $pass
 * @return Renvoie
 */
function inscrireUser($login, $pass){
    $SQL ="INSERT INTO USER(USER_USERNAME, USER_PASSWORD) VALUES('$login', '$pass')";
    return SQLInsert($SQL);
}

/**
 * Génère un code
 * Crée un brainsto ayant pour admin l'utilisateur d'id $idUserMaster, pour titre $titre, et pour description $description.
 * Renvoie l'id du brainsto créé.
 * @param $idUserMaster
 * @param $titre
 * @param $description
 * @return Renvoie
 */
function createBrainstorm($idUserMaster, $titre, $description){
    // le code informatique qui crée le code du brainsto (genre #E45R1) qui est envoyé dans la requete SQL
    // A REVOIR COMMENT ON CREE LE CODE
    $SQL ="INSERT INTO BRAINSTORM(BR_CODE, BR_MASTER_ID, BR_titre, br_description) VALUES((SELECT FLOOR(rand() * 90000 + 10000)), '$idUserMaster', '$titre', '$description')";
    return SQLInsert($SQL);
}


/** REQUETE SQL : SELECT $champ FROM $table WHERE $champ_val = $val
 * @param $champ
 * @param $table
 * @param $champ_val
 * @param $val
 * @return false|string
 */
function getChamp($champ, $table, $champ_val, $val){
    $SQL = "SELECT $champ from $table where $champ_val = '$val'";
    return SQLGetChamp($SQL);
}
/**
 * Récupère le brainsto dont l'id est celui spécifié en paramètre.
 * Renvoie le brainsto sous forme de tableau associatif s'il existe, false sinon.
 * @param $idBrainsto
 * @return array
 */
function getBrainstormFromID($idBrainsto){
    $SQL = "SELECT * from BRAINSTORM WHERE BR_ID='$idBrainsto' ";
    return parcoursRs(SQLSelect($SQL));
}

/**
 * Récupère le brainsto dont le code est celui spécifié en paramètre.
 * Renvoie le brainsto sous forme de tableau associatif s'il existe, false sinon.
 * @param $code
 * @return array
 */
function getBrainstormFromCode($code){
    $SQL = "SELECT * from BRAINSTORM WHERE BR_CODE='$code' ";
    return parcoursRs(SQLSelect($SQL));
}

/** Renvoie la liste (id, code et titre) des brainstorms où $idUser a participé
 * @param $idUser
 * @return array
 */
function getMesBrainstorms($idUser){
    $SQL = "SELECT br_id, br_code, br_titre from brainstorm join card on card_brainsto_id = br_id where card_auteur_id='$idUser'";
    return parcoursRs(SQLSelect($SQL));
}
/**
 * Met à jour l'attribut ready en le mettant $ready (1 = ready, 0=not ready) à de l'utilisateur d'id $userId.
 * @param $userId
 * @param $ready
 */
function setUserReady($userId, $ready){ //pb on utilise 0 et 1 au lieu de true false car BOOLEAN devient tinyInt sur phpmyadmin... du coup on peut mettre 12....
    $SQL = "UPDATE user SET user_ready = '$ready' WHERE user_id='$userId'";
    SQLUpdate($SQL);
}

/**
 * renvoie la valeur pour savoir si l'utilisateur est déjà ready ou pas
 * @param $userId
 */
function getUserReady($userId){
    $SQL = "SELECT user_ready FROM user WHERE user_id='$userId'";
    return parcoursRs(SQLSelect($SQL));
}

/**
 * Met à jour l'id du brainsto courant à $idBrainsto de l'utilisateur $idUser.
 * @param $idBrainsto
 * @param $userId
 */
function setUserBrainsto($idBrainsto, $userId){
    $SQL = "UPDATE user SET user_brainsto_courant_id = '$idBrainsto' WHERE user_id='$userId'";
    SQLUpdate($SQL);
}

/**
 * Récupère les utilisateurs présents dans le brainsto d'id $idBrainsto.
 * Renvoie un tableau associatif contenant tous les champs des utilisateurs (sans le mot de passe).
 * @param $idBrainsto
 * @return array
 */
function getListUser($idBrainsto){
    $SQL = "SELECT user_id, user_username, user_ready FROM user WHERE user_brainsto_courant_id = '$idBrainsto'";
    return parcoursRs(SQLSelect($SQL));
}

/**
 * Indique si l'utilisateur d'id $idUser est master du brainsto d'id $idBrainsto.
 * Renvoie true(1) si l'utilisateur est master du brainsto, false(0) s'il ne l'est pas ou que un des id est incorrect.
 * @param $idBrainsto
 * @param $idUser
 * @return int
 */
function isMaster($idBrainsto, $idUser){ //on peut jouer avec true et false, à demander...
    $SQL="SELECT br_master_id from brainstorm WHERE br_id='$idBrainsto'";
    if (SQLGetChamp($SQL) == $idUser) return 1;
    else return 0;
}

/**
 * Met à jour le paramètre $parametre du brainsto d'id $idBrainsto en le mettant à la valeur $valeur.
 * @param $idBrainsto
 * @param $parametre (etat, titre, description, nb_tours, timer_tour, relecture_timer)
 * @param $valeur (0 OU 1, String, String, Int(secondes), Int (sec), Int (sec)
 */
function setParametres($idBrainsto, $parametre, $valeur){
    $SQL="UPDATE brainstorm SET ";
    switch ($parametre){
        case 'etat':
            $SQL .= "br_etat='$valeur'";
            break;
        case 'titre':
            $SQL .= "br_titre='$valeur'";
            break;
        case 'description':
            $SQL .= "br_description='$valeur'";
            break;
        case 'nb_tours':
            $SQL .= "br_nb_tours='$valeur'";
            break;
        case 'timer_tour':
            $SQL .= "br_timer_tour='$valeur'";
            break;
        case 'relecture_timer':
            $SQL .= "br_relecture_timer='$valeur'";
            break;
    };
    $SQL .= " WHERE br_id = '$idBrainsto'";
    SQLUpdate($SQL);
}

/**
 * récupere le paramètre $parametre du brainsto d'id $idBrainsto
 * @param $idBrainsto
 * @param $parametre (etat, titre, description, nb_tours, timer_tour, relecture_timer)
 */
function getParametres($idBrainsto,$parametre){
    $SQL="SELECT $parametre FROM brainstorm WHERE br_id='$idBrainsto'";
    return parcoursRs(SQLSelect($SQL));
}

/**
 * Si elle n'existe pas, crée une card pour le brainsto $idBrainstorm pour l'utilisateur $idUser.
 * Renvoie l'id de la card créée.
 * @param $idBrainstorm
 * @param $idUser
 * @return Renvoie
 */
function createCard($idBrainsto, $idUser){
    if(SQLGetChamp("SELECT card_id from card where card_auteur_id='$idUser' AND card_brainsto_id='$idBrainsto'")==false) {
        $SQL = "INSERT INTO card(card_auteur_id, card_brainsto_id) VALUES('$idUser','$idBrainsto')";
        return SQLInsert($SQL);
    }
}

/**
 * Met à jour le code HTML de la card d'id $idCard.
 * @param $idCard
 * @param $codeHtml
 */
function majHtmlCard($idCard, $codeHtml){
    $SQL = "UPDATE card SET card_objet_html = '$codeHtml' WHERE card_id = '$idCard'";
    SQLUpdate($SQL);
}

/**
 * Récupère les utilisateurs associés à leur card du brainsto d'id $idBrainsto.
 * Renvoie un tableau associatif contenant tous les utilisateurs associés à leur card.
 * @param $idBrainstorm
 * @return array
 */
function getCardAndPseudo($idBrainstorm){
    $SQL = "SELECT user_username, card_objet_html FROM user JOIN card ON CARD_auteur_id=user_id WHERE CARD_brainsto_id='$idBrainstorm'";
    return parcoursRs(SQLSelect($SQL));
}

/**
 * Compte le nombre de card associé à un brainsto
 * Renvoie le nombre de card
 * @param $idBrainsto
 * @return int
 */
function nbCardBrainsto($idBrainsto){
    $SQL = "SELECT COUNT(*) FROM card WHERE CARD_brainsto_id='$idBrainsto'";
    return SQLGetChamp($SQL);
}

/**
 * Ajoute le $message envoyé par l'utilisateur $idUser au brainsto $idBrainsto.
 * Renvoie l'id du message envoyé (sûrement inutile, mais on sait jamais)
 * @param $idBrainsto
 * @param $idUser
 * @param $message
 * @return Renvoie
 */
function envoyerMessage($idBrainsto, $idUser, $message){
    $SQL = "INSERT INTO message(msg_contenu, msg_auteur_id, msg_brainsto_id) values('$message', '$idUser', '$idBrainsto')";
    return SQLInsert($SQL);
}

/**
 * Récupère tous les messages du brainsto d'id $idBrainsto
 * Renvoie un tableau associtatif contenant tous les messages
 * @param $idBrainsto
 * @return array
 */
function getMessages($idBrainsto){
    $SQL = "SELECT user_username, msg_contenu FROM message JOIN user ON msg_auteur_id=user_id WHERE msg_brainsto_id='$idBrainsto'";
    return parcoursRs(SQLSelect($SQL));
}

/**
 * Indique si tous les utilisateurs sont prêts.
 * Renvoie true si c'est le cas
 * @param $idBrainsto
 * @return bool
 */
function everybodyIsReady($idBrainsto){
    $SQL = "SELECT COUNT(*) FROM user WHERE USER_brainsto_courant_id='$idBrainsto'";
    $nbUser = SQLGetChamp($SQL);
    $SQL = "SELECT COUNT(*) FROM user WHERE USER_brainsto_courant_id='$idBrainsto' AND user_ready = 1";
    $nbUserReady = SQLGetChamp($SQL);
    return ($nbUser==$nbUserReady);
}