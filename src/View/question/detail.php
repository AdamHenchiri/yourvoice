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
    echo "<li> Section: {$numeroSection}:\n".  htmlspecialchars ( $titreSection ) . " </li> ";

    echo "--------------------------------------------------------------------------\n";
}

?>
</body>
</html><?php