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
$dateFinVote = htmlspecialchars($question->getDateFinVote());
?>

<div class="container">
    <div class="container_creerquestion">
        <div class="titre">
            <h1><?php echo htmlspecialchars($question->getIntitule()) ?></h1>
        </div>

        <div class="question_description">
            <label for="explication">Développement de la question</label>
            <div class="container_dev"> <?php echo '<p> ' . htmlspecialchars($question->getExplication()) . '.</p>'; ?> </div>
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

        $num = 0;
        foreach ($sections as $section) {
        $num++;
        //$questNonFormater = $question->getIdQuestion();
        //$questFormater = rawurlencode($questNonFormater);
        $titreSection = $section->getTitre();
        $idQuestion = $section->getIdQuestion();
        $sectionFormater = rawurlencode($section->getIdSection());
        ?>

        <div class="titre">
            <?php echo "<h1> Section: {$num} \n" . htmlspecialchars($titreSection) . " </h1> "; ?>
        </div>
        <div class="question_description">
            <div> <?php echo " Titre : " . htmlspecialchars($section->getTitre()); ?> </div>
            <div> <?php echo " Description :  " . htmlspecialchars($section->getTexteExplicatif()); ?> </div>
            <?php

            echo "<div class='separateur1'></div>";
            echo "</div>";
        }


            use App\YourVoice\Controller\ControllerVotant;
            use App\YourVoice\Lib\ConnexionUtilisateur;
            use App\YourVoice\Model\Repository\TexteRepository;
            use App\YourVoice\Model\Repository\UtilisateurRepository;
            use \App\YourVoice\Lib\ConnexionAdmin;
            foreach ($reponses as $reponse) {
                if(count(ControllerVotant::aux4()) > 1 && ConnexionUtilisateur::estOrganisateur($question)) {
                    $liste = ControllerVotant::aux4();
                    foreach ($liste as $key => $value) {
                        $cle = $key;
                        if ($cle == $reponse->getIdRponses()) {
                            $repFormater = rawurlencode($reponse->getIdRponses());
                            echo "<div class='titre'>";
                            if ($reponse->isActif() == false) {
                                $user = (new UtilisateurRepository())->select($reponse->getIdUtilisateur());
                                echo "<h1><a href=\"frontController.php?controller=reponse&action=read&id_reponse={$repFormater}\"> Réponse de " . htmlspecialchars($user->getLogin()) . " </a></h1> ";
                                ?>
            <?php echo $cle; ?>

                                <div class='question_update'>
                                <form method="get" action="frontController.php">
                                    <input type="hidden" value="voteFinal" name="action">
                                    <input type="hidden" value="reponse" name="controller">
                                    <input type="hidden" value="<?php echo $cle; ?>" name="id_reponse" >
                                    <input type="hidden" value="<?php echo $idQuestion; ?>" name="id_question" >

                                <input id="valider" type="submit" value="&#x1F451;" name="valider" />

                                </form>
            <?php

                            }


                        }

            echo "</div>";


                    }
                }

                $num++;
                //$questNonFormater = $question->getIdQuestion();
                //$questFormater = rawurlencode($questNonFormater);
                $repNonFormater = $reponse->getIdRponses();
                $repFormater = rawurlencode($repNonFormater);
                $t = (new TexteRepository())->selectWhere("id_reponse", $repNonFormater);


                ?>
                <div class="titre">
                <?php
                if (ConnexionUtilisateur::estResponsableReponse($reponse) || ConnexionUtilisateur::estCoAuteurReponse($reponse) || ConnexionAdmin::estConnecte() && $reponse->isActif() == false) {
                    $user = (new UtilisateurRepository())->select($reponse->getIdUtilisateur());
                    echo "<h1><a href=\"frontController.php?controller=reponse&action=read&id_reponse={$repFormater}\"> Réponse de " . htmlspecialchars($user->getLogin()) . " </a></h1> "; ?>
                    </div>
                    <?php
                    echo "<div class='question_description'>";
                    echo "<div class='question_update'>";
                    //echo "<a href=\"frontController.php?controller=reponse&action=read&id_reponse={$repFormater}\"> La réponse ".  htmlspecialchars ( $reponse->getIdRponses() ) . " </a></> ";
                    if (date('Y-m-d H:i:s') >= $dateDebutRedaction && date('Y-m-d H:i:s') <= $dateFinRedaction && ConnexionUtilisateur::estResponsableReponse($reponse) || ConnexionAdmin::estConnecte() ) {
                        if (empty($t)) {
                            echo "<a href=\"frontController.php?controller=reponse&action=create&id_reponse={$repFormater}&id_question={$idQuestion}\"> <i class='fa-solid fa-pencil'></i> </a>     ";
                            echo "<a href=\"frontController.php?controller=reponse&action=check&id_reponse={$repFormater}\"> <i class='fa-solid fa-trash'></i></a>      ";
                        } else {
                            echo "<a href=\"frontController.php?controller=reponse&action=update&id_reponse={$repFormater}&id_question={$idQuestion}\"> <i class='fa-solid fa-pencil'></i> </a>     ";
                            echo "<a href=\"frontController.php?controller=reponse&action=check&id_reponse={$repFormater}\"> <i class='fa-solid fa-trash'></i></a>      ";
                        }
                        echo "</div>";
                        echo "<div class='separateur1'></div>";
                        echo "</div>";  
                    } else if (date('Y-m-d H:i:s') >= $dateDebutRedaction && date('Y-m-d H:i:s') <= $dateFinRedaction && ConnexionUtilisateur::estCoAuteurReponse($reponse)) {
                        if (empty($t)) {
                            echo "<a href=\"frontController.php?controller=reponse&action=create&id_reponse={$repFormater}&id_question={$idQuestion}\"> <i class='fa-solid fa-pencil'></i> </a>     ";
                        } else {
                            echo "<a href=\"frontController.php?controller=reponse&action=update&id_reponse={$repFormater}&id_question={$idQuestion}\"> <i class='fa-solid fa-pencil'></i> </a>     ";
                        }
                        echo "</div>";
                        echo "<div class='separateur1'></div>";
                        echo "</div>";
                    } else {
                        echo "</div>";
                        echo "<div class='separateur1'></div>";
                        echo "</div>";
                    }
                }
            }

            ?>
</body>
<script src="../src/js/app.js"></script>
</html>