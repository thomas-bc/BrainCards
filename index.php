<?php
session_start();

include_once "libs/maLibUtils.php";
include_once "libs/maLibSecurisation.php";







// on récupère le paramètre view éventuel
$view = valider("view");

// S'il est vide, on charge la vue définie par défaut
if (!$view) $view = "accueil";

switch($view)
{

//		case "accueil" :
//			include("templates/accueil.php");
//		break;
    default : // si le template correspondant à l'argument existe, on l'affiche
        if (file_exists("templates/$view.php"))
            include("templates/$view.php");

}

// si besoin on met un footer
include("templates/z_footer_provisoire.php");
include("templates/footer_debug_php.php");