<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>detail voiture</title>
</head>
<body>
<?php
$dateDebutRedaction = htmlspecialchars($question->getDateDebutRedaction());
$dateFinRedaction = htmlspecialchars($question->getDateFinRedaction());
$dateDebutVote = htmlspecialchars($question->getDateDebutVote());
$dateFinVote = htmlspecialchars($question->getDateFinVote()); ;
//echo date('d-m-Y', strtotime($date));
//echo date('d-m-Y',htmlspecialchars($question->getDateDebutRedaction()));
echo '<p> Intitulé : ' . htmlspecialchars($question->getIntitule()) . '.</p>';
echo '<p> Développement de la question :  ' . htmlspecialchars($question->getExplication()) . '.</p>';
echo '<p> Date de début de la rédaction :  ' . date('d-m-Y', strtotime($dateDebutRedaction)) . '.</p>';
echo '<p> Date de fin de la rédaction :  ' .  date('d-m-Y', strtotime($dateFinRedaction)) . '.</p>';
echo '<p> Date de début des votes :  ' .  date('d-m-Y', strtotime($dateDebutVote)) . '.</p>';
echo '<p> Date de fin des votes :  ' .  date('d-m-Y', strtotime($dateFinVote)) . '.</p>';






echo '<p> ------------------------------------------------------------------</p>';

//require __DIR__. '/../section/list.php';

foreach ($sections as $section) {
    //$questNonFormater = $question->getIdQuestion();
    //$questFormater = rawurlencode($questNonFormater);
    $titreSection = $section->getTitre();
    $numeroSection = $section->getNumero();
    $idQuestion = $section->getIdQuestion();
    $sectionFormater = rawurlencode($section->getIdSection());
    echo "<li> Section: {$numeroSection}:\n".  htmlspecialchars ( $titreSection ) . " </li> ";
    echo "<li><a href=\"frontController.php?controller=section&action=read&id_section={$sectionFormater}\"> section {$numeroSection}:\n".  htmlspecialchars ( $titreSection ) . " </a></li> ";
    echo "<li><a href=\"frontController.php?controller=section&action=update&id_section={$sectionFormater}\"> Mettre a jour la section </a></li>      ";
    echo "<li><a id=\"confirmation\" onclick=\"return confirmationSection()\" href=\"frontController.php?controller=section&action=delete&id_section={$sectionFormater}\"> Supprimer cette section </a></li>      ";
    echo "--------------------------------------------------------------------------\n";
}

?>
</body>
<script src="../src/js/app.js"></script>
</html><?php