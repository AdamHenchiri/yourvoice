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


        $num=0;
        foreach ($sections as $section) {
        $num++;

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

                echo "</div>";
                echo "<div class='separateur1'></div>";

            }
            echo "<div class='separateur1'></div>";
            echo "</div>";



            }


            $num++;

            if(isset($trouve) && $trouve == 2){
                echo "<div class='titre'>";
                echo "<p>Il y a une égalité. En attente de la décision finale</p>";
                echo "</div>";
            }
            else if(isset($trouve) && $trouve == 0){
                echo "<div class='titre'>";
                echo "<p>Il n'y a pas de réponse pour cette question.</p>";
                echo "</div>";
            }
            else{
                foreach ($reponses as $reponse) {
                    $repNonFormater = $reponse->getIdRponses();
                    $repFormater = rawurlencode($repNonFormater);

                    ?>
                    <div class="titre">
                        <?php
                        $user=(new UtilisateurRepository())->select($reponse->getIdUtilisateur());
                        echo "<h1><a href=\"frontController.php?controller=reponse&action=read&id_reponse={$repFormater}\"> Réponse de ".  htmlspecialchars ( $user->getLogin() ) . " </a></h1> "; ?>
                    </div>
                    <?php

                }}
            echo "<div class='separateur1'></div>";



            ?><body>
            <script src="../src/js/app.js"></script>
</html>