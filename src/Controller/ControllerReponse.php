<?php

namespace App\YourVoice\Controller;

use App\YourVoice\Lib\ConnexionAdmin;
use App\YourVoice\Lib\ConnexionUtilisateur;
use App\YourVoice\Lib\MotDePasse;
use App\YourVoice\Model\DataObject\Question;
use App\YourVoice\Model\DataObject\Votant;
use App\YourVoice\Model\Repository\AbstractRepository;
use App\YourVoice\Model\Repository\CoauteurRepository;
use App\YourVoice\Model\Repository\QuestionRepository;
use App\YourVoice\Model\Repository\ReponseRepository;
use App\YourVoice\Model\DataObject\Reponse;
use App\YourVoice\Model\DataObject\Texte;
use App\YourVoice\Model\Repository\TexteRepository;
use App\YourVoice\Model\Repository\VotantRepository;
use http\Env\Response;
use App\YourVoice\Model\DataObject\CoAuteur;
use App\YourVoice\Lib\MessageFlash;


class ControllerReponse extends GenericController
{

    public static function create(): void
    {
        $q = (new QuestionRepository())->select($_GET['id_question']);
        $dateFin = $q->getDateFinRedaction();
        $dateDebut = $q->getDateDebutRedaction();
        if (date('Y-m-d H:i:s') > $dateFin && !ConnexionAdmin::estConnecte()) {
            MessageFlash::ajouter("warning", "Date de rédaction écoulée");
            header("Location: frontController.php?controller=question&action=read&id_question=" . $_GET['id_question']);
        }
        if (date('Y-m-d H:i:s') < $dateDebut && !ConnexionAdmin::estConnecte()) {
            MessageFlash::ajouter("warning", "La rédaction n'a pas encore commencée");
            header("Location: frontController.php?controller=question&action=read&id_question=" . $_GET['id_question']);
        }
        if ((date('Y-m-d H:i:s') <= $dateFin and date('Y-m-d H:i:s') >= $dateDebut && !$q->isActif()) || ConnexionAdmin::estConnecte()) {
            self::afficheVue('/view.php', ["pagetitle" => "Ajouter une réponse",
                "cheminVueBody" => "reponse/create.php",   //"redirige" vers la vue
            ]);
        }else{
            MessageFlash::ajouter("warning", "Autorisation déniée");
            $url = "frontController.php";
            header("Location: $url");
            exit();
        }
    }


    public static function created(): void
    {
        if (!isset($_POST["id_reponse"]) || !isset($_POST["id_question"]) || !isset($_POST["texte"] )){
            MessageFlash::ajouter("warning", "Autorisation déniée");
            $url = "frontController.php";
            header("Location: $url");
            exit();
        }else {
            $test = false;
            $id_reponse = $_POST["id_reponse"];
            $id_question = $_POST["id_question"];
            $reponses = (new ReponseRepository())->selectWhere("id_reponse", $id_reponse);
            foreach ($_POST["texte"] as $i => $section) {
                foreach ($reponses as $reponse) {
                    $coauteurs = (new CoauteurRepository())->selectWhere("id_reponse", $reponse->getIdRponses());
                    $textes = (new TexteRepository())->selectWhere("id_reponse", $reponse->getIdRponses());
                    $verif = false;
                    $update = "";
                    foreach ($textes as $t) {
                        if ($t->getIdSection() == $_POST["id_section"][$i]) {
                            $verif = true;
                            $update = $t->getIdTexte();
                        }
                    }
                    if (ConnexionAdmin::estConnecte() || ($reponse->getIdUtilisateur() == ConnexionUtilisateur::getUtilisateurConnecte()->getIdUtilisateur()) ) {
                        $test = true;
                        if (!$verif) {
                            $texte = new Texte(null, $_POST["texte"][$i], $reponse->getIdRponses(), $_POST["id_section"][$i]);
                            (new TexteRepository())->sauvegarder($texte);
                        } else {
                            $texte = new Texte($update, $_POST["texte"][$i], $reponse->getIdRponses(), $_POST["id_section"][$i]);
                            (new TexteRepository())->update($texte);

                        }
                        ////
                        if ($coauteurs != null) {
                            foreach ($coauteurs as $coauteur) {
                                $aux = true;
                                foreach ($_POST["idCoAuteur"] as $idUser) {
                                    if ($idUser == $coauteur->getIdUtilisateur()) {
                                        $aux = true;
                                        break;
                                    } else {
                                        $aux = false;
                                    }
                                }
                                if ($aux == false) {
                                    (new CoauteurRepository())->supprimer([$reponse->getIdRponses(), $coauteur->getIdUtilisateur()]);
                                }
                            }
                        }
                        if ($_POST["idCoAuteur"] != null) {
                            foreach ($_POST["idCoAuteur"] as $idUser) {
                                $aux = true;
                                foreach ($coauteurs as $coauteur) {
                                    if ($idUser == $coauteur->getIdUtilisateur()) {
                                        $aux = true;
                                        break;
                                    } else {
                                        $aux = false;
                                    }
                                }
                                if ($coauteurs == null) {
                                    $aux = false;
                                }
                                if ($aux == false) {
                                    $v3 = new CoAuteur($reponse->getIdRponses(), $idUser);
                                    (new CoauteurRepository())->sauvegarder($v3);
                                }
                            }
                        }
                    } else if ($coauteurs != null) {
                        foreach ($coauteurs as $coauteur) {
                            if ($coauteur->getIdUtilisateur() == ConnexionUtilisateur::getUtilisateurConnecte()->getIdUtilisateur()) {
                                $test = true;
                                if (!$verif) {
                                    $texte = new Texte(null, $_POST["texte"][$i], $reponse->getIdRponses(), $_POST["id_section"][$i]);
                                    (new TexteRepository())->sauvegarder($texte);
                                } else {
                                    $texte = new Texte($update, $_POST["texte"][$i], $reponse->getIdRponses(), $_POST["id_section"][$i]);
                                    (new TexteRepository())->update($texte);
                                }
                            }
                        }
                    }
                }
            }
            if ($test == true) {
                MessageFlash::ajouter("success", "Réponse ajoutée avec succès");
                $url = "frontController.php?controller=reponse&controller=reponse&action=read&id_reponse=" . $id_reponse . "&id_question=" . $id_question;
                header("Location: $url");
                exit();
            } else {
                MessageFlash::ajouter("warning", "Un problème s'est produit lors de l'ajout");
                $url = "frontController.php?controller=reponse&action=update&id_reponse=" . $id_reponse . "&id_question=" . $id_question;
                header("Location: $url");
                exit();
            }
        }
    }

    public static function update(): void
    {
        $q = (new QuestionRepository())->select($_GET['id_question']);
        $dateFin = $q->getDateFinRedaction();
        $dateDebut = $q->getDateDebutRedaction();
        $textes = (new TexteRepository())->selectWhere("id_reponse", $_GET['id_reponse']);
        if (date('Y-m-d H:i:s') > $dateFin && !ConnexionAdmin::estConnecte()) {
            MessageFlash::ajouter("warning", "Date de rédaction écoulée");
            header("Location: frontController.php?controller=question&action=read&id_question=" . $_GET['id_question']);
        }
        if (date('Y-m-d H:i:s') < $dateDebut && !ConnexionAdmin::estConnecte()) {
            MessageFlash::ajouter("warning", "La rédaction n'a pas encore commencée");
            header("Location: frontController.php?controller=question&action=read&id_question=" . $_GET['id_question']);
        }
        if ((date('Y-m-d H:i:s') <= $dateFin and date('Y-m-d H:i:s') >= $dateDebut && !$q->isActif()) || ConnexionAdmin::estConnecte()) {
            if (ConnexionUtilisateur::estResponsable($q) || ConnexionUtilisateur::estCoAuteur($q) || ConnexionAdmin::estConnecte()) {
                self::afficheVue('/view.php', ["pagetitle" => "Update d'une réponse",
                    "cheminVueBody" => "texte/update.php",   //"redirige" vers la
                    "textes" => $textes,
                    "q" => $q
                ]);
            } else {
                MessageFlash::ajouter("warning", "Autorisation déniée");
                $url = "frontController.php";
                header("Location: $url");
                exit();
            }
        }else {
            MessageFlash::ajouter("warning", "Autorisation déniée");
            $url = "frontController.php";
            header("Location: $url");
            exit();
        }

    }

    public static function updated(): void
    {
        if (isset($_POST["id_question"]) && isset($_POST["id_reponse"])) {
            $test = false;
            $id_question = $_POST["id_question"];
            $q = (new QuestionRepository())->select($id_question);
            $id_reponse = $_POST["id_reponse"];
            $responsable = (new ReponseRepository())->selectWhereAnd("id_question", $id_question, "id_reponse", $id_reponse);
            foreach ($_POST["texte"] as $i => $section) {
                $coauteurs = (new CoauteurRepository())->selectWhere("id_reponse", $id_reponse);
                $textes = (new TexteRepository())->selectWhere("id_reponse", $id_reponse);
                $verif = false;
                $update = "";
                foreach ($textes as $t) {
                    if ($t->getIdSection() == $_POST["id_section"][$i]) {
                        $verif = true;
                        $update = $t->getIdTexte();
                    }
                }
                //si l'utilisateur est responsable de la réponse
                if (ConnexionUtilisateur::estResponsable($q) || ConnexionAdmin::estConnecte()) {
                    if (!$verif) {
                        $texte = new Texte(null, $_POST["texte"][$i], $id_reponse, $_POST["id_section"][$i]);
                        (new TexteRepository())->sauvegarder($texte);
                        $test = true;
                    } else {
                        $texte = new Texte($update, $_POST["texte"][$i], $id_reponse, $_POST["id_section"][$i]);
                        (new TexteRepository())->update($texte);
                        $test = true;
                    }
                    //////////////pour mettre a jour les coauteurs seulement si l'utulisateur est le résponsable de la réponse
                    foreach ($coauteurs as $coauteur) {
                        $aux = true;
                        if (!empty($_POST["idCoAuteur"])) {
                            foreach ($_POST["idCoAuteur"] as $idUser) {
                                if ($idUser == $coauteur->getIdUtilisateur()) {
                                    $aux = true;
                                    break;
                                } else {
                                    $aux = false;
                                }
                            }
                        } else {
                            $aux = false;
                        }
                        if ($aux == false) {
                            (new CoauteurRepository())->supprimer([$id_reponse, $coauteur->getIdUtilisateur()]);
                            $test = true;
                            echo $test;
                        }
                    }
                    if (!empty($_POST["idCoAuteur"])) {
                        foreach ($_POST["idCoAuteur"] as $idUser) {
                            $aux = true;
                            foreach ($coauteurs as $coauteur) {
                                if ($idUser == $coauteur->getIdUtilisateur()) {
                                    $aux = true;
                                    break;
                                } else {
                                    $aux = false;
                                }
                            }
                            if ($coauteurs == null) {
                                $aux = false;
                            }
                            if ($aux == false) {
                                $v3 = new CoAuteur($id_reponse, $idUser);
                                (new CoauteurRepository())->sauvegarder($v3);
                                $test = true;
                            }
                        }
                    }
                } //Sinon si l'utilisateur est coAuteurs
                else if (ConnexionUtilisateur::estCoAuteur($q)) {
                    if (!$verif) {
                        $texte = new Texte(null, $_POST["texte"][$i], $id_reponse, $_POST["id_section"][$i]);
                        (new TexteRepository())->sauvegarder($texte);
                        $test = true;
                    } else {
                        $texte = new Texte($update, $_POST["texte"][$i], $id_reponse, $_POST["id_section"][$i]);
                        (new TexteRepository())->update($texte);
                        $test = true;
                    }
                }
            }
        }
            if ($test == true) {
                MessageFlash::ajouter("success", "Mise à jour avec succès");
                $url = "frontController.php?controller=reponse&action=update&id_reponse=" . $id_reponse . "&id_question=" . $id_question;
                header("Location: $url");
                exit();
            } else {
                MessageFlash::ajouter("warning", "Un problème s'est produit lors de la mise à jour ");
                $url = "frontController.php?controller=question&action=readAll";
                header("Location: $url");
                exit();
            }

    }

    public  static function check(){
        if (isset($_GET['id_reponse']) && !is_null($_GET['id_reponse'])){
        $v= (new ReponseRepository())->select($_GET['id_reponse']);
        if (ConnexionAdmin::estConnecte()){
            $rep = new Reponse($v->getIdRponses(), $v->getIdUtilisateur(), $v->getIdQuestion(), 1);
            (new ReponseRepository())->update($rep);
            MessageFlash::ajouter("success", "Supprimée avec succès");
            $url = "frontController.php?";
            header("Location: $url");
            exit();
        }else{
            self::afficheVue('/view.php', ["pagetitle" => "Ajouter votre question",
                "cheminVueBody" => "reponse/deleted.php", "v" => $v   //"redirige" vers la vue
            ]);
        }}
        else{
            MessageFlash::ajouter("warning", "Autorisation déniée");
            $url = "frontController.php?";
            header("Location: $url");
            exit();
        }
    }

    public static function restaure() : void {
        if (isset($_GET['id_reponse']) && !is_null($_GET['id_reponse']) && ConnexionAdmin::estConnecte()){
            $v= (new ReponseRepository())->select($_GET['id_reponse']);
            $rep = new Reponse($v->getIdRponses(), $v->getIdUtilisateur(), $v->getIdQuestion(), 0);
            (new ReponseRepository())->update($rep);
            MessageFlash::ajouter("success", "Reponse restaurée avec succès");
            $url = "frontController.php?";
            header("Location: $url");
            exit();
        }else{
            MessageFlash::ajouter("warning", "Autorisation déniée");
            $url = "frontController.php?";
            header("Location: $url");
            exit();
        }
    }
    public static function delete() : void {
        if (!isset($_POST["mdp"])){
            MessageFlash::ajouter("danger","Veuillez remplir le formulaire");
            $url="frontController.php?controller=reponse&action=check&id_reponse=" . $_POST['id_reponse'];
            header("Location: ".$url);
            exit();
        }else {
            $user = ConnexionUtilisateur::getUtilisateurConnecte();
            //$user = (new UtilisateurRepository())->selectWhere("login", $_POST["login"]);
            if (!MotDePasse::verifier($_POST["mdp"], $user->getMdpHache())) {
                MessageFlash::ajouter("warning", "mot de passe erroné");
                $url = "frontController.php?controller=reponse&action=check&id_reponse=" . $_POST['id_reponse'];
                header("Location: " . $url);
                exit();
            } else {
                $bol = (new ReponseRepository())->select($_POST['id_reponse']);
                if ($bol != null) {
                    $rep = new Reponse($bol->getIdRponses(), $bol->getIdUtilisateur(), $bol->getIdQuestion(), 1);
                    (new ReponseRepository())->update($rep);
                    MessageFlash::ajouter("success", "Supprimée avec succès");
                    $url = "frontController.php?controller=question&action=readAll";
                    header("Location: $url");
                    exit();
                } else {
                    MessageFlash::ajouter("warning", "Un problème s'est produit");
                    $url = "frontController.php?controller=question&action=readAll";
                    header("Location: $url");
                    exit();
                }

            }
        }

    }

    public static function readMesResponses() : void{
        if (ConnexionUtilisateur::getUtilisateurConnecte()!=null) {
            $question = new QuestionRepository();//appel au modèle pour gerer la BD
            $questions = $question->selectAll();
            self::afficheVue('/view.php', ["pagetitle" => "Liste des questions",
                "cheminVueBody" => "reponse/mesReponses.php",   //"redirige" vers la vue
                "questions" => $questions]);
        }else{
            MessageFlash::ajouter("warning", "Autorisation déniée");
            $url = "frontController.php?controller=reponse&action=readMyResponse";
            header("Location: $url");
            exit();
        }

    }

    public static function readAll(): void
    {
        $u = (ConnexionUtilisateur::getUtilisateurConnecte())->getIdUtilisateur();
        $votants = (new VotantRepository())->selectWhere("id_votant", $u);
        $qustion = (new QuestionRepository())->select($_GET["id_question"]);
        $nomQuestion = $qustion->getIntitule();
        self::afficheVue('/view.php', ["pagetitle" => "Liste des réponses",
            "cheminVueBody" => "reponse/list.php",   //"redirige" vers la vue
             "votants" => $votants, "id_question" => $_GET["id_question"], "nomQuestion"=>$nomQuestion]);
    }

    public static function read(): void
    {
        $textes = (new TexteRepository())->selectWhere("id_reponse", $_GET['id_reponse']);
        if (!empty($textes)) {
            self::afficheVue('/view.php', ["pagetitle" => "detail de la utilisateur",
                "cheminVueBody" => "texte/detail.php",   //"redirige" vers la vue
                "textes" => $textes]);
        } else {
            MessageFlash::ajouter("warning", "Pas encore de réponse du responsable");
            $url = "frontController.php?controller=question&action=readAll";
            header("Location: $url");
            exit();
        }
    }




    public static function error(string $errorMessage): void
    {
        self::afficheVue('view.php', ["pagetitle" => "ERROR", "cheminVueBody" => "utilisateur/error.php", "s" => "Problème avec la utilisateur : $errorMessage "]);

    }


    public static function vote()
    {
        $trouve = false;
        $rep = (new ReponseRepository())->select($_GET["id_reponse"]);
        if (isset($_GET['id_reponse']) && $rep) {

            $v = (new VotantRepository())->select($_GET['id']);
            $votants = (new VotantRepository())->selectWhere('id_reponse', $_GET["id_reponse"]);
            foreach ($votants as $v) {
                if ($v->getIdReponse() == $_GET["id_reponse"]) {
                    if (is_null($v->getVote())) {
                        if ($v) {
                            //var_dump($v);
                            if ($_GET['vote'] == "positif") {
                                if ($v->getVote() == null) {
                                    $res = 1;
                                }

                            }
                            if ($_GET['vote'] == "neutre") {
                                if ($v->getVote() == null) {
                                    $res = 0;
                                }
                            }
                            if ($_GET['vote'] == "negatif") {
                                if ($v->getVote() == null) {
                                    $res = -1;
                                }
                            }

                            $votant = new Votant($_GET['id'], $res, $v->getIdQuestion(), $_GET['id_reponse']);
                            var_dump($votant);
                            (new VotantRepository())->update2($votant);
                            $trouve = true;
                        }
                    }

                }

            }
        }
        if ($trouve == true) {
            MessageFlash::ajouter("success", "Votre choix a été pris en compte");
            header("Location: frontController.php?controller=reponse&action=readAll&id_question=" . $_GET['id_question']);

        } else {
            MessageFlash::ajouter("warning", "Erreur");
            header("Location: frontController.php?controller=reponse&action=readAll&id_question=" . $_GET['id_question']);

        }
    }

    public static function voteFinal(){
        $rep = (new ReponseRepository())->select($_GET["id_reponse"]);
        if(isset($_GET['id_reponse']) && $rep){
            $votants = (new VotantRepository())->selectWhere('id_reponse', $_GET["id_reponse"]);
            $idVotant = $votants[0]->getIdUtilisateur();
            $vote = $votants[0]->getVote();
            echo $vote;
            $votant = new Votant($idVotant, 2, $votants[0]->getIdQuestion(), $_GET['id_reponse']);
            var_dump($votant);
            (new VotantRepository())->update2($votant);
            MessageFlash::ajouter("success", "Votre choix a été pris en compte");
            header("Location: frontController.php?controller=question&action=readAll");

        }
        else{
            MessageFlash::ajouter("warning", "Erreur");
            header("Location: frontController.php?controller=reponse&action=readAll&id_question=" . $_GET['id_question']);

        }


    }


}