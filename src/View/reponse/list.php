<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des utilisateurs</title>
</head>
<body>
<?php
foreach ($reponses as $reponse) {
    $repNonFormater = $reponse->getLogin();
    $repFormater = rawurlencode($repNonFormater);

    echo "<li><a href=\"frontController.php?controller=reponse&action=read&login={$repFormater}\"> La réponse ".  htmlspecialchars ( $reponse->getIdRponses() ) . " </a></li> ";
    echo "<li><a href=\"frontController.php?controller=reponse&action=update&login={$repFormater}\"> ----->Mettre a jour la réponses<--------- </a></li>      ";
    echo "<li><a href=\"frontController.php?controller=reponse&action=delete&login={$repFormater}\"> ----->Supprimer cette réponse<--------- </a></li>      ";
    echo "--------------------------------------------------------------------------\n";
}

?>
</body>
</html>
