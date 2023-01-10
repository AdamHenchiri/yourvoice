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
            if (ConnexionUtilisateur::estOrganisateur($question)) {

                $questNonFormater = $question->getIdQuestion();
                $questFormater = rawurlencode($questNonFormater);
                $reponses = (new ReponseRepository())->selectWhere("id_question", $questNonFormater);
                $dateDebutRedaction = htmlspecialchars($question->getDateDebutRedaction());
                $dateFinRedaction = htmlspecialchars($question->getDateFinRedaction());

                if ((ConnexionUtilisateur::estOrganisateur($question)) and !$question->isActif()) {
                    $nbLigne++;

                    echo "<div class='questions'>";
                    echo "<a id='titrequestion' href=\"frontController.php?controller=question&action=readMy&id_question={$questFormater}\"> " . htmlspecialchars($question->getIntitule()) . " </a>";
                    echo "<div class='question_update'>";
                    if (ConnexionUtilisateur::estOrganisateur($question)) {
                        echo "<a id=\"confirmation\" href=\"frontController.php?controller=question&action=check&id_question={$questFormater}\"> <i class='fa-solid fa-trash'></i></a>";
                        if (date('Y-m-d H:i:s') < $dateDebutRedaction ) {
                            echo "<a href=\"frontController.php?controller=question&action=update&id_question={$questFormater}\"> <i class='fa-solid fa-pencil'></i> </a>";
                        }
                    }
                    echo "</div>";
                    echo "</div>";
                }
            }
        }
        if ($nbLigne == 0) {
            echo "<div class='questions' >Désolé vous n'avez pas de question</div>";
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

