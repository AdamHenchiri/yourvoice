
<div class="container_liste_question">
    <div class="container_question">
<?php


echo "<div class='container_question1'>";
    echo "<div class='titrelistequestion'>";
        echo "<div id='apparait' class='cacher'>";
            echo "<a id='nombrequestion'>Nombre de questions<a>";
            echo "<a>(clickez !)</a>";
        echo "</div>";
        echo "<h1>Questions</h1>";
    echo "</div>";
echo "</div>";

foreach ($questions as $question) {

    $dateFin = $question->getDateFinRedaction();
    $dateDebut = $question->getDateDebutRedaction();

    if ($question->isActif() == false) {
        $questNonFormater = $question->getIdQuestion();
        $questFormater = rawurlencode($questNonFormater);

        echo "<div class='questions'>";
        echo "<a id='titrequestion' href=\"frontController.php?controller=question&action=read&id_question={$questFormater}\"> Question {$question->getIdQuestion()} :\n" . htmlspecialchars($question->getIntitule()) . " </a>";
        echo "<div class='question_update'>";
        if(date('Y-m-d H:i:s') < $dateDebut) {
            echo "<a href=\"frontController.php?controller=question&action=update&id_question={$questFormater}\"> <i class='fa-solid fa-pencil'></i> </a>";
            echo "<a id=\"confirmation\" onclick=\"return confirmation()\" href=\"frontController.php?controller=question&action=delete&id_question={$questFormater}\"> <i class='fa-solid fa-trash'></i></a>";
            echo "</div>";
            echo "</div>";
        }
        else{
            echo "<a id=\"confirmation\" onclick=\"return confirmation()\" href=\"frontController.php?controller=question&action=delete&id_question={$questFormater}\"> <i class='fa-solid fa-trash'></i></a>";
            echo "</div>";
            echo "</div>";
        }


//onclick=\"validation()\"
    }
}
?>
    </div>
</div>
<script src="../src/js/app.js"></script>

<script>
    var public = true;
    var boutton = document.getElementById("apparait")
    boutton.addEventListener("click", ()=>{
        if(public){
            boutton.classList.add("show");
            boutton.classList.remove("cacher");
            public = false;
            boutton.innerHTML = '<?php echo "<a> $nbLigne </a>"; ?>';

        }else{
            boutton.classList.add("cacher");
            boutton.classList.remove("show");
            public = true;
            boutton.innerHTML = '<a>Nombre de questions</a><a>(clickez !)</a>';
        }
    });
</script>

