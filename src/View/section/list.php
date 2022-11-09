<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des sections</title>
</head>
<body>
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

    echo "--------------------------------------------------------------------------\n";
}
?>
</body>
</html>