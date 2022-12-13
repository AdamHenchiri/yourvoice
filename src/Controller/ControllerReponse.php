<?php

namespace App\YourVoice\Controller;

use App\YourVoice\Model\DataObject\Question;
use App\YourVoice\Model\DataObject\Votant;
use App\YourVoice\Model\Repository\AbstractRepository;
use App\YourVoice\Model\Repository\CoauteurRepository;
use App\YourVoice\Model\Repository\QuestionRepository;
use App\YourVoice\Model\Repository\ReponseRepository;
use App\YourVoice\Model\DataObject\Reponse ;
use App\YourVoice\Model\DataObject\Texte ;

use App\YourVoice\Model\Repository\TexteRepository;
use App\YourVoice\Model\Repository\VotantRepository;
use http\Env\Response;
use App\YourVoice\Model\DataObject\CoAuteur;
use App\YourVoice\Lib\MessageFlash;



class ControllerReponse extends GenericController
{

    public static function create() : void {
        $q = (new QuestionRepository())->select($_GET['id_question']);
        $dateFin = $q->getDateFinRedaction();
        $dateDebut = $q->getDateDebutRedaction();
        if(date('Y-m-d H:i:s') > $dateFin){
            MessageFlash::ajouter("warning", "Date de rédaction écoulée");
            header("Location: frontController.php?controller=question&action=read&id_question=" . $_GET['id_question'] );
        }
        if(date('Y-m-d H:i:s') < $dateDebut){
            MessageFlash::ajouter("warning", "Rédaction pas encore commencée");
            header("Location: frontController.php?controller=question&action=read&id_question=" . $_GET['id_question'] );
        }
        if(date('Y-m-d H:i:s') <= $dateFin and date('Y-m-d H:i:s') >= $dateDebut) {
            self::afficheVue('/view.php', ["pagetitle" => "Ajouter une réponse",
                "cheminVueBody" => "reponse/create.php",   //"redirige" vers la vue
            ]);
        }
    }


    public static function created() : void {
        $test=false;
        $id_reponse= $_POST["id_reponse"];
        $id_question = $_POST["id_question"];
        $responsables = (new ReponseRepository())->selectWhere("id_reponse", $id_reponse);
        foreach ($_POST["texte"] as $i=>$section) {
            foreach ($responsables as $responsable) {
                $coauteurs = (new CoauteurRepository())->selectWhere("id_reponse", $responsable->getIdRponses());
                $textes = (new TexteRepository())->selectWhere("id_reponse", $responsable->getIdRponses());
                $verif = false;
                $update = "";
                foreach ($textes as $t) {
                    if ($t->getIdSection() == $_POST["id_section"][$i]) {
                        $verif = true;
                        $update = $t->getIdTexte();
                    }
                }
                if ($responsable->getIdUtilisateur() == $_POST["id_utilisateur"]) {
                    $test=true;
                    if (!$verif) {
                        $texte = new Texte(null, $_POST["texte"][$i], $responsable->getIdRponses(), $_POST["id_section"][$i]);
                        (new TexteRepository())->sauvegarder($texte);
                    } else {
                        $texte = new Texte($update, $_POST["texte"][$i], $responsable->getIdRponses(), $_POST["id_section"][$i]);
                        (new TexteRepository())->update($texte);

                    }
                    ////
                    foreach ($coauteurs as $coauteur ) {
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
                            (new CoauteurRepository())->supprimer([ $responsable->getIdRponses(), $coauteur->getIdUtilisateur()]);
                        }
                    }
                    foreach ($_POST["idCoAuteur"] as $idUser) {
                        $aux = true;
                        foreach ($coauteurs as $coauteur ) {
                            if ($idUser == $coauteur->getIdUtilisateur()) {
                                $aux = true;
                                break;
                            } else {
                                $aux = false;
                            }
                        }
                        if($coauteurs==null){
                            $aux=false;
                        }
                        if ($aux == false) {
                            $v3 = new CoAuteur($responsable->getIdRponses(),$idUser);
                            (new CoauteurRepository())->sauvegarder($v3);
                        }
                    }
                }
                 else if ($coauteurs != null) {
                    foreach ($coauteurs as $coauteur) {
                        if ($coauteur->getIdUtilisateur() == $_POST["id_utilisateur"]) {
                            $test=true;
                            if (!$verif) {
                                $texte = new Texte(null, $_POST["texte"][$i], $responsable->getIdRponses(), $_POST["id_section"][$i]);
                                (new TexteRepository())->sauvegarder($texte);
                            } else {
                                $texte = new Texte($update, $_POST["texte"][$i], $responsable->getIdRponses(), $_POST["id_section"][$i]);
                                (new TexteRepository())->update($texte);
                            }
                        }
                    }
                }
            }
        }
        if ($test==true){
            echo "La réponse a bien été créée !";
            ControllerQuestion::readAll();
        }else{
            echo "echec de la création !";
            ControllerQuestion::readAll();
        }
    }

    public static function update() : void {
        $q = (new QuestionRepository())->select($_GET['id_question']);
        $dateFin = $q->getDateFinRedaction();
        $dateDebut = $q->getDateDebutRedaction();
        if(date('Y-m-d H:i:s') > $dateFin) {
            MessageFlash::ajouter("warning", "Date de rédaction écoulée");
            header("Location: frontController.php?controller=question&action=read&id_question=" . $_GET['id_question']);
        }
        if(date('Y-m-d H:i:s') <= $dateFin and date('Y-m-d H:i:s') >= $dateDebut) {
            $textes = (new TexteRepository())->selectWhere("id_reponse", $_GET['id_reponse']);
            if (!empty($textes)) {
                self::afficheVue('/view.php', ["pagetitle" => "detail de la utilisateur",
                    "cheminVueBody" => "texte/update.php",   //"redirige" vers la vue
                    "textes" => $textes]);
            } /*else {
                self::create();
            }*/
        }
    }

    public static function updated() : void {
        $id_question = $_POST["id_question"];
        $responsables = (new ReponseRepository())->selectWhere("id_question", $id_question);
        foreach ($_POST["texte"] as $i=>$section) {
            foreach ($responsables as $responsable) {
                $coauteurs = (new CoauteurRepository())->selectWhere("id_reponse", $responsable->getIdRponses());
                $textes = (new TexteRepository())->selectWhere("id_reponse", $responsable->getIdRponses());
                $verif = false;
                $update = "";
                foreach ($textes as $t) {
                    if ($t->getIdSection() == $_POST["id_section"][$i]) {
                        $verif = true;
                        $update = $t->getIdTexte();
                    }
                }
                if ($responsable->getIdUtilisateur() == $_POST["id_utilisateur"]) {
                    if (!$verif) {
                        $texte = new Texte(null, $_POST["texte"][$i], $responsable->getIdRponses(), $_POST["id_section"][$i]);
                        (new TexteRepository())->sauvegarder($texte);
                    } else {
                        $texte = new Texte($update, $_POST["texte"][$i], $responsable->getIdRponses(), $_POST["id_section"][$i]);
                        (new TexteRepository())->update($texte);

                    }
                    //////////////pour mettre a jour les coauteurs seulement si l'utulisateur est le résponsable de la réponse
                    foreach ($coauteurs as $coauteur ) {
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
                                (new CoauteurRepository())->supprimer([ $responsable->getIdRponses(), $coauteur->getIdUtilisateur()]);
                            }
                    }
                    foreach ($_POST["idCoAuteur"] as $idUser) {
                        $aux = true;
                        foreach ($coauteurs as $coauteur ) {
                            if ($idUser == $coauteur->getIdUtilisateur()) {
                                $aux = true;
                                break;
                            } else {
                                $aux = false;
                            }
                        }
                        if($coauteurs==null){
                            $aux=false;
                        }
                        if ($aux == false) {
                                $v3 = new CoAuteur($responsable->getIdRponses(),$idUser);
                                (new CoauteurRepository())->sauvegarder($v3);
                            }
                        }
                    }

                else if ($coauteurs != null) {
                    foreach ($coauteurs as $coauteur) {
                        if ($coauteur->getIdUtilisateur() == $_POST["id_utilisateur"]) {
                            if (!$verif) {
                                $texte = new Texte(null, $_POST["texte"][$i], $responsable->getIdRponses(), $_POST["id_section"][$i]);
                                (new TexteRepository())->sauvegarder($texte);
                            } else {
                                $texte = new Texte($update, $_POST["texte"][$i], $responsable->getIdRponses(), $_POST["id_section"][$i]);
                                (new TexteRepository())->update($texte);
                            }
                        }
                    }
                }
            }
        }
        ControllerQuestion::readAll();
    }

    public static function delete() : void {
        (new ReponseRepository())->supprimer($_GET['id_reponse']);
        ControllerQuestion::readAll();
    }

    public static function readAll() : void {

        //$reponses =(new ReponseRepository())->selectAll();//appel au modèle pour gerer la BD
        $rep = (new ReponseRepository())->selectWhere("id_question",$_GET['id_question'] );

        self::afficheVue('/view.php', ["pagetitle" => "Liste des réponses",
            "cheminVueBody" => "reponse/list.php",   //"redirige" vers la vue
            "reponses"=>$rep]);
    }

    public static function read() : void {
        $textes= (new TexteRepository())->selectWhere("id_reponse",$_GET['id_reponse']);
        if (!empty($textes)) {
            self::afficheVue('/view.php', ["pagetitle" => "detail de la utilisateur",
                "cheminVueBody" => "texte/detail.php",   //"redirige" vers la vue
                "textes"=>$textes]);
        }else{
            MessageFlash::ajouter("warning","pas encore de réponses");
            $url ="frontController.php?controller=question&action=readAll";
            header("Location: $url");
            exit();
        }
    }

//    private static function afficheVue(string $cheminVue, array $parametres = []) : void {
//        extract($parametres); // Crée des variables à partir du tableau $parametres
//        require "../src/View/$cheminVue"; // Charge la vue
//    }


    public static function error(string $errorMessage):void {
        self::afficheVue('view.php',["pagetitle"=>"ERROR","cheminVueBody"=>"utilisateur/error.php","s"=>"Problème avec la utilisateur : $errorMessage "]);

    }

    public static function vote(){
        $v = (new VotantRepository())->select($_GET['id_votant']);
        $v2 = (new VotantRepository())->selectWhere('id_votant', $_GET['id_votant']);
        if($v){
        //var_dump($v);
        if($_GET['vote']=="positif"){
            if($v->getVote()==null){
                $res = 1;
            }
            else{
                $res = $v->getVote() + 1;
            }

        }
        if($_GET['vote']=="neutre"){
            if($v->getVote()==null){
                $res = 0;
            }
            else{
                $res = $v->getVote() + 0;
            }
        }
        if($_GET['vote']=="negatif"){
            if($v->getVote()==null){
                $res = -1;
            }
            else{
                $res = $v->getVote() - 1;
            }
        }

        $votant = new Votant($_GET['id_votant'], $res , $v->getIdQuestion(), $_GET['id_reponse']);
        var_dump($votant);
        (new VotantRepository())->update2($votant);
        MessageFlash::ajouter("seccess", "Erreur");

        }
        else{
            MessageFlash::ajouter("warning", "Votre choix a été pris en compte");
        }
        header("Location: frontController.php?controller=reponse&action=readAll&id_question=" . $_GET['id_question']);
        //$rep = (new ReponseRepository())->selectWhere("id_question",$_GET['id_question'] );

        /*self::afficheVue('/view.php', ["pagetitle" => "Liste des réponses",
            "cheminVueBody" => "reponse/list.php",   //"redirige" vers la vue
            "reponses"=>$rep, "id_question"=>$v->getIdQuestion()]);*/
    }

}