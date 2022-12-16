<?php

namespace App\YourVoice\Controller;

use App\YourVoice\Lib\MessageFlash;
use App\YourVoice\Model\Repository\AbstractRepository;
use App\YourVoice\Model\Repository\QuestionRepository;
use App\YourVoice\Model\Repository\SectionRepository;
use App\YourVoice\Model\DataObject\Section ;
use App\YourVoice\Model\DataObject\Question;

class ControllerSection extends GenericController
{

    public static function create() : void {
        $q = (new QuestionRepository())->select($_GET['id_question']);
        //$dateFin = $q->getDateFinRedaction();
        $dateDebut = $q->getDateDebutRedaction();
        if(date('Y-m-d H:i:s') > $dateDebut){
            MessageFlash::ajouter("warning", "La rédaction des réponses a déjà commencée");
            header("Location: frontController.php?controller=question&action=read&id_question=" . $_GET['id_question'] );
        }
        if(date('Y-m-d H:i:s') <= $dateDebut) {
            $id = $_GET["id_question"];
            self::afficheVue('/view.php', ["pagetitle" => "Ajouter une section",
                "cheminVueBody" => "section/create.php", "id_question" => $id  //"redirige" vers la vue
            ]);
        }
    }


    public static function created() : void {
        $id=$_POST["id_question"];
        $v=new Section(null,$_POST["titre"],$_POST["texte_explicatif"],$id, 0);
        (new SectionRepository())->sauvegarder($v);
        (new ControllerQuestion())::readAll();
       /* $sections = (new SectionRepository())->selectWhere("id_question", $id);
        $question =(new QuestionRepository())->select($id);
        if (isset($_POST['ajouterBtn'])) {
            self::afficheVue('/view.php', ["pagetitle" => "ajouter section",
                "cheminVueBody" => "section/create.php", "id_question"=>$id  //"redirige" vers la vue
            ]);
        }
        else{
            self::afficheVue('/view.php', ["pagetitle" => "Finir section",
                "cheminVueBody" => "question/detail.php", "question"=>$question,
                "sections"=>$sections ]);  //"redirige" vers la vue
        }*/
    }



    public static function update() : void {
        $q = (new QuestionRepository())->select($_GET['id_question']);
        //$dateFin = $q->getDateFinRedaction();
        $dateDebut = $q->getDateDebutRedaction();
        if(date('Y-m-d H:i:s') > $dateDebut){
            MessageFlash::ajouter("warning", "La rédaction des réponses a déjà commencée");
            header("Location: frontController.php?controller=question&action=read&id_question=" . $_GET['id_question'] );
        }
        if(date('Y-m-d H:i:s') <= $dateDebut){
            $v= (new SectionRepository())->select($_GET['id_section']);
            self::afficheVue('/view.php',["pagetitle"=>"mettre à jour une section","cheminVueBody"=>"section/update.php","v"=>$v]);
        }
    }


    public static function updated() : void {
        $v=new Section($_POST["id_section"],$_POST["titre"],$_POST["texte_explicatif"],$_POST["id_question"], 0);
        (new SectionRepository())->update($v);
        MessageFlash::ajouter("success","section créée");
        $url ="frontController.php?controller=question&action=read&id_question=" . $_POST["id_question"];
        header("Location: $url");
        exit();
        /*self::afficheVue('/view.php', ["pagetitle" => "modification de section",
            "cheminVueBody" => "section/updated.php" ,  //"redirige" vers la vue
            "v"=>htmlspecialchars($_POST['id_section']),
        ]);*/
        //self::readAll();
    }

    public static function delete() : void
    {
        $q = (new QuestionRepository())->select($_GET['id_question']);
        //$dateFin = $q->getDateFinRedaction();
        $dateDebut = $q->getDateDebutRedaction();
        if (date('Y-m-d H:i:s') > $dateDebut) {
            MessageFlash::ajouter("warning", "La rédaction des réponses a déjà commencée");
            header("Location: frontController.php?controller=question&action=read&id_question=" . $_GET['id_question']);
        }
        if (date('Y-m-d H:i:s') <= $dateDebut) {
            $sections = (new SectionRepository())->selectWhere("id_question", $_GET["id_question"]);
            $v = (new SectionRepository())->select($_GET['id_section']);
            //$question = (new QuestionRepository())->select($_GET["id_question"]);
            if ($v != null && count($sections) > 1) {
                $s = new Section($v->getIdSection(), $v->getTitre(), $v->getTexteExplicatif(), $v->getIdQuestion(), 1);
                (new SectionRepository())->update($s);
                MessageFlash::ajouter("success", "Question supprimée");
            } else {
                MessageFlash::ajouter("danger", "Erreur de la suppression");
            }
            header("Location: frontController.php?controller=question&action=read&id_question=" . rawurlencode($v->getIdQuestion()));

        }
    }



    public static function readAll() : void {

        $sections =(new SectionRepository())->selectAll();
        ;//appel au modèle pour gerer la BD
        /*self::afficheVue('/view.php', ["pagetitle" => "Liste des sections",
            "cheminVueBody" => "section/list.php",   //"redirige" vers la vue
            "sections"=>$sections]);*/
        self::afficheVue('/view.php', ["pagetitle" => "Liste des sections",
            "cheminVueBody" => "question/detail.php",   //"redirige" vers la vue
            "sections"=>$sections]);
    }



    public static function read() : void {
        $section =(new SectionRepository())->select($_GET['id_section']);
        if ($section!==null) {
            self::afficheVue('/view.php', ["pagetitle" => "detail de la section",
                "cheminVueBody" => "section/detail.php",   //"redirige" vers la vue
                "section"=>$section,
                ]);
        }else{
            self::afficheVue('/view.php', ["pagetitle" => "ERROR",
                "cheminVueBody" => "section/error.php",   //"redirige" vers la vue
            ]);
        }
    }

//    private static function afficheVue(string $cheminVue, array $parametres = []) : void {
//        extract($parametres); // Crée des variables à partir du tableau $parametres
//        require "../src/View/$cheminVue"; // Charge la vue
//    }


    public static function error(string $errorMessage):void {
        self::afficheVue('view.php',["pagetitle"=>"ERROR","cheminVueBody"=>"utilisateur/error.php","s"=>"Problème avec la utilisateur : $errorMessage "]);

    }

}