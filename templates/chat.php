<?php
// Si la page est appelée directement par son adresse, on redirige vers la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php");
    die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");

// On récupère l'id de la conversation à afficher, dans idConv
$idBrainsto = getValue("BR_id");

if (!$idBrainsto)
{
    die("idBrainsto manquant");
}

// Les messages
$messages = getMessages($idBrainsto);

foreach($messages as $dataMessage) {
    echo '<div>';
    echo "[" . $dataMessage["msg_auteur_id"] . "] " ;
    echo $dataMessage["msg_contenu"];
    echo "</div>\n";
}
echo '<form action="controleur.php" method="GET" >';

echo '<input type="text" name="message" >';
echo '<input type="hidden" name="idBrainsto" value="$idBrainsto" > ';
echo '<input type="submit" name="action" value="poster" >';

echo '</form>';
?>


<script>
    // DANS 10 SECONDES, Raffraichir la page
        window.setTimeout(fnReload,10000);

        function fnReload(){
            document.location.reload();
        }
</script>


<h1>Chat</h1>