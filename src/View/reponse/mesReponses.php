
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
$nbLigne=0;
foreach ($questions as $question) {
    if(ConnexionUtilisateur::estResponsable($question) || ConnexionUtilisateur::estCoAuteur($question)){

        $questNonFormater = $question->getIdQuestion();
    $questFormater = rawurlencode($questNonFormater);
    $reponses=(new ReponseRepository())->selectWhere("id_question",$questNonFormater);


    if((ConnexionUtilisateur::estCoAuteur($question) || ConnexionUtilisateur::estResponsable($question) || ConnexionUtilisateur::estOrganisateur($question)) and !$question->isActif()) {

        echo "<div class='questions'>";
        echo "<a id='titrequestion' href=\"frontController.php?controller=question&action=readMy&id_question={$questFormater}\"> Question {$question->getIdQuestion()} :\n" . htmlspecialchars($question->getIntitule()) . " </a>";
        echo "<div class='question_update'>";
        if (ConnexionUtilisateur::estCoAuteur($question)) {
            echo "(Co-auteur d'une réponse)";
        }
        if (ConnexionUtilisateur::estResponsable($question)) {
            echo "(Responsable d'une réponse)";
        }
        if (ConnexionUtilisateur::estOrganisateur($question)) {
            if ($question->getDateDebutRedaction() > date("Y-m-d")) {
                echo "<a href=\"frontController.php?controller=question&action=update&id_question={$questFormater}\"> <i class='fa-solid fa-pencil'></i> </a>";
                echo "<a id=\"confirmation\" href=\"frontController.php?controller=question&action=check&id_question={$questFormater}\"> <i class='fa-solid fa-trash'></i></a>";

            }
        }
        echo "</div>";
        echo "</div>";
    }

//onclick=\"return confirmation()\
    }
}



/*
|| ConnexionUtilisateur::estCoAuteur() ||
        ConnexionUtilisateur::estOrganisateur() || ConnexionUtilisateur::estAdministrateur()


foreach ($reponses as $r){
        $existe=(new CoauteurRepository())->selectWhereAnd("id_reponse",$r->getIdRponses(),"id_coauteur",ConnexionUtilisateur::getUtilisateurConnecte()->getIdUtilisateur());

        if (count($existe)!=0){

            $nbLigne++;
                echo "<div class='questions'>";
                echo "<a id='titrequestion' href=\"frontController.php?controller=question&action=readMy&id_question={$questFormater}\"> Question {$question->getIdQuestion()} :\n" . htmlspecialchars($question->getIntitule()) . " </a>";
                echo "</div>";
                break;
        }
        break;
    }
    if(ConnexionUtilisateur::estResponsable()){
    //if ($question->getIdUtilisateur()==ConnexionUtilisation::getUtilisateurConnecte()->getIdUtilisateur()) {
        $nbLigne++;
        echo "<div class='questions'>";
        echo "<a id='titrequestion' href=\"frontController.php?controller=question&action=readMy&id_question={$questFormater}\"> Question {$question->getIdQuestion()} :\n" . htmlspecialchars($question->getIntitule()) . " </a>";
        echo "<div class='question_update'>";
        if ($question->getDateDebutRedaction() > date("Y-m-d")) {
            echo "<a href=\"frontController.php?controller=question&action=update&id_question={$questFormater}\"> <i class='fa-solid fa-pencil'></i> </a>";
        }
        echo "<a id=\"confirmation\" onclick=\"return confirmation()\" href=\"frontController.php?controller=question&action=delete&id_question={$questFormater}\"> <i class='fa-solid fa-trash'></i></a>";
        echo "</div>";
        echo "</div>";
    }

}*/
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

