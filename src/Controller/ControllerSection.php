<?php

namespace App\YourVoice\Controller;

use App\YourVoice\Model\Repository\AbstractRepository;
use App\YourVoice\Model\Repository\QuestionRepository;
use App\YourVoice\Model\Repository\SectionRepository;
use App\YourVoice\Model\DataObject\Section ;
use App\YourVoice\Model\DataObject\Question;

class ControllerSection
{

    public static function create() : void {
        self::afficheVue('/view.php', ["pagetitle" => "Ajouter une section",
            "cheminVueBody" => "section/create.php"   //"redirige" vers la vue
        ]);
    }


    public static function created() : void {
        $id=$_POST["id_question"];
        $v=new Section(null,$_POST["titre"],$_POST["texte_explicatif"],$_POST["numero"],$_POST["id_question"]);
        (new SectionRepository())->sauvegarder($v);
        $sections = (new SectionRepository())->selectWhere("id_question", $id);

        //$sections = (new SectionRepository())->selectWhere("id_question",$_GET['id_question']);

        $question =(new QuestionRepository())->select($id);
        //$sections = (new SectionRepository())->selectWhere("id_question",$_GET['id_question']);
        $num=$_POST["numero"]+1;
        if (isset($_POST['ajouterBtn'])) {
            self::afficheVue('/view.php', ["pagetitle" => "ajouter section",
                "cheminVueBody" => "section/create.php", "id_question"=>$id , "num"=>$num //"redirige" vers la vue
            ]);
        }
        else{
            self::afficheVue('/view.php', ["pagetitle" => "Finir section",
                "cheminVueBody" => "question/detail.php", "question"=>$question,
                "sections"=>$sections ]);  //"redirige" vers la vue
        }
    }

    public static function update() : void {
        $v= (new SectionRepository())->select($_GET['id_section']);
        self::afficheVue('/view.php',["pagetitle"=>"mettre à jour une section","cheminVueBody"=>"section/update.php","v"=>$v]);
    }


    public static function updated() : void {
        $v=new Section($_POST["id_section"],$_POST["titre"],$_POST["texte_explicatif"],$_POST["numero"],$_POST["id_question"]);
        (new SectionRepository())->update($v);
        self::afficheVue('/view.php', ["pagetitle" => "modification de section",
            "cheminVueBody" => "section/updated.php" ,  //"redirige" vers la vue
            "v"=>htmlspecialchars($_POST['id_section']),
        ]);
        //self::readAll();
    }

    public static function delete() : void {
        $v=(new SectionRepository())->select($_GET['id_section']);
        $rep=(new SectionRepository())->supprimer($_GET['id_section']);
        if ($v!=null){
            self::afficheVue('/view.php', ["pagetitle" => "suppresion de utilisateur",
                "cheminVueBody" => "section/deleted.php","num_section"=>$v->getNumero()   //"redirige" vers la vue
            ]);
        }else{
            $s='suppression echoué';
            self::error($s);
        }
        //self::readAll();
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
            self::afficheVue('/view.php', ["pagetitle" => "detail la section",
                "cheminVueBody" => "section/detail.php",   //"redirige" vers la vue
                "section"=>$section]);
        }else{
            self::afficheVue('/view.php', ["pagetitle" => "ERROR",
                "cheminVueBody" => "section/error.php",   //"redirige" vers la vue
            ]);
        }
    }

    private static function afficheVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require "../src/View/$cheminVue"; // Charge la vue
    }


    public static function error(string $errorMessage):void {
        self::afficheVue('view.php',["pagetitle"=>"ERROR","cheminVueBody"=>"utilisateur/error.php","s"=>"Problème avec la utilisateur : $errorMessage "]);

    }

}