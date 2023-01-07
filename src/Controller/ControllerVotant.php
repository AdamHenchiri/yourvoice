<?php

namespace App\YourVoice\Controller;

use App\YourVoice\Lib\ConnexionUtilisateur;
use App\YourVoice\Lib\MessageFlash;
use App\YourVoice\Model\HTTP\Cookie;
use App\YourVoice\Model\Repository\QuestionRepository;
use App\YourVoice\Model\Repository\ReponseRepository;
use App\YourVoice\Model\Repository\SectionRepository;
use App\YourVoice\Model\Repository\TexteRepository;
use App\YourVoice\Model\Repository\VotantRepository;

class ControllerVotant extends GenericController
{


    public static function winner(): void
    {

        $question = new QuestionRepository();
        $questions = $question->selectAll();
        $tab = array();
        foreach ($questions as $question){
            if($question->getDateFinVote() < date("Y-m-d")){
                array_push($tab, $question);
            }
        }
        self::afficheVue('/view.php', ["pagetitle" => "Liste des questions",
            "cheminVueBody" => "question/list.php",   //"redirige" vers la vue
            "questions" => $tab]);
    }


    public static function aux()
    {
        $tableauReponse = (new ReponseRepository())->selectWhere("id_question", $_GET["id_question"]);
        $tableau = array();
        $vote = array();
        foreach ($tableauReponse as $reponse){
            $tableauVotant = (new VotantRepository())->selectWhere("id_reponse", $reponse->getIdRponses());
            array_push($tableau, $tableauVotant);

        }
        return $tableau;

    }

    public static function aux2()
    {
        $tableau = self::aux();
        $taille = count($tableau);
        $idReponse = array();
        foreach ($tableau as $r) {
            foreach ($r as $v) {

                array_push($idReponse,$v->getIdReponse() );

            }
        }
        return $idReponse;

    }


    public static function aux3()
    {

        $tabIdReponse = self::aux2();
        $uniques = array_unique($tabIdReponse);
        //var_dump($uniques);
        $tabNote = array();
        foreach ($uniques as $unique) {
            $note =0;
            $tableauVotants = (new VotantRepository())->selectWhere("id_reponse", $unique);
            $i = 0;
            foreach ($tableauVotants as $tableauVotant){
                if($tableauVotant->getIdReponse() == $unique){
                    if($tableauVotant->getVote() == null){
                        $vote = 0;
                    }
                    else{
                        $vote = $tableauVotant->getVote();
                    }
                    $note = $note + $vote;
                    //echo "<p> reponse : ". $unique . " // vote  : ". $vote . "// note : ". $note . "</p>";
                }

                $tabNote[$unique] = $note;
                $i = $i + 1;
            }
        }
        return $tabNote;


    }


    public static function aux4()
    {
        $tableauNote = self::aux3();
        asort($tableauNote);
        asort($tableauNote);
        $newTab = $tableauNote;
        if(empty($tableauNote)){
            $newTab = array();
        }
        else{
            $max = max($tableauNote);
            foreach ($newTab as $key => $value) {
                if ($newTab[$key] != $max) {
                    unset($newTab[$key]);
                }
            }
        }

       return $newTab;

    }

    public static function systemeVote():void{
        $tableauNote = self::aux3();
        $newTab = self::aux4();
        $reponses = [];
        if(count($newTab) > 1){
            $cle = array_search(max($tableauNote), $tableauNote);
            $rep = (new ReponseRepository())->select($cle);
            $reponse = $rep;
            $trouve = 2;
            $textes = (new TexteRepository())->selectWhere("id_reponse",$cle);
            if (empty($textes)) {
                $trouve = 0;
            }
        }
        else if(count($newTab) == 0){
            $trouve = 0;
        }
        else{
            $cle = array_search(max($tableauNote), $tableauNote);
            $reponse = (new ReponseRepository())->select($cle);
            $trouve = 1;
            $textes = (new TexteRepository())->selectWhere("id_reponse",$cle);
            if (empty($textes)) {
                $trouve = 0;
            }else{
                $reponses[0] = $reponse;
            }
        }

        $question = (new QuestionRepository())->select($_GET['id_question']);
        $sections = (new SectionRepository())->selectWhere("id_question", $_GET['id_question']);


        if (!is_null($question) && !is_null($sections) && !$question->isActif() && strtotime($question->getDateFinVote()) < strtotime(date ("Y-m-d"))) {
            self::afficheVue('/view.php', ["pagetitle" => "detail de la question",
            "cheminVueBody" => "question/detail.php",
                    //"redirige" vers la vue
                    "trouve" => $trouve,
                    "question" => $question,
                    "sections" => $sections,
                    "reponses" => $reponses
            ]);

        }else{
            MessageFlash::ajouter("warning", "Autorisation déniée");
            $url = "frontController.php";
            header("Location: $url");
            exit();
        }

    }



    public static function notifier(){

    }
}




