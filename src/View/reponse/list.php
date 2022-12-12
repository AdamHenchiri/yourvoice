
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

foreach ($reponses as $reponse) {
    $repNonFormater = $reponse->getIdReponses();
    $repFormater = rawurlencode($repNonFormater);
    $questionNonFormater = $reponse->getIdQuestion();
    $questionFormater = rawurlencode($repNonFormater);

echo "<div class='questions'>";
        echo "<a id='titrequestion' href=\"frontController.php?controller=reponse&action=read&id_reponse={$repFormater}\"> Question {$question->getIdQuestion()} :\n" . htmlspecialchars($question->getIntitule()) . " </a>";
        echo "<div class='question_update'>";

            echo "<a href=\"frontController.php?controller=reponse&action=update&id_reponse={$repFormater}&id_question={$questionFormater}\"> <i class='fa-solid fa-pencil'></i> </a>";
            echo "<a id=\"confirmation\" onclick=\"return confirmation()\" href=\"frontController.php?controller=reponse&action=delete&id_reponse={$repFormater}\"> <i class='fa-solid fa-trash'></i></a>";
            echo "</div>";
            echo "</div>";



//onclick=\"validation()\"
}
?>
    </div>
</div>

