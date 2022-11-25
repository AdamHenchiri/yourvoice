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
$num=0;
foreach ($sections as $section) {
    $num++;
    //$questNonFormater = $question->getIdQuestion();
    //$questFormater = rawurlencode($questNonFormater);
    $titreSection = $section->getTitre();
    $idQuestion = $section->getIdQuestion();
    $sectionFormater = rawurlencode($section->getIdSection());
    echo "<li> Section: {$num} \n".  htmlspecialchars ( $titreSection ) . " </li> ";
    echo "<li><a href=\"frontController.php?controller=section&action=read&id_section={$sectionFormater}\"> section :\n".  htmlspecialchars ( $titreSection ) . " </a></li> ";
    echo "<li><a href=\"frontController.php?controller=section&action=update&id_section={$sectionFormater}&id_question={$idQuestion}\"> Mettre a jour la section </a></li>      ";
    echo "<li><a id=\"confirmation\" onclick=\"return confirmationSection()\" href=\"frontController.php?controller=section&action=delete&id_section={$sectionFormater}&id_question={$idQuestion}\"> Supprimer cette section </a></li>      ";
    echo "--------------------------------------------------------------------------\n";
}
echo "<li><a href=\"frontController.php?controller=section&action=create&id_question={$idQuestion}\"> Ajouter une section </a></li>      ";

    echo "--------------------------------------------------------------------------\n";

foreach ($reponses as $reponse) {
    $num++;
    //$questNonFormater = $question->getIdQuestion();
    //$questFormater = rawurlencode($questNonFormater);
    $repNonFormater = $reponse->getIdRponses();
    $repFormater = rawurlencode($repNonFormater);

    echo "<li><a href=\"frontController.php?controller=reponse&action=read&id_reponse={$repFormater}\"> La réponse ".  htmlspecialchars ( $reponse->getIdRponses() ) . " </a></li> ";
    echo "<li><a href=\"frontController.php?controller=reponse&action=update&id_reponse={$repFormater}\"> ----->Mettre a jour la réponses<--------- </a></li>      ";
    echo "<li><a href=\"frontController.php?controller=reponse&action=delete&id_reponse={$repFormater}\"> ----->Supprimer cette réponse<--------- </a></li>      ";
    echo "--------------------------------------------------------------------------\n";
}
echo "<li><a href=\"frontController.php?controller=reponse&action=create&id_question={$idQuestion}\"> Créer une réponse </a></li>      ";


?>
</body>
<script src="../src/js/app.js"></script>
</html><?php