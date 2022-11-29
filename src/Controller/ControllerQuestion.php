<?php
namespace App\YourVoice\Controller ;

use App\YourVoice\Model\DataObject\Reponse;
use App\YourVoice\Model\DataObject\Votant;
use App\YourVoice\Model\Repository\AbstractRepository;
use App\YourVoice\Model\Repository\QuestionRepository;
use App\YourVoice\Model\DataObject\Question ;
use App\YourVoice\Model\DataObject\Section ;
use App\YourVoice\Model\Repository\ReponseRepository;
use App\YourVoice\Model\Repository\SectionRepository;
use App\YourVoice\Model\Repository\VotantRepository;
use App\YourVoice\Model\Repository\UtilisateurRepository;

use Couchbase\View;

// chargement du modèle


class ControllerQuestion extends GenericController {

    // Déclaration de type de retour void : la fonction ne retourne pas de valeur
    public static function readAll() : void {
        $question =new QuestionRepository();//appel au modèle pour gerer la BD
        $questions = $question->selectAll();
        $nbLigne =count($questions);
         self::afficheVue('/view.php', ["pagetitle" => "Liste des questions",
            "cheminVueBody" => "question/list.php",   //"redirige" vers la vue
            "questions"=>$questions, "nbLigne" => $nbLigne] );

    }


    public static function read() : void {
        $question =(new QuestionRepository())->select($_GET['id_question']);
        $sections = (new SectionRepository())->selectWhere("id_question",$_GET['id_question']);
        $reponses = (new ReponseRepository())->selectWhere("id_question",$_GET['id_question']);
        if ($question!==null && $sections!==null) {
            self::afficheVue('/view.php', ["pagetitle" => "detail de la question",
                "cheminVueBody" => "question/detail.php",   //"redirige" vers la vue
                "question"=>$question,
                "sections"=>$sections,
                "reponses"=>$reponses]);
        }else{
            self::afficheVue('/view.php', ["pagetitle" => "ERROR",
                "cheminVueBody" => "question/error.php",   //"redirige" vers la vue
               ]);
        }
    }

//    public static function afficheVue(string $cheminVue, array $parametres = []) : void {
//        extract($parametres); // Crée des variables à partir du tableau $parametres
//        require "../src/View/$cheminVue"; // Charge la vue
//    }

    public static function create() : void {
        self::afficheVue('/view.php', ["pagetitle" => "Ajouter votre question",
            "cheminVueBody" => "question/create.php"   //"redirige" vers la vue
            ]);
    }


    public static function created() : void {
            $tab = array();
            $v=new Question( null,$_POST["intitule"],$_POST["explication"],
            $_POST["dateDebut_redaction"], $_POST["dateFin_redaction"], $_POST["dateDebut_vote"],
            $_POST["dateFin_vote"], $_POST["id_utilisateur"]);
        //sauvegarde de la question dans la base de donnée
        $id=(new QuestionRepository())->sauvegarder($v);
        //sauvegarde des votants dans la base de donnée
        foreach ($_POST["idContributeur"] as $idUser) {
            if ($idUser) {
                $v3 = new Reponse(null,$idUser, $id);
                $reponse =  (new ReponseRepository())->sauvegarder($v3);
                $tab[] = $reponse;

            }
        }
        foreach ($_POST["idVotant"] as $idUser) {
                if ($idUser) {
                    foreach ($tab as $rep)
                    {
                        $v2 = new Votant($idUser, null, $id, $rep);
                        (new VotantRepository())->sauvegarder($v2);
                    }

                }
            }
        //sauvegarde des contributeurs dans la base de donnée
            foreach ($_POST["titre"] as $i=>$section){
               $s= new Section(null,$_POST["titre"][$i],$_POST["texte_explicatif"][$i],$id);
                (new SectionRepository())->sauvegarder($s);
            }
            ControllerQuestion::readAll();
    }

    public static function delete() : void {
        $v=(new QuestionRepository())->select($_GET['id_question']);
        $rep=(new QuestionRepository())->supprimer($_GET['id_question']);
        if ($v!=null){
            self::readAll();
        }else{
            $s='suppression echoué';
            self::error($s);
        }
    }


    public static function error(string $errorMessage):void {
        self::afficheVue('view.php',["pagetitle"=>"ERROR","cheminVueBody"=>"Question/error.php","s"=>"Problème avec la question : $errorMessage "]);

    }

    public static function update() : void {
        $v= (new QuestionRepository())->select($_GET['id_question']);
        $values=$v->formatTableau();
        self::afficheVue('/view.php',["pagetitle"=>"mettre à jour une question","cheminVueBody"=>"question/update.php","v"=>$v]);
    }

    public static function updated() : void
    {
        $id=$_POST['id_question'];
        $v = new Question($_POST['id_question'], $_POST["intitule"], $_POST["explication"],
            $_POST["dateDebut_redaction"], $_POST["dateFin_redaction"], $_POST["dateDebut_vote"],
            $_POST["dateFin_vote"], $_POST["id_utilisateur"]);
        (new QuestionRepository())->update($v);


        $tabVotants=(new VotantRepository())->selectWhere("id_question",$id);
        foreach ($tabVotants as $vot ) {
            $aux = true;
            foreach ($_POST["idVotant"] as $idUser) {
                if ($idUser == $vot->getIdUtilisateur()) {
                    break;
                } else {
                    $aux = false;
                }
            }
            if ($aux == false) {
                (new VotantRepository())->supprimer([$vot->getIdUtilisateur(), $id]);
            }
        }
        foreach ($_POST["idVotant"] as $idUser) {
            $aux = true;
            foreach ($tabVotants as $vot ) {
                if ($idUser == $vot->getIdUtilisateur()) {
                    break;
                } else {
                    $aux = false;
                }
            }
            if ($aux == false) {
                $tabrep= (new ReponseRepository())->selectWhere("id_question",$id);
                foreach ($tabrep as $rep){
                    $v3 = new Votant($idUser,null,$id,$rep->getIdRponses());
                    (new VotantRepository())->sauvegarder($v3);
                }
            }
        }

        //sauvegarde des contributeurs dans la base de donnée
        $tabOrganisateur=(new ReponseRepository())->selectWhere("id_question",$id);
            foreach ($tabOrganisateur as $orga ) {
                $aux = true;
                foreach ($_POST["idOrganisateur"] as $idUser) {
                    if ($idUser == $orga->getIdUtilisateur()) {
                        break;
                    } else {
                        $aux = false;
                    }
                }
                if ($aux == false) {
                    (new ReponseRepository())->supprimer([$orga->getIdUtilisateur(), $id]);
                }
            }
             foreach ($_POST["idOrganisateur"] as $idUser) {
                 $aux = true;
                foreach ($tabOrganisateur as $orga ) {
                if ($idUser == $orga->getIdUtilisateur()) {
                    break;
                } else {
                    $aux = false;
                }
            }
            if ($aux == false) {
                $v3 = new Reponse(null,$idUser, $id);
                (new ReponseRepository())->sauvegarder($v3);            }
        }

        self::readAll();
    }




}
?>