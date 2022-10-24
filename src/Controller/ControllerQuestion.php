<?php
namespace App\Covoiturage\Controller ;

use App\Covoiturage\Model\Repository\AbstractRepository;
use App\Covoiturage\Model\Repository\QuestionRepository;
use App\Covoiturage\Model\DataObject\Question ;
use Couchbase\View;

// chargement du modèle


class ControllerQuestion {

    // Déclaration de type de retour void : la fonction ne retourne pas de valeur
    public static function readAll() : void {

        $questions =(new QuestionRepository())->selectAll();//appel au modèle pour gerer la BD
        self::afficheVue('/view.php', ["pagetitle" => "Liste des questions",
                                                "cheminVueBody" => "Question/list.php",   //"redirige" vers la vue
                                                "questions"=>$questions]);
    }

    public static function read() : void {
        $question =(new QuestionRepository())->select($_GET['immat']);
        if ($question!==null) {
            self::afficheVue('/view.php', ["pagetitle" => "detail de la question",
                "cheminVueBody" => "Question/detail.php",   //"redirige" vers la vue
                "question"=>$question]);
        }else{
            self::afficheVue('/view.php', ["pagetitle" => "ERROR",
                "cheminVueBody" => "Question/error.php",   //"redirige" vers la vue
               ]);
        }
    }

    private static function afficheVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require "../src/View/$cheminVue"; // Charge la vue
    }

    public static function create() : void {
        self::afficheVue('/view.php', ["pagetitle" => "Ajouter votre question",
            "cheminVueBody" => "Question/create.php"   //"redirige" vers la vue
            ]);
    }


    public static function created() : void {
        $v=new Question($_POST["marque"],$_POST["couleur"],$_POST["immatriculation"],$_POST["nbrSieges"]);
        (new QuestionRepository())->sauvegarder($v);
        self::afficheVue('/view.php', ["pagetitle" => "creation de question",
            "cheminVueBody" => "Question/created.php"   //"redirige" vers la vue
        ]);
        self::readAll();
    }


    public static function delete() : void {
        $v=(new QuestionRepository())->select($_GET['immat']);
        $rep=(new QuestionRepository())->supprimer($_GET['immat']);
        if ($v!=null){
            self::afficheVue('/view.php', ["pagetitle" => "suppresion de question",
                "cheminVueBody" => "Question/deleted.php","nom"=>$v->getMarque(),"immat"=>$v->getImmatriculation()   //"redirige" vers la vue
            ]);
        }else{
            $s='suppression echoué';
            self::error($s);
        }
        self::readAll();
    }


    public static function error(string $errorMessage):void {
        self::afficheVue('view.php',["pagetitle"=>"ERROR","cheminVueBody"=>"Question/error.php","s"=>"Problème avec la question : $errorMessage "]);

    }

    public static function update() : void {
        $v= (new QuestionRepository())->select($_GET['immat']);
        $values=$v->formatTableau();
        self::afficheVue('/view.php',["pagetitle"=>"mettre à jour une question","cheminVueBody"=>"Question/update.php","v"=>$v]);
    }

    public static function updated() : void {
        $v=new Question($_POST["marque"],$_POST["couleur"],$_POST["immatriculation"],$_POST["nbrSieges"]);
        (new QuestionRepository())->update($v);
        self::afficheVue('/view.php', ["pagetitle" => "creation de question",
            "cheminVueBody" => "Question/updated.php" ,  //"redirige" vers la vue
            "immatriculation"=>htmlspecialchars($v->getImmatriculation()),
        ]);
        self::readAll();
    }






}
?>