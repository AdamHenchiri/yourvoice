<?php

namespace App\YourVoice\Controller;

use App\YourVoice\Lib\ConnexionUtilisateur;
use App\YourVoice\Model\HTTP\Cookie;
use App\YourVoice\Model\Repository\QuestionRepository;
use App\YourVoice\Model\Repository\ReponseRepository;
use App\YourVoice\Model\Repository\SectionRepository;
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
        if(count($newTab) > 1){
            $trouve = 2;
            $reponse = "";
        }
        else if(count($newTab) == 0){
            $trouve = 0;
            $reponse = "Il n'y a pas de réponse pour cette question.";

        }
        else{
            $cle = array_search(max($tableauNote), $tableauNote);
            $reponse = (new ReponseRepository())->select($cle);
            $trouve = 1;

        }

        $question = (new QuestionRepository())->select($_GET['id_question']);
        $sections = (new SectionRepository())->selectWhere("id_question", $_GET['id_question']);
        if ($question !== null && $sections !== null) {
            self::afficheVue('/view.php', ["pagetitle" => "detail de la question",
            "cheminVueBody" => "question/detail.php",
                    //"redirige" vers la vue
                    "trouve" => $trouve,
                    "question" => $question,
                    "sections" => $sections,
                    "reponse" => $reponse
            ]);

        }

    }

    /*public static function egailte(){
        $newTab = self::aux4();
        if(!empty($newTab)) {
            $question = (new QuestionRepository())->select(max($newTab));
            if (count($newTab) > 1 && ConnexionUtilisateur::estOrganisateur($question)){
                return true & $question;
            }
            else{
                return false;
            }
        }
        return false;
    }*/

    public static function notifier(){

    }
}

/*public static function systemeVote(): void
    {

QSDF



        $tableauVotants = (new VotantRepository())->selectWhere("id_question", $_GET["id_question"]);
        $tableau = array();
        $vote = array();
        foreach ($tableauVotants as $tableauVotant) {
            array_push($tableau, $tableauVotant->getIdReponse());
            foreach ($tableau as $tab){
                //array_push($vote, $tab->getVote());
            }
            //$tableaureponse = (new ReponseRepository())->selectWhere("id_reponse", $tableauVotant->getIdReponse());
        }


        self::afficheVue('/view.php', ["pagetitle" => "Liste des questions",
            "cheminVueBody" => "question/detailTest.php", "res" => $vote , "tab" => $tableauVotants //"redirige" vers la vue
            ]);

    }*/


    /*public static function systemeVote(): void
    {

        $tableauReponse = (new ReponseRepository())->selectWhere("id_question", $_GET["id_question"]);
        $tableau = array();
        $vote = array();
        foreach ($tableauReponse as $reponse){
            $tableauVotant = (new VotantRepository())->selectWhere("id_reponse", $reponse->getIdRponses());
            array_push($tableau, $tableauVotant);
            foreach ($tableau as $votants){
                foreach ($votants as $votant){
                    $note = $votant->getVote();
                }
                //$note = $votant->getVote();

            }

        }

        self::afficheVue('/view.php', ["pagetitle" => "Liste des questions",
            "cheminVueBody" => "question/detailTest.php", "res" => $tableau , "tab" => $votant , "note" => $note//"redirige" vers la vue
        ]);



    }



    public static function systemeVote():void
    {
        //voire pour un système de vote plus précis et gérer les égalitées

        $tableauNote = self::aux3();
        var_dump($tableauNote);
        asort($tableauNote);
        var_dump($tableauNote);
        echo count($tableauNote) . "//";
        echo max($tableauNote) . "///";
        asort($tableauNote);


        $cle = array_search(max($tableauNote), $tableauNote);

        $question = (new QuestionRepository())->select($_GET['id_question']);
        $sections = (new SectionRepository())->selectWhere("id_question", $_GET['id_question']);
        //$reponses = (new ReponseRepository())->select($cle);
        $reponse = (new ReponseRepository())->select($cle);
        //$reponses = (new ReponseRepository())->select($cle);
        if ($question !== null && $sections !== null) {
            self::afficheVue('/view.php', ["pagetitle" => "detail de la question",
                "cheminVueBody" => "question/detailTest.php",   //"redirige" vers la vue
                "question" => $question,
                "sections" => $sections,
                "reponse" => $reponse,
                "cle" => $cle
            ]);



        }
    }




}*/