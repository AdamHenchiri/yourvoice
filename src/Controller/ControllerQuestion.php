<?php
namespace App\YourVoice\Controller ;

use App\YourVoice\Model\Repository\AbstractRepository;
use App\YourVoice\Model\Repository\QuestionRepository;
use App\YourVoice\Model\DataObject\Question ;
use Couchbase\View;

// chargement du modèle


class ControllerQuestion {

    // Déclaration de type de retour void : la fonction ne retourne pas de valeur
    public static function readAll() : void {
        $questions =(new QuestionRepository())->selectAll();//appel au modèle pour gerer la BD
       // var_dump($questions);
        self::afficheVue('/view.php', ["pagetitle" => "Liste des questions",
                                                "cheminVueBody" => "question/list.php",   //"redirige" vers la vue
                                                "questions"=>$questions]);
    }

    public static function read() : void {
        $question =(new QuestionRepository())->select($_GET['login']);
        if ($question!==null) {
            self::afficheVue('/view.php', ["pagetitle" => "detail de la question",
                "cheminVueBody" => "question/detail.php",   //"redirige" vers la vue
                "question"=>$question]);
        }else{
            self::afficheVue('/view.php', ["pagetitle" => "ERROR",
                "cheminVueBody" => "question/error.php",   //"redirige" vers la vue
               ]);
        }
    }

    private static function afficheVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require "../src/View/$cheminVue"; // Charge la vue
    }

    public static function create() : void {
        self::afficheVue('/view.php', ["pagetitle" => "Ajouter votre question",
            "cheminVueBody" => "question/create.php"   //"redirige" vers la vue
            ]);
    }


    public static function created() : void {
        $v=new Question( null,$_POST["intitule"],$_POST["explication"],
            $_POST["dateDebut_redaction"], $_POST["dateFin_redaction"], $_POST["dateDebut_vote"],
            $_POST["dateFin_vote"], $_POST["id_utilisateur"]);
        $id=    (new QuestionRepository())->sauvegarder($v);
        //echo $id;
        self::afficheVue('/view.php', ["pagetitle" => "creation d'une section",
            "cheminVueBody" => "section/create.php",//"redirige" vers la vue
            "id_question"=>$id
        ]);

    }

    public static function delete() : void {
        echo $_GET['id_question'];
        $v=(new QuestionRepository())->select($_GET['id_question']);
        $rep=(new QuestionRepository())->supprimer($_GET['id_question']);
        if ($v!=null){
            self::afficheVue('/view.php', ["pagetitle" => "suppresion de question",
                "cheminVueBody" => "question/deleted.php", "id_question"=>$v->getIdQuestion()   //"redirige" vers la vue
            ]);
        }else{
            $s='suppression echoué';
            self::error($s);
        }
        //self::readAll();
    }


    public static function error(string $errorMessage):void {
        self::afficheVue('view.php',["pagetitle"=>"ERROR","cheminVueBody"=>"Question/error.php","s"=>"Problème avec la question : $errorMessage "]);

    }

    public static function update() : void {
        $v= (new QuestionRepository())->select($_GET['id_question']);
        $values=$v->formatTableau();
        self::afficheVue('/view.php',["pagetitle"=>"mettre à jour une question","cheminVueBody"=>"question/update.php","v"=>$v]);
    }

    public static function updated() : void {
        $v=new Question($_POST["marque"],$_POST["couleur"],$_POST["immatriculation"],$_POST["nbrSieges"]);
        (new QuestionRepository())->update($v);
        self::afficheVue('/view.php', ["pagetitle" => "creation de question",
            "cheminVueBody" => "question/updated.php" ,  //"redirige" vers la vue
            "immatriculation"=>htmlspecialchars($v->getImmatriculation()),
        ]);
        self::readAll();
    }






}
?>