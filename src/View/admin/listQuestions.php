<div class="container_liste_question">
    <div class="container_question">
        <?php

        use App\YourVoice\Lib\ConnexionUtilisateur;
        use App\YourVoice\Model\Repository\CoauteurRepository;
        use App\YourVoice\Model\Repository\ReponseRepository;

        echo "<div class='container_question1'>";
        echo "<div class='titrelistequestion'>";
        echo "<div id='apparait' class='cacher'>";
        echo "<a id='nombrequestion'>Nombre de questions<a>";
        echo "<a>(clickez !)</a>";
        echo "</div>";
        echo "<h1>Questions</h1>";
        echo "</div>";
        echo "</div>";
        $nbLigne = 0;
        foreach ($questions as $question) {

            $questNonFormater = $question->getIdQuestion();
            $questFormater = rawurlencode($questNonFormater);
            $reponses = (new ReponseRepository())->selectWhere("id_question", $questNonFormater);
            $dateDebutRedaction = htmlspecialchars($question->getDateDebutRedaction());
            $dateFinRedaction = htmlspecialchars($question->getDateFinRedaction());
            $nbLigne++;
            echo "<div class='questions'>";
            echo "<a id='titrequestion' href=\"frontController.php?controller=question&action=readMy&id_question={$questFormater}\"> Question {$question->getIdQuestion()} :\n" . htmlspecialchars($question->getIntitule()) . " </a>";
            echo "<div class='question_update'>";
            echo "<a href=\"frontController.php?controller=question&action=update&id_question={$questFormater}\"> <i class='fa-solid fa-pencil'></i> </a>";
            if (!$question->isActif()) {
                echo "<a id=\"confirmation\" href=\"frontController.php?controller=question&action=delete&id_question={$questFormater}\"> <i class='fa-solid fa-trash'></i></a>";
            }else{
                echo "<a  href=\"frontController.php?controller=question&action=restaurer&id_question={$questFormater}\"> <i class='fa-solid fa-trash-arrow-up'></i></a>";

            }
            echo "</div>";
            echo "</div>";


        }


        ?>
    </div>
</div>
<script src="../src/js/app.js"></script>

<script>
    var public = true;
    var boutton = document.getElementById("apparait")
    boutton.addEventListener("click", () => {
        if (public) {
            boutton.classList.add("show");
            boutton.classList.remove("cacher");
            public = false;
            boutton.innerHTML = '<?php echo "<a> $nbLigne </a>"; ?>';

        } else {
            boutton.classList.add("cacher");
            boutton.classList.remove("show");
            public = true;
            boutton.innerHTML = '<a>Nombre de questions</a><a>(clickez !)</a>';
        }
    });
</script>

