<?php

namespace App\YourVoice\Controller;

use App\YourVoice\Lib\ConnexionAdmin;
use App\YourVoice\Lib\ConnexionUtilisateur;
use App\YourVoice\Lib\MessageFlash;
use App\YourVoice\Lib\MotDePasse;
use App\YourVoice\Lib\VerificationEmail;
use App\YourVoice\Model\DataObject\Admin;
use App\YourVoice\Model\DataObject\Question;
use App\YourVoice\Model\DataObject\Utilisateur;
use App\YourVoice\Model\Repository\AbstractRepository;
use App\YourVoice\Model\Repository\AdminRepository;
use App\YourVoice\Model\Repository\QuestionRepository;
use App\YourVoice\Model\Repository\UtilisateurRepository;


class ControllerAdmin extends GenericController
{

    public static function connexion(): void{
        self::afficheVue('/view.php', ["pagetitle" => "connection",
            "cheminVueBody" => "admin/connexion.php"   //"redirige" vers la vue
        ]);
    }

    public static function connected() : void {
        if (!isset($_POST["login"]) && !isset($_POST["password"])){
            MessageFlash::ajouter("danger","Veuillez remplir le formulaire");
            $url="frontController.php?controller=admin&action=connexion";
            header("Location: ".$url);
            exit();
        }else{
            $user=(new AdminRepository())->selectWhere("login",$_POST["login"]);
            if ($user==null){
                MessageFlash::ajouter("warning","Utilisateur inconnu");
                $url="frontController.php?controller=admin&action=connexion";
                header("Location: ".$url);
                exit();
            }
            else if (!MotDePasse::verifier($_POST["mdp"],$user[0]->getPassword())){
                MessageFlash::ajouter("warning","Mot de passe erroné");
                $url="frontController.php?controller=admin&action=connexion";
                header("Location: ".$url);
                exit();
            }
            else{
                 ConnexionAdmin::connecter($_POST["login"]);
                MessageFlash::ajouter("success","Bienvenue ".$_POST["login"]);
                $url="frontController.php?controller=admin&action=readAllUsers";
                header("Location: ".$url);
                exit();
            }
        }
    }

    public static function deconnecter(): void
    {
         ConnexionAdmin::deconnecter();
        MessageFlash::ajouter("success","Vous êtes déconnecté(e)");
        $url="frontController.php?controller=question&action=readAll";
        header("Location: ".$url);
        exit();
    }

    public static function estUtilisateur($login): bool
    {
        return  ConnexionAdmin::getLoginUtilisateurConnecte()==$login;
    }

    public static function create() : void {
        self::afficheVue('/view.php', ["pagetitle" => "Ajouter votre utilisateur",
            "cheminVueBody" => "admin/create.php"   //"redirige" vers la vue
        ]);
    }


    public static function created() : void {
        if ($_POST["password_2"] == $_POST["password_1"]) {
            $v = Admin::construireDepuisFormulaire(["login" => $_POST["login"],"password" => $_POST["password_1"], "email" => $_POST["email"]]);
            (new AdminRepository())->sauvegarder($v);
            MessageFlash::ajouter("success", "Merci de confirmer votre email");
            $url = "frontController.php?controller=admin&action=connexion";
            header("Location: $url");
            exit();
        } else {
            MessageFlash::ajouter("warning", "Mots de passe distincts");
            $url = "frontController.php?controller=admin&action=create";
            header("Location: $url");
            exit();
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

    public static function readAllUsers() : void {
        if (ConnexionAdmin::estConnecte()) {
            $utilisateurs = (new UtilisateurRepository())->selectAll();//appel au modèle pour gerer la BD
            self::afficheVue('/view.php', ["pagetitle" => "Liste des utilisateurs",
                "cheminVueBody" => "utilisateur/list.php",   //"redirige" vers la vue
                "utilisateurs" => $utilisateurs]);
        }else{
            MessageFlash::ajouter("warning","autorisation dénié ");
            $url="frontController.php?";
            header("Location: ".$url);
            exit();
        }
    }
    public static function readAllQuest() : void {
        if (ConnexionAdmin::estConnecte()) {
            $questions = (new QuestionRepository())->selectAll();//appel au modèle pour gerer la BD
            self::afficheVue('/view.php', ["pagetitle" => "Liste des utilisateurs",
                "cheminVueBody" => "question/list.php",   //"redirige" vers la vue
                "questions" => $questions]);
        }else{
            MessageFlash::ajouter("warning","autorisation dénié ");
            $url="frontController.php?";
            header("Location: ".$url);
            exit();
        }
    }

    public static function devenirOrga() : void {
        $demandeur = (new UtilisateurRepository())->select($_GET["login"]);
        if (ConnexionAdmin::estConnecte() && !$demandeur->isEstOrganisateur()) {
            $u = new Utilisateur( $demandeur->getIdUtilisateur(), $demandeur->getLogin(), $demandeur->getNom(), $demandeur->getPrenom(), $demandeur->getAge(), $demandeur->getEmail(), $demandeur->getMdpHache(), $demandeur->getEmailAValider(), $demandeur->getNonce(),1,0);
            (new UtilisateurRepository())->update($u);
            MessageFlash::ajouter("success", "l'utilisateur est maintenant organisateur");
            $url = "frontController.php?controller=admin&action=readAllUsers";
            header("Location: $url");
            exit();
        }else{
            MessageFlash::ajouter("warning","autorisation dénié ");
            $url="frontController.php?";
            header("Location: ".$url);
            exit();
        }
    }

    public static function neplusdevenirOrga() : void {
        $demandeur = (new UtilisateurRepository())->select($_GET["login"]);
        if (ConnexionAdmin::estConnecte() && $demandeur->isEstOrganisateur()) {
            $u = new Utilisateur( $demandeur->getIdUtilisateur(), $demandeur->getLogin(), $demandeur->getNom(), $demandeur->getPrenom(), $demandeur->getAge(), $demandeur->getEmail(), $demandeur->getMdpHache(), $demandeur->getEmailAValider(), $demandeur->getNonce(),0,0);
            (new UtilisateurRepository())->update($u);
            MessageFlash::ajouter("success", "l'utilisateur n'est maintenant plus organisateur");
            $url = "frontController.php?controller=admin&action=readAllUsers";
            header("Location: $url");
            exit();
        }else{
            MessageFlash::ajouter("warning","autorisation dénié ");
            $url="frontController.php?";
            header("Location: ".$url);
            exit();
        }

    }

    public static function read() : void {
        $user =(new UtilisateurRepository())->selectWhere("login",$_GET['login']);
        if ($user!==null) {
            self::afficheVue('/view.php', ["pagetitle" => "detail de la utilisateur",
                "cheminVueBody" => "utilisateur/detail.php",   //"redirige" vers la vue
                "user"=>$user[0]]);
        }else{
            self::afficheVue('/view.php', ["pagetitle" => "ERROR",
                "cheminVueBody" => "utilisateur/error.php",   //"redirige" vers la vue
            ]);
        }
    }
    public static function monCompte() : void {
        $user =(new UtilisateurRepository())->selectWhere("login", ConnexionAdmin::getLoginUtilisateurConnecte());
        if ($user!==null) {
            self::afficheVue('/view.php', ["pagetitle" => "detail de la utilisateur",
                "cheminVueBody" => "utilisateur/detail.php",   //"redirige" vers la vue
                "user"=>$user[0]]);
        }else{
            self::afficheVue('/view.php', ["pagetitle" => "ERROR",
                "cheminVueBody" => "utilisateur/error.php",   //"redirige" vers la vue
            ]);
        }
    }


    public static function error(string $errorMessage):void {
        self::afficheVue('view.php',["pagetitle"=>"ERROR","cheminVueBody"=>"utilisateur/error.php","s"=>"Problème avec la utilisateur : $errorMessage "]);

    }

    public static function validerEmail ():void {
        if (isset($_GET["login"])&& isset($_GET["nonce"])){
            if ( VerificationEmail::traiterEmailValidation($_GET["login"],$_GET["nonce"])){
                MessageFlash::ajouter("success","Bravo! vous avez validé votre email");
                $url="frontController.php?controller=utilisateur&action=read&login=".$_GET["login"];
                header("Location: ".$url);
                exit();
            }else{
                MessageFlash::ajouter("warning","Error :: email non valide");
                $url="frontController.php?controller=utilisateur&action=readAll";
                header("Location: ".$url);
                exit();
            }
        }else{
            MessageFlash::ajouter("warning","Login ou nonce introuvable");
            $url="frontController.php?controller=utilisateur&action=readAll";
            header("Location: ".$url);
            exit();
        }
    }
}
