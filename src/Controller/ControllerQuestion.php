<?php
namespace App\YourVoice\Controller ;

use App\YourVoice\Lib\ConnexionAdmin;
use App\YourVoice\Lib\ConnexionUtilisateur;
use App\YourVoice\Lib\MessageFlash;
use App\YourVoice\Lib\MotDePasse;
use App\YourVoice\Model\DataObject\Reponse;
use App\YourVoice\Model\DataObject\Utilisateur;
use App\YourVoice\Model\DataObject\Votant;
use App\YourVoice\Model\Repository\AbstractRepository;
use App\YourVoice\Model\Repository\QuestionRepository;
use App\YourVoice\Model\DataObject\Question;
use App\YourVoice\Model\DataObject\Section;
use App\YourVoice\Model\Repository\ReponseRepository;
use App\YourVoice\Model\Repository\SectionRepository;
use App\YourVoice\Model\Repository\VotantRepository;
use App\YourVoice\Model\Repository\UtilisateurRepository;

use Couchbase\View;

// chargement du modèle


class ControllerQuestion extends GenericController
{
    public static function home() : void {
        self::afficheVue('/view.php', ["pagetitle" => "A propos de nous",
            "cheminVueBody" => "propos/propos.php", ]);

    }
    // Déclaration de type de retour void : la fonction ne retourne pas de valeur
    public static function readAll(): void
    {
        $question = new QuestionRepository();//appel au modèle pour gerer la BD
        $questions = $question->selectAll();
        self::afficheVue('/view.php', ["pagetitle" => "Liste des questions",
            "cheminVueBody" => "question/list.php",   //"redirige" vers la vue
            "questions" => $questions]);

    }


    public static function readAllMein(): void
    {
        if (ConnexionUtilisateur::getUtilisateurConnecte()!=null) {
            $question = new QuestionRepository();//appel au modèle pour gerer la BD
        $questions = $question->selectAll();
        self::afficheVue('/view.php', ["pagetitle" => "Liste des questions",
                "cheminVueBody" => "question/maList.php",   //"redirige" vers la vue
            "questions" => $questions]);
        }else{
            MessageFlash::ajouter("warning", "Autorisation déniée");
            $url = "frontController.php";
            header("Location: $url");
            exit();
        }

    }

    public static function mesVotes(): void
    {
        if (ConnexionUtilisateur::getUtilisateurConnecte()!=null) {
            $question = new QuestionRepository();//appel au modèle pour gerer la BD
        $questions = $question->selectAll();
        self::afficheVue('/view.php', ["pagetitle" => "Liste des questions",
            "cheminVueBody" => "question/mesVotes.php",   //"redirige" vers la vue
            "questions" => $questions]);
        }else{
            MessageFlash::ajouter("warning", "Autorisation déniée");
            $url = "frontController.php";
            header("Location: $url");
            exit();
        }

    }

    public static function read(): void
    {
        $question = (new QuestionRepository())->select($_GET['id_question']);
        $sections = (new SectionRepository())->selectWhere("id_question", $_GET['id_question']);
        $reponses = (new ReponseRepository())->selectWhere("id_question", $_GET['id_question']);
        if ($question !== null && $sections !== null) {
            self::afficheVue('/view.php', ["pagetitle" => "detail de la question",
                "cheminVueBody" => "question/detail.php",   //"redirige" vers la vue
                "question" => $question,
                "sections" => $sections,
                "reponses" => $reponses]);

        }else{
            self::afficheVue('/view.php', ["pagetitle" => "ERROR",
                "cheminVueBody" => "question/error.php",   //"redirige" vers la vue
            ]);
        }
    }

    public static function readMy(): void
    {
        if (ConnexionUtilisateur::getUtilisateurConnecte()  || ConnexionAdmin::estConnecte()) {
            $question = (new QuestionRepository())->select($_GET['id_question']);
            $sections = (new SectionRepository())->selectWhere("id_question", $_GET['id_question']);
            $reponses = (new ReponseRepository())->selectWhere("id_question", $_GET['id_question']);
            if ($question !== null && $sections !== null) {
                self::afficheVue('/view.php', ["pagetitle" => "detail de la question",
                    "cheminVueBody" => "question/detailMaList.php",   //"redirige" vers la vue
                    "question" => $question,
                    "sections" => $sections,
                    "reponses" => $reponses]);
            } else {
                MessageFlash::ajouter("warning", "ERROR::");
                $url = "frontController.php";
                header("Location: $url");
                exit();
            }
        } else {
            MessageFlash::ajouter("warning", "Autorisation déniée");
            $url = "frontController.php";
            header("Location: $url");
            exit();
        }
    }

//

    public static function create(): void
    {
        if (ConnexionUtilisateur::getUtilisateurConnecte() != null) {
            if (ConnexionUtilisateur::getUtilisateurConnecte()->isEstOrganisateur()) {
                self::afficheVue('/view.php', ["pagetitle" => "Ajouter votre question",
                    "cheminVueBody" => "question/create.php"   //"redirige" vers la vue
                ]);
            }else{
                self::afficheVue('/view.php', ["pagetitle" => "Ajouter votre question",
                    "cheminVueBody" => "question/demande.php"   //"redirige" vers la vue
                ]);
            }
        } else {
            MessageFlash::ajouter("warning", "Autorisation déniée");
            $url = "frontController.php";
            header("Location: $url");
            exit();
        }
    }


    public static function created(): void
    {
        if (ConnexionUtilisateur::getUtilisateurConnecte() != null) {
            $tab = array();
            $v = new Question(null, $_POST["intitule"], $_POST["explication"],
                $_POST["dateDebut_redaction"], $_POST["dateFin_redaction"], $_POST["dateDebut_vote"],
                $_POST["dateFin_vote"], ConnexionUtilisateur::getUtilisateurConnecte()->getIdUtilisateur(), 0);
            //sauvegarde de la question dans la base de donnée
            $id = (new QuestionRepository())->sauvegarder($v);
            //sauvegarde des votants dans la base de donnée
            foreach ($_POST["idContributeur"] as $idUser) {
                if ($idUser) {
                    $v3 = new Reponse(null, $idUser, $id, 0);
                    $reponse = (new ReponseRepository())->sauvegarder($v3);
                    $tab[] = $reponse;

                }
            }
            foreach ($_POST["idVotant"] as $idUser) {
                if ($idUser) {
                    foreach ($tab as $rep) {
                        $v2 = new Votant($idUser, null, $id, $rep);
                        (new VotantRepository())->sauvegarder($v2);
                    }

                }
            }
        //sauvegarde des contributeurs dans la base de donnée
            foreach ($_POST["titre"] as $i=>$section){
               $s= new Section(null,$_POST["titre"][$i],$_POST["texte_explicatif"][$i],$id, 0);
                (new SectionRepository())->sauvegarder($s);
            }
            MessageFlash::ajouter("success", "Ajout de la question avec succès");
            $url = "frontController.php?controller=question&action=readAll";
            header("Location: $url");
            exit();
        } else {
            MessageFlash::ajouter("warning", "Autorisation déniée");
            $url = "frontController.php";
            header("Location: $url");
            exit();
        }
    }

    public  static function check(){
        $v= (new QuestionRepository())->select($_GET['id_question']);
        self::afficheVue('/view.php', ["pagetitle" => "Ajouter votre question",
            "cheminVueBody" => "question/deleted.php", "v" => $v   //"redirige" vers la vue
        ]);
    }

    public  static function demande(){
        if (ConnexionUtilisateur::estConnecte() && !ConnexionUtilisateur::getUtilisateurConnecte()->isDemandeOrga()){
            $user = ConnexionUtilisateur::getUtilisateurConnecte();
            $u = new Utilisateur($user->getIdUtilisateur(),$user->getLogin(),$user->getNom(),$user->getPrenom(),$user->getAge(),$user->getEmail(),$user->getMdpHache(),$user->getEmailAValider(),$user->getNonce(),0,1);
            (new UtilisateurRepository())->update($u);
            MessageFlash::ajouter("success", "Votre demande a bien été transmise à l'administrateur");
            $url = "frontController.php";
            header("Location: $url");
            exit();
        }else{
            MessageFlash::ajouter("warning", "Autorisation déniée");
            $url = "frontController.php";
            header("Location: $url");
            exit();
        }
    }

    public static function delete() : void {
        if (ConnexionAdmin::estConnecte()){
            $v = (new QuestionRepository())->select($_GET['id_question']);
            $q = new Question($v->getIdQuestion(), $v->getIntitule(), $v->getExplication(), $v->getDateDebutRedaction(),
                $v->getDateFinRedaction(), $v->getDateDebutVote(), $v->getDateFinVote(), $v->getIdUtilisateur(), 1);
            (new QuestionRepository())->update($q);
            MessageFlash::ajouter("success", "Question supprimée");
            header("Location: frontController.php?controller=admin&action=readAllQuest");
            exit();
        }
        if (!isset($_POST["mdp"])){
            MessageFlash::ajouter("danger","Veuillez remplir le formulaire");
            $url="frontController.php?controller=question&action=check&id_question=" . $_POST['id_question'];
            header("Location: ".$url);
            exit();
        }else {
            $user = ConnexionUtilisateur::getUtilisateurConnecte();

            if (!MotDePasse::verifier($_POST["mdp"], $user->getMdpHache())) {
                MessageFlash::ajouter("warning", "Mot de passe erroné");
                $url = "frontController.php?controller=question&action=check&id_question=" . $_POST['id_question'];
                header("Location: " . $url);
                exit();
            } else {

                $v = (new QuestionRepository())->select($_POST['id_question']);

                var_dump($v);
                if ($v != null) {

                    $q = new Question($v->getIdQuestion(), $v->getIntitule(), $v->getExplication(), $v->getDateDebutRedaction(),
                        $v->getDateFinRedaction(), $v->getDateDebutVote(), $v->getDateFinVote(), $v->getIdUtilisateur(), 1);

                    (new QuestionRepository())->update($q);

                    MessageFlash::ajouter("success", "Question supprimée");
                    header("Location: frontController.php?controller=question&action=readAll");

                    exit();
                }
            }
        }
        header("Location: frontController.php?controller=question&action=readAll");
    }

    public static function restaurer() : void {

            if (!ConnexionAdmin::estConnecte()) {
                MessageFlash::ajouter("warning", "Autorisation déniée");
                header("Location: frontController.php?controller=question&action=readAll");
            } else {
                $v = (new QuestionRepository())->select($_GET['id_question']);
                if ($v != null) {
                    $q = new Question($v->getIdQuestion(), $v->getIntitule(), $v->getExplication(), $v->getDateDebutRedaction(),
                        $v->getDateFinRedaction(), $v->getDateDebutVote(), $v->getDateFinVote(), $v->getIdUtilisateur(), 0);
                    (new QuestionRepository())->update($q);
                    MessageFlash::ajouter("success", "Question restaurée");
                }
                header("Location: frontController.php?controller=admin&action=readAllQuest");
            }
    }


    public static function deleted(): void
    {
        if (ConnexionUtilisateur::getUtilisateurConnecte()!=null && MotDePasse::verifier($_POST["mdp"],ConnexionUtilisateur::getUtilisateurConnecte()->getMdpHache())) {
            $v = (new QuestionRepository())->select($_POST['id_question']);

         var_dump($v);
        if ($v!=null){

            $q = new Question($v->getIdQuestion(),$v->getIntitule(),$v->getExplication(),$v->getDateDebutRedaction(),
            $v->getDateFinRedaction(),$v->getDateDebutVote(),$v->getDateFinVote(),$v->getIdUtilisateur(), 1);

            (new QuestionRepository())->update($q);

            MessageFlash::ajouter("success", "Question supprimée");

        }else{
            MessageFlash::ajouter("danger", "Erreur de la suppression");
        }
        header("Location: frontController.php?controller=question&action=readAll");
        }else{
            MessageFlash::ajouter("warning", "Autorisation déniée");
            $url = "frontController.php";
            header("Location: $url");
            exit();
        }
    }



    public static function error(string $errorMessage): void
    {
        self::afficheVue('view.php', ["pagetitle" => "ERROR", "cheminVueBody" => "Question/error.php", "s" => "Problème avec la question : $errorMessage "]);

    }

    public static function update(): void
    {
        $q = (new QuestionRepository())->select($_GET['id_question']);
        if (ConnexionUtilisateur::estOrganisateur($q) || ConnexionAdmin::estConnecte() ) {
        $dateFin = $q->getDateFinRedaction();
        $dateDebut = $q->getDateDebutRedaction();
        if (date('Y-m-d H:i:s') < $dateDebut || ConnexionAdmin::estConnecte()){
            $sections= (new SectionRepository())->selectWhere('id_question', $q->getIdQuestion());
            self::afficheVue('/view.php', ["pagetitle" => "mettre à jour une question", "cheminVueBody" => "question/update.php", "v" => $q,"sections" => $sections ]);
        } else {

            MessageFlash::ajouter("warning", "Les rédactions ont déjà commencée ");
            header("Location: frontController.php?controller=question&action=read&id_question=" . $_GET['id_question']);

        }}else{
            MessageFlash::ajouter("warning", "Autorisation déniée");
            $url = "frontController.php";
            header("Location: $url");
            exit();
        }
    }

    public static function updated(): void
    {
        if (ConnexionUtilisateur::getUtilisateurConnecte()!=null || ConnexionAdmin::estConnecte()) {

            $id = $_POST['id_question'];

        $id=$_POST['id_question'];
        $q =(new QuestionRepository())->select($id);
        $u = $q->getIdUtilisateur();
        $v = new Question($_POST['id_question'], $_POST["intitule"], $_POST["explication"],
            $_POST["dateDebut_redaction"], $_POST["dateFin_redaction"], $_POST["dateDebut_vote"],
            $_POST["dateFin_vote"], $u, 0);
        (new QuestionRepository())->update($v);


        $tabVotants = (new VotantRepository())->selectWhere("id_question", $id);
        foreach ($tabVotants as $vot) {
            $aux = true;
            foreach ($_POST["idVotant"] as $idUser) {
                if ($idUser == $vot->getIdUtilisateur()) {
                    $aux = true;
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
            foreach ($tabVotants as $vot) {
                if ($idUser == $vot->getIdUtilisateur()) {
                    $aux = true;
                    break;
                } else {
                    $aux = false;
                }
            }
            if ($aux == false) {
                $tabrep = (new ReponseRepository())->selectWhere("id_question", $id);
                foreach ($tabrep as $rep) {
                    $v3 = new Votant($idUser, null, $id, $rep->getIdRponses());
                    (new VotantRepository())->sauvegarder($v3);
                }
            }
        }


        $tabOrganisateur = (new ReponseRepository())->selectWhere("id_question", $id);
        foreach ($tabOrganisateur as $orga) {
            $aux = true;
            foreach ($_POST["idContributeur"] as $idUser) {
                if ($idUser == $orga->getIdUtilisateur()) {
                    $aux = true;
                    break;
                } else {
                    $aux = false;
                }
            }
            if ($aux == false) {

                (new ReponseRepository())->supprimer([$orga->getIdUtilisateur(), $id]);
            }
        }
        foreach ($_POST["idContributeur"] as $idUser) {
            $aux = true;
            foreach ($tabOrganisateur as $orga) {
                if ($idUser == $orga->getIdUtilisateur()) {
                    $aux = true;
                    break;
                } else {
                    $aux = false;
                }
            }
            if ($tabOrganisateur == null) {
                $aux = false;
            }
            if ($aux == false) {
                $v3 = new Reponse(null, $idUser, $id, 0);
                (new ReponseRepository())->sauvegarder($v3);
            }
        }

        MessageFlash::ajouter("success", "Question mise à jour avec succès");
        $url = "frontController.php?controller=question&action=readAll";
        header("Location: $url");
        exit();
        }else{
            MessageFlash::ajouter("warning", "Autorisation déniée");
            $url = "frontController.php";
            header("Location: $url");
            exit();
        }
    }


}

