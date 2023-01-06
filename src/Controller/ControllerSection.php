<?php

namespace App\YourVoice\Controller;

use App\YourVoice\Lib\ConnexionAdmin;
use App\YourVoice\Lib\ConnexionUtilisateur;
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
        if(date('Y-m-d H:i:s') > $dateDebut && !ConnexionAdmin::estConnecte()){
            MessageFlash::ajouter("warning", "La rédaction des réponses a déjà commencée");
            header("Location: frontController.php?controller=question&action=read&id_question=" . $_GET['id_question'] );
        }
        if(date('Y-m-d H:i:s') <= $dateDebut || ConnexionAdmin::estConnecte() && ConnexionUtilisateur::estOrganisateur($q)) {
            $id = $_GET["id_question"];
            self::afficheVue('/view.php', ["pagetitle" => "Ajouter une section",
                "cheminVueBody" => "section/create.php", "id_question" => $id  //"redirige" vers la vue
            ]);
        }
    }


    public static function created() : void {
        if (isset($_POST["id_question"])) {
            $id = $_POST["id_question"];
            $v = new Section(null, $_POST["titre"], $_POST["texte_explicatif"], $id, 0);
            (new SectionRepository())->sauvegarder($v);
            MessageFlash::ajouter("success", "Section crée!");
            $url = "frontController.php?controller=question&action=readMy&id_question=".$id;
            header("Location: $url");
            if (ConnexionAdmin::estConnecte()) {
                (new ControllerAdmin())::readAllQuest();
            }
        }else{
            MessageFlash::ajouter("warning", "Autorisation déniée");
            $url = "frontController.php";
            header("Location: $url");
            exit();
        }

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
        MessageFlash::ajouter("success","Section modifiée");
        $url ="frontController.php?controller=question&action=readMy&id_question=" . $_POST["id_question"];
        header("Location: $url");
        exit();

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
                MessageFlash::ajouter("success", "Section supprimée");
            } else {
                MessageFlash::ajouter("danger", "Erreur de la suppression");
            }
            header("Location: frontController.php?controller=question&action=readMy&id_question=" . rawurlencode($v->getIdQuestion()));

        }
    }



    public static function readAll() : void {

        $sections =(new SectionRepository())->selectAll();

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




    public static function error(string $errorMessage):void {
        self::afficheVue('view.php',["pagetitle"=>"ERROR","cheminVueBody"=>"utilisateur/error.php","s"=>"Problème avec l' utilisateur : $errorMessage "]);

    }

}