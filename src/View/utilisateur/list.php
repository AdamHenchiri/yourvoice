
<?php
echo '<div class="container">';
echo '<div class="container_creerquestion">';
echo '<h1 class="titre-liste-utilisateur">Liste des utilisateurs</h1>';

echo '<div class="container-list-admin1">';
echo '<div class="container-info-admin1">';
echo '<p>Organisateur</p>';
echo '</div>';
echo '<div class="container-info-admin1">';
echo '<p>Identifiant</p>';
echo '</div>';
echo '<div class="container-info-admin1">';
echo '<p>Mettre à jour utilisateur</p>';
echo '</div>';
echo '<div class="container-info-admin1">';
echo "<p>Supprimer l'utilisateur</p>";
echo '</div>';
echo '</div>';
foreach ($utilisateurs as $utilisateur) {
    $userNonFormater = $utilisateur->getLogin();
    $userFormater = rawurlencode($userNonFormater);
    $userIdFormater = rawurlencode($utilisateur->getIdUtilisateur());

    echo '<div class="container-list-admin">';
    echo '<div class="container-info-admin">';
    if ($utilisateur->isEstOrganisateur()){
        echo "<a href=\"frontController.php?controller=admin&action=neplusdevenirOrga&login={$userIdFormater}\"><i id='croix-rouge' class='fa-solid fa-xmark'></i></a>      ";
    }else{
        echo "<a href=\"frontController.php?controller=admin&action=devenirOrga&login={$userIdFormater}\"><i id='validez' class='fa-solid fa-check'></i></a>      ";

    }
    echo '</div>';
    echo '<div class="container-info-admin">';
    echo
    "<a class='info-admin' href=\'frontController.php?controller=utilisateur&action=read&login={$userFormater}\'>"?> <?php
    if($utilisateur->isDemandeOrga()){echo '<i id="cloche" class="fa-solid fa-bell"></i> ' . htmlspecialchars ( $utilisateur->getLogin() );}else{ echo htmlspecialchars ( $utilisateur->getLogin() );}
    echo "</a>" ;
    echo '</div>';

    echo '<div class="container-info-admin">';
    echo " <a class='info-admin' href=\"frontController.php?controller=utilisateur&action=update&login={$userIdFormater}\">Mettre à jour</a>      ";
    echo '</div>';
    echo '<div class="container-info-admin">';
    echo "<a class='info-admin' href=\"frontController.php?controller=utilisateur&action=delete&login={$userFormater}\">Supprimer</a>      ";
    echo '</div>';
    echo '</div>';
}

echo '<div class="ajout-admin">';
echo "<a id='ajout-admin-texte' href=\"frontController.php?controller=utilisateur&action=create\"> Ajouter un utilisateur</a> ";
echo "<a id='ajout-admin-texte' href=\"frontController.php?controller=admin&action=create\"> Ajouter un administrateur</a> ";
echo '</div>';
echo '</div>';
echo '</div>';
?>

