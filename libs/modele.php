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
 * Renvoie l'id de l'user créé ou false si l'inscription a échoué
 * @param $login
 * @param $pass
 */
function inscrireUser($login, $pass){

}

/**
 * Récupère le brainsto dont le code est celui spécifié en paramètre.
 * Renvoie le brainsto sous forme de tableau associatif s'il existe, false sinon
 * @param $code
 */
function getBrainstormFromCode($code){

}

/**
 * @param $code
 */
function getChatFromCode($code){

}

/**
 * Met à jour l'attribut ready en le mettant $ready à de l'utilisateur d'id $userId
 * Renvoie true si l'opération s'est bien passée, false sinon
 * @param $userId
 * @param $ready
 */
function setReady($userId, $ready){

}

/**
 * Met à jour l'id du brainsto à $idBrainsto de l'utilisateur $idUser
 * Renvoie true si l'opération s'est bien passée, false sinon
 * @param $idBrainsto
 * @param $idUser
 */
function setBrainsto($idBrainsto, $idUser){

}

/**
 * Récupère les utilisateurs présents dans le brainsto d'id $idBrainsto
 * Renvoie un tableau associatif contenant tous les champs des utilisateurs (sans le mot de passe)
 * @param $idBrainsto
 */
function getListUser($idBrainsto){

}

/**
 * Indique si l'utilisateur d'id $idUser est master du brainsto d'id $idBrainsto
 * Renvoie true si l'utilisateur est master du brainsto, false s'il ne l'est pas ou que un des id est incorrect
 * @param $idUser
 */
function isMaster($idBrainsto, $idUser){

}


function setParametres($parametre, $valeur){

}

function createCard($idBrainstorm, $idUser){

}

function majHtmlCard($idCard, $codeHtml){

}

function getCardAndPseudo($idBrainstorm){

}

