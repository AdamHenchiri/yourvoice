
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
$nbLigne=0;
if (count($questions)==null){
        echo "<div class='questions' >vous n'avez pas de vote à effectuer</div>";
}else {
    foreach ($questions as $question) {
        $questNonFormater = $question->getIdQuestion();
        $questFormater = rawurlencode($questNonFormater);
        $dateLocale = date('Y-m-d', time());
        if ($question->getDateDebutVote() <= $dateLocale && $question->getDateFinVote() > $dateLocale) {
            $nbLigne++;
            echo "<div class='questions'>";
            echo "<a id='titrequestion' href=\"frontController.php?controller=reponse&action=readAll&id_question={$questFormater}\"> " . htmlspecialchars($question->getIntitule()) . " </a>";
            echo "<a id='valider' href=\"frontController.php?controller=reponse&action=readAll&id_question={$questFormater}\"> Voir Réponses  </a>";
            echo "</div>";
        }
    }if ($nbLigne == 0) {
        echo "<div class='questions' >vous n'avez pas de vote à effectuer</div>";
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

