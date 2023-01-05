
<div class="container_liste_question">
    <div class="container_question">
        <?php


        use App\YourVoice\Lib\ConnexionUtilisateur;
        use App\YourVoice\Model\Repository\ReponseRepository;
        use App\YourVoice\Model\Repository\TexteRepository;
        use App\YourVoice\Model\Repository\UtilisateurRepository;
        use App\YourVoice\Model\Repository\VotantRepository;

        echo "<div class='container_question1'>";
    echo "<div class='titrelistequestion'>";
        echo "<div id='apparait' class='cacher'>";
        echo "</div>";
        echo "<h1><a href=\"frontController.php?controller=question&action=read&id_question={$_GET['id_question']}\"> Questions " . $_GET['id_question']  ."</a></h1>";
    echo "</div>";
echo "</div>";


foreach ($votants as $votant){
    $reponse =(new ReponseRepository())->select($votant->getIdReponse());

    if($reponse->getIdQuestion() == $id_question){

    $repNonFormater = $reponse->getIdRponses();
    $repFormater = rawurlencode($repNonFormater);
    $questionNonFormater = $reponse->getIdQuestion();
    $questionFormater = rawurlencode($repNonFormater);
    $allTexte = (new TexteRepository())->selectWhere('id_reponse', $repNonFormater);
    if(!empty($allTexte)){
        echo "pas de texte";

echo "<div class='questions'>";
        echo "<a id='titrequestion' href=\"frontController.php?controller=reponse&action=read&id_reponse={$repFormater}\"> Réponse {$repNonFormater} :\n" . htmlspecialchars("") . " </a>";

        echo "<div class='question_update'>";

        if(is_null($votant->getVote()) ){
    ?>

        <form method="get" action="frontController.php">
            <input type="hidden" value="vote" name="action">
            <input type="hidden" value="reponse" name="controller">
            <input type="hidden" value="<?php echo $repNonFormater; ?>" name="id_reponse" >
            <input type="hidden" value="<?php echo $questionNonFormater; ?>" name="id_question" >
            <input type="hidden" value="<?php echo $votant->getIdUtilisateur(); ?>" name="id" >
            <?php echo $repNonFormater . "// " . $questionNonFormater . "/// " . $votant->getIdUtilisateur() ;

            ?>

            <p>&#128540;
            <input type="radio" name="vote" id="Idpositif" value="positif">Aime
            </p>
            <p>&#128528;
            <input type="radio" name="vote" id="Idneutre" value="neutre">Neutre
            </p>
            <p>&#128577;
            <input type="radio" name="vote" id="Idnegatif" value="negatif">Aime pas
            </p>

            <input type="hidden" placeholder="serra rempli automatiquement avec les sessions" name="id_votant" id="id_votant" value="<?php ConnexionUtilisateur::getUtilisateurConnecte()->getIdUtilisateur()?>" required/>

            <input id="valider" type="submit" value="valider" name="valider" />
            <?php

        }
        else{
            if($votant->getVote() == 1) {
                echo "Vous avez voté &#128540; : Aime ";
            }
            if($votant->getVote() == 0) {
                echo "Vous avez voté &#128528; : Neutre ";
            }
            if($votant->getVote() == -1) {
                echo "Vous avez voté &#128577; : Aime pas ";
            }
        }

        ?>
        </form>


            <?php
    }



echo"</div>";
echo"</div>";

}
}
?>


    </div>
</div>



