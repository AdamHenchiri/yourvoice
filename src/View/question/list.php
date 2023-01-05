
<div class="container_liste_question">
    <div class="container_question">
<?php
use App\YourVoice\Lib\ConnexionUtilisateur;

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
foreach ($questions as $question) {

    $dateFin = $question->getDateFinRedaction();
    $dateDebut = $question->getDateDebutRedaction();

    if ($question->isActif() == false) {
        $questNonFormater = $question->getIdQuestion();
        $questFormater = rawurlencode($questNonFormater);

        if ($question->getDateFinVote() < date("Y-m-d")) {
            $nbLigne++;
            echo "<div class='questions'>";
            echo "<a id='titrequestion' href=\"frontController.php?controller=votant&action=systemeVote&id_question={$questFormater}\"> " . htmlspecialchars($question->getIntitule()) . " </a>";
            echo "<div class='question_update'>";
            echo "</div>";
            echo "</div>";
        }
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
            //qs
            boutton.classList.add("cacher");
            boutton.classList.remove("show");
            public = true;
            boutton.innerHTML = '<a>Nombre de questions</a><a>(clickez !)</a>';
        }
    });
</script>

