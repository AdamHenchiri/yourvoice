
<?php
//echo "Il y a " . $nbLigne . " questions";
foreach ($sections as $section) {
    //$questNonFormater = $question->getIdQuestion();
    //$questFormater = rawurlencode($questNonFormater);
    $titreSection = $section->getTitre();
    $idSection = $section->getIdSection();
    $idQuestion = $section->getIdQuestion();
    echo "boujour";
    echo $titreSection;
    echo "<li><a href=\"frontController.php?controller=section&action=read&id_question={$idSection}\"> Section  {$idSection}:\n".  htmlspecialchars ( $titreSection ) . " </a></li> ";
    echo "<li><a href=\"frontController.php?controller=section&action=update&id_section={$questFormater}\"> Mettre à jour la section </a></li>      ";
    echo "<li><a id=\"confirmation\" onclick=\"return confirmation()\" href=\"frontController.php?controller=section&action=delete&id_section={$questFormater}\"> Supprimer cette section </a></li>      ";
    echo "--------------------------------------------------------------------------\n";
}
?>
<script src="../src/js/app.js"></script>
