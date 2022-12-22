<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>detail question</title>
</head>
<body>
<?php

use App\YourVoice\Model\Repository\UtilisateurRepository;

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
?>

    <div class="titre">
    <?php echo "<h1> Section: {$num} \n".  htmlspecialchars ( $titreSection ) . " </h1> "; ?>
    </div>
    <div class="question_description">
        <div > <?php  echo " Titre : " . htmlspecialchars($section->getTitre()); ?> </div>
        <div > <?php  echo " Description :  " . htmlspecialchars($section->getTexteExplicatif()) ; ?> </div>
        <?php
        if(date('Y-m-d H:i:s') < $dateDebutRedaction) {
           // echo "<div class='question_update'>";
           // echo "<a href=\"frontController.php?controller=section&action=update&id_section={$sectionFormater}&id_question={$idQuestion}\"> <i class='fa-solid fa-pencil'></i> </a>";
           // echo "<a id=\"confirmation\" onclick=\"return confirmationSection()\" href=\"frontController.php?controller=section&action=delete&id_section={$sectionFormater}&id_question={$idQuestion}\"> <i class='fa-solid fa-trash'></i></a>";
            echo "</div>";
            echo "<div class='separateur1'></div>";
            //echo "</div>";
        }
        echo "<div class='separateur1'></div>";
        echo "</div>";


        //echo "<li><a href=\"frontController.php?controller=section&action=read&id_section={$sectionFormater}\"> section :\n".  htmlspecialchars ( $titreSection ) . " </a></li> ";
    //echo "<p> Titre : " . htmlspecialchars($section->getTitre())."</p>" ;
    //echo ' Description :  ' . htmlspecialchars($section->getTexteExplicatif())  ;
    //echo "<a href=\"frontController.php?controller=section&action=update&id_section={$sectionFormater}&id_question={$idQuestion}\"> Mettre a jour la section </a>      ";
   // echo "<a id=\"confirmation\" onclick=\"return confirmationSection()\" href=\"frontController.php?controller=section&action=delete&id_section={$sectionFormater}&id_question={$idQuestion}\"> Supprimer cette section </a>     ";
   // echo "--------------------------------------------------------------------------\n";
}

/*
    echo "<div class='question_description'>";
    echo "<a href=\"frontController.php?controller=section&action=create&id_question={$idQuestion}\"> Ajouter une section </a> ";
    echo "</div>";

    //echo "--------------------------------------------------------------------------\n";
        echo "<div class='separateur1'></div>";
*/

//echo $cle;
//foreach ($reponses as $reponse) {
    $num++;
    //$questNonFormater = $question->getIdQuestion();
    //$questFormater = rawurlencode($questNonFormater);
    $repNonFormater = $reponse->getIdRponses();
    $repFormater = rawurlencode($repNonFormater);

    ?>
    <div class="titre">
    <?php
    $user=(new UtilisateurRepository())->select($reponse->getIdUtilisateur());
    echo "<h1><a href=\"frontController.php?controller=reponse&action=read&id_reponse={$repFormater}\"> Réponse de ".  htmlspecialchars ( $user->getLogin() ) . " </a></h1> "; ?>
    </div>
    <?php
    echo "<div class='question_description'>";
    echo "<div class='question_update'>";
    //echo "<a href=\"frontController.php?controller=reponse&action=read&id_reponse={$repFormater}\"> La réponse ".  htmlspecialchars ( $reponse->getIdRponses() ) . " </a></> ";
    /*if(date('Y-m-d H:i:s') >= $dateDebutRedaction && date('Y-m-d H:i:s') <= $dateFinRedaction ) {
        echo "<a href=\"frontController.php?controller=reponse&action=update&id_reponse={$repFormater}&id_question={$idQuestion}\"> <i class='fa-solid fa-pencil'></i> </a>     ";
      QSZ  echo "<a href=\"frontController.php?controller=reponse&action=delete&id_reponse={$repFormater}\"> <i class='fa-solid fa-trash'></i></a>      ";
        //echo "--------------------------------------------------------------------------\n";
        echo"</div>";
        echo "<div class='separateur1'></div>";
        echo "</div>";
    }
    else{
    echo "<a href=\"frontController.php?controller=reponse&action=delete&id_reponse={$repFormater}\"> <i class='fa-solid fa-trash'></i></a>      ";
    //echo "--------------------------------------------------------------------------\n";


} */

    echo"</div>";
    echo "<div class='separateur1'></div>";
    echo "</div>";
//}




?><body>
<script src="../src/js/app.js"></script>
</html><?php