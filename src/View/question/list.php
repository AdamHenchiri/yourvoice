<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des utilisateurs</title>
</head>
<body>
<?php
foreach ($questions as $question) {
    //$questNonFormater = $question->getIdQuestion();
    //$questFormater = rawurlencode($questNonFormater);

    echo "<li><a> les questions :\n".  htmlspecialchars ( $question->getExplication() ) . " </a></li> ";
    //echo "<li><a href=\"frontController.php?controller=utilisateur&action=update&login={$userFormater}\"> ----->Mettre a jour les info de l'utilisateur<--------- </a></li>      ";
    //echo "<li><a href=\"frontController.php?controller=utilisateur&action=delete&login={$userFormater}\"> ----->Supprimer cette utilisateur<--------- </a></li>      ";
    echo "--------------------------------------------------------------------------\n";
}
?>
</body>
</html>
