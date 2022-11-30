<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>detail question</title>
</head>
<body>
<?php
$dateDebutRedaction = htmlspecialchars($question->getDateDebutRedaction());
$dateFinRedaction = htmlspecialchars($question->getDateFinRedaction());
$dateDebutVote = htmlspecialchars($question->getDateDebutVote());
$dateFinVote = htmlspecialchars($question->getDateFinVote()); ;
?>

<div class="container">
    <div class="container_creerquestion">
        <div class="titre">
            <h1><?php  echo htmlspecialchars($question->getIntitule()) ?></h1>
        </div>

        <div class="question_description">
            <label for="explication">Développement de la question</label>
            <div class="container_dev"> <?php  echo '<p> ' . htmlspecialchars($question->getExplication()) . '.</p>'; ?> </div>
        </div>


        <div class="separateur1">
        </div>


    <div class="container_date">
        <?php
//echo date('d-m-Y', strtotime($date));
//echo date('d-m-Y',htmlspecialchars($question->getDateDebutRedaction()));
//echo '<p> Intitulé : ' . htmlspecialchars($question->getIntitule()) . '.</p>';
  // echo '<p> Développement de la question :  ' . htmlspecialchars($question->getExplication()) . '.</p>';
        echo '<div class="date_redac">';
        echo '<div class="date_all">';
echo '<p> Date de début de la rédaction :  ' . '<p id="contour_date">' . date('d/m/Y', strtotime($dateDebutRedaction)) . '</p>' . '</p>';
    echo '</div>';
    echo '<div class="date_all">';
echo '<p> Date de fin de la rédaction :  ' . '<p id="contour_date">' . date('d/m/Y', strtotime($dateFinRedaction)) . '</p>' . '</p>';
    echo '</div>';
echo '</div>';
echo '<div class="date_redac">';
echo '<div class="date_all">';
echo '<p> Date de début des votes :  ' . '<p id="contour_date">' . date('d/m/Y', strtotime($dateDebutVote)) . '</p>' . '</p>';
echo '</div>';
echo '<div class="date_all">';
echo '<p> Date de fin des votes :  ' . '<p id="contour_date">' . date('d/m/Y', strtotime($dateFinVote)) . '</p>' . '</p>';
echo '</div>';
echo '</div>'
?>
    </div>
<div class="separateur1">
        </div>




<?php

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
    echo "<li><a href=\"frontController.php?controller=reponse&action=update&id_reponse={$repFormater}&id_question={$idQuestion}\"> ----->Créer/Mettre à jour la réponses<--------- </a></li>      ";
    echo "<li><a href=\"frontController.php?controller=reponse&action=delete&id_reponse={$repFormater}\"> ----->Supprimer cette réponse<--------- </a></li>      ";
    echo "--------------------------------------------------------------------------\n";
}


?>
</body>
<script src="../src/js/app.js"></script>
</html><?php