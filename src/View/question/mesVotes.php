
<div class="container_liste_question">
    <div class="container_question">
<?php
use App\YourVoice\Lib\ConnexionUtilisateur;
use App\YourVoice\Model\Repository\VotantRepository;

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
    $questNonFormater = $question->getIdQuestion();
    $questFormater = rawurlencode($questNonFormater);
    $existe=(new VotantRepository())->selectWhereAnd("id_question",$questNonFormater,"id_votant",ConnexionUtilisateur::getUtilisateurConnecte()->getIdUtilisateur());

    if(count($existe)!=0) {
        $nbLigne++;
        echo "<div class='questions'>";
        echo "<a id='titrequestion' href=\"frontController.php?controller=reponse&action=readAll&id_question={$questFormater}\"> Question {$question->getIdQuestion()} :\n" . htmlspecialchars($question->getIntitule()) . " </a>";
        echo "</div>";
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

