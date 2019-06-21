<?php

include_once("libs/maLibSQL.pdo.php");

/**
 * Vérifie l'identité d'un utilisateur dont les identifiants sont passés en paramètres.
 * Renvoie l'id de l'user s'il existe dans la base de donnée, false sinon
 * @param $login
 * @param $pass
 */
function verifUserBDD($login, $pass){

}

/**
 * Créer un nouvel utilisateur dans la bdd dont les identifiants sont passés en paramètres.
 * Renvoie l'id de l'user créé ou false si l'inscription a échoué.
 * @param $login
 * @param $pass
 */
function inscrireUser($login, $pass){

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
}

/**
 * Récupère le brainsto dont le code est celui spécifié en paramètre.
 * Renvoie le brainsto sous forme de tableau associatif s'il existe, false sinon.
 * @param $code
 */
function getBrainstormFromCode($code){

}

/**
 * Met à jour l'attribut ready en le mettant $ready à de l'utilisateur d'id $userId.
 * @param $userId
 * @param $ready
 */
function setUserReady($userId, $ready){

}

/**
 * Met à jour l'id du brainsto à $idBrainsto de l'utilisateur $idUser.
 * @param $idBrainsto
 * @param $idUser
 */
function setUserBrainsto($idBrainsto, $idUser){

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