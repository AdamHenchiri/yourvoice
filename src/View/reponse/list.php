
<?php
foreach ($reponses as $reponse) {
    $repNonFormater = $reponse->getIdReponses();
    $repFormater = rawurlencode($repNonFormater);
    $questionNonFormater = $reponse->getIdQuestion();
    $questionFormater = rawurlencode($repNonFormater);


    echo "<li><a href=\"frontController.php?controller=reponse&action=read&id_reponse={$repFormater}\"> La réponse ".  htmlspecialchars ( $reponse->getIdRponses() ) . " </a></li> ";
    echo "<li><a href=\"frontController.php?controller=reponse&action=update&id_reponse={$repFormater}&id_question={$questionFormater}\"> ----->Mettre a jour la réponses<--------- </a></li>      ";
    echo "<li><a href=\"frontController.php?controller=reponse&action=delete&id_reponse={$repFormater}\"> ----->Supprimer cette réponse<--------- </a></li>      ";
    echo "--------------------------------------------------------------------------\n";
}

?>
