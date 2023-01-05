
<?php
echo '<div class="container">';
echo '<div class="container_creerquestion">';
echo '<h1 class="titre-liste-utilisateur">Liste des utilisateurs</h1>';
foreach ($utilisateurs as $utilisateur) {
    $userNonFormater = $utilisateur->getLogin();
    $userFormater = rawurlencode($userNonFormater);
    $userIdFormater = rawurlencode($utilisateur->getIdUtilisateur());

    echo "<li><a href=\"frontController.php?controller=utilisateur&action=read&login={$userFormater}\"> l'utilisateur ".  htmlspecialchars ( $utilisateur->getLogin() ) ;
    if ($utilisateur->isDemandeOrga()){
        echo ">>>>>👋". " </a></li> ";
    }
    echo " </a></li> <li><a href=\"frontController.php?controller=utilisateur&action=update&login={$userIdFormater}\"> ----->Mettre a jour les info de l'utilisateur<--------- </a></li>      ";
    echo "<li><a href=\"frontController.php?controller=utilisateur&action=delete&login={$userFormater}\"> ----->Supprimer cette utilisateur<--------- </a></li>      ";
    if ($utilisateur->isEstOrganisateur()){
        echo "<li><a href=\"frontController.php?controller=admin&action=neplusdevenirOrga&login={$userIdFormater}\"> ----->🟩<--------- </a></li>      ";
    }else{
        echo "<li><a href=\"frontController.php?controller=admin&action=devenirOrga&login={$userIdFormater}\"> ----->🟥<--------- </a></li>      ";

    }
    echo "--------------------------------------------------------------------------\n";
}
echo "<div><a href=\"frontController.php?controller=utilisateur&action=create\"> ajouter un utilisateur</a></div> ";
echo "<div><a href=\"frontController.php?controller=admin&action=create\"> ajouter un administrateur</a></div> ";
echo '</div>';
echo '</div>';
?>

