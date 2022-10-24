<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des utilisateurs</title>
</head>
<body>
<?php
foreach ($utilisateurs as $utilisateur) {
    $userNonFormater = $utilisateur->getLogin();
    $userFormater = rawurlencode($userNonFormater);

    echo "<li><a href=\"frontController.php?controller=utilisateur&action=read&login={$userFormater}\"> l'utilisateur ".  htmlspecialchars ( $utilisateur->getLogin() ) . " </a></li> ";
    echo "<li><a href=\"frontController.php?controller=utilisateur&action=update&login={$userFormater}\"> ----->Mettre a jour les info de l'utilisateur<--------- </a></li>      ";
    echo "<li><a href=\"frontController.php?controller=utilisateur&action=delete&login={$userFormater}\"> ----->Supprimer cette utilisateur<--------- </a></li>      ";
    echo "--------------------------------------------------------------------------\n";
}
echo "<div><a href=\"frontController.php?controller=utilisateur&action=create\"> ajouter un utilisateur</a></div> ";
?>
</body>
</html>
