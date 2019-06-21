<?php

include_once("maLibSQL.pdo.php");
include_once("config.php");

/**
 * Vérifie l'identité d'un utilisateur dont les identifiants sont passés en paramètres.
 * Renvoie l'id de l'user s'il existe dans la base de donnée, false sinon
 * @param $login
 * @param $pass
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
 */
function inscrireUser($login, $pass){
    $SQL ="INSERT INTO USER(USER_USERNAME, USER_PASSWORD) VALUES('$login', '$pass')";
    SQLInsert($SQL);
}

/**
 * Génère un code
 * Crée un brainsto ayant pour admin l'utilisateur d'id $idUserMaster, pour titre $titre, et pour description $description.
 * Renvoie l'id du brainsto créé.
 * @param $idUserMaster
 * @param $titre
 * @param $description
 */
function createBrainstorm($idUserMaster, $titre, $description){
    // le code informatique qui crée le code du brainsto (genre #E45R1) qui est envoyé dans la requete SQL
    // A REVOIR COMMENT ON CREE LE CODE
    $SQL ="INSERT INTO BRAINSTORM(BR_CODE, BR_MASTER_ID, BR_titre, br_description) VALUES((SELECT FLOOR(rand() * 90000 + 10000)), '$idUserMaster', '$titre', '$description')";
    SQLInsert($SQL);
}

/**
 * Récupère le brainsto dont le code est celui spécifié en paramètre.
 * Renvoie le brainsto sous forme de tableau associatif s'il existe, false sinon.
 * @param $code
 */
function getBrainstormFromCode($code){
    $SQL = "SELECT * from BRAINSTORM WHERE BR_CODE='$code' ";
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
 * Met à jour l'id du brainsto courant à $idBrainsto de l'utilisateur $idUser.
 * @param $idBrainsto
 * @param $idUser
 */
function setUserBrainsto($idBrainsto, $userId){
    $SQL = "UPDATE user SET user_brainsto_courant_id = '$idBrainsto' WHERE user_id='$userId'";
    SQLUpdate($SQL);
}

/**
 * Récupère les utilisateurs présents dans le brainsto d'id $idBrainsto.
 * Renvoie un tableau associatif contenant tous les champs des utilisateurs (sans le mot de passe).
 * @param $idBrainsto
 */
function getListUser($idBrainsto){

}

/**
 * Indique si l'utilisateur d'id $idUser est master du brainsto d'id $idBrainsto.
 * Renvoie true si l'utilisateur est master du brainsto, false s'il ne l'est pas ou que un des id est incorrect.
 * @param $idUser
 */
function isMaster($idBrainsto, $idUser){

}

/**
 * Met à jour le paramètre $parametre du brainsto d'id $idBrainsto en le mettant à la valeur $valeur.
 * @param $idBrainsto
 * @param $parametre
 * @param $valeur
 */
function setParametres($idBrainsto, $parametre, $valeur){

}

/**
 * Crée une card dans le brainsto d'id $idBrainstorm en l'associant à l'utilisateur d'id $idUser.
 * Renvoie l'id de la card créée.
 * @param $idBrainstorm
 * @param $idUser
 */
function createCard($idBrainsto, $idUser){

}

/**
 * Met à jour le code HTML de la card d'id $idCard.
 * @param $idCard
 * @param $codeHtml
 */
function majHtmlCard($idCard, $codeHtml){

}

/**
 * Récupère les utilisateurs associés à leur card du brainsto d'id $idBrainsto.
 * Renvoie un tableau associatif contenant tous les utilisateurs associés à leur card.
 * @param $idBrainstorm
 */
function getCardAndPseudo($idBrainstorm){

}

/**
 * Ajoute le message $message envoyé par l'utilisateur $idUser au brainsto d'id $idBrainsto
 * @param $idBrainsto
 * @param $idUser
 * @param $message
 */
function envoyerMessage($idBrainsto, $idUser, $message){

}

/**
 * Récupère tous les messages du brainsto d'id $idBrainsto
 * Renvoie un tableau associtatif contenant tous les messages
 * @param $idBrainsto
 */
function getMessages($idBrainsto){

}