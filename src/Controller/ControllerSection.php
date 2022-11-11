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
        //$sections = (new SectionRepository())->selectWhere("id_question",$_GET['id_question']);

        $question =(new QuestionRepository())->select($id);
        //$sections = (new SectionRepository())->selectWhere("id_question",$_GET['id_question']);

        if (isset($_POST['ajouterBtn'])) {
            self::afficheVue('/view.php', ["pagetitle" => "ajouter section",
                "cheminVueBody" => "section/created.php", "id_question"=>$id   //"redirige" vers la vue
            ]);
        }
        else{
            self::afficheVue('/view.php', ["pagetitle" => "Finir section",
                "cheminVueBody" => "question/detail.php", "question"=>$question,
                "sections"=>$v ]);  //"redirige" vers la vue
        }
    }

    public static function update() : void {
        $v= (new UtilisateurRepository())->select($_GET['login']);
        self::afficheVue('/view.php',["pagetitle"=>"mettre à jour une utilisateur","cheminVueBody"=>"utilisateur/update.php","v"=>$v]);
    }

    public static function updated() : void {
        $v=new Utilisateur($_POST["login"],$_POST["nom"],$_POST["prenom"]);
        (new UtilisateurRepository())->update($v);
        self::afficheVue('/view.php', ["pagetitle" => "creation de utilisateur",
            "cheminVueBody" => "utilisateur/updated.php" ,  //"redirige" vers la vue
            "login"=>htmlspecialchars($v->getLogin()),
        ]);
        self::readAll();
    }

    public static function delete() : void {
        $v=(new UtilisateurRepository())->select($_GET['login']);
        $rep=(new UtilisateurRepository())->supprimer($_GET['login']);
        if ($v!=null){
            self::afficheVue('/view.php', ["pagetitle" => "suppresion de utilisateur",
                "cheminVueBody" => "utilisateur/deleted.php","nom"=>$v->getnom(),"login"=>$v->getlogin()   //"redirige" vers la vue
            ]);
        }else{
            $s='suppression echoué';
            self::error($s);
        }
        self::readAll();
    }

    public static function readAll2() : void {

        $sections =(new SectionRepository())->selection($_GET['login'], "section");
        ;//appel au modèle pour gerer la BD
        self::afficheVue('/view.php', ["pagetitle" => "Liste des sections",
            "cheminVueBody" => "section/list.php",   //"redirige" vers la vue
            "sections"=>$sections]);
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
        $user =(new UtilisateurRepository())->select($_GET['login']);
        if ($user!==null) {
            self::afficheVue('/view.php', ["pagetitle" => "detail de la utilisateur",
                "cheminVueBody" => "utilisateur/detail.php",   //"redirige" vers la vue
                "user"=>$user]);
        }else{
            self::afficheVue('/view.php', ["pagetitle" => "ERROR",
                "cheminVueBody" => "utilisateur/error.php",   //"redirige" vers la vue
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