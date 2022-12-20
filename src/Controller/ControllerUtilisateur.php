<?php

namespace App\YourVoice\Controller;

use App\YourVoice\Lib\ConnexionUtilisateur;
use App\YourVoice\Lib\MessageFlash;
use App\YourVoice\Lib\MotDePasse;
use App\YourVoice\Lib\VerificationEmail;
use App\YourVoice\Model\DataObject\Question;
use App\YourVoice\Model\DataObject\Utilisateur;
use App\YourVoice\Model\Repository\AbstractRepository;
use App\YourVoice\Model\Repository\UtilisateurRepository;


class ControllerUtilisateur extends GenericController
{

    public static function connexion(): void{
        self::afficheVue('/view.php', ["pagetitle" => "connection",
            "cheminVueBody" => "utilisateur/connexion.php"   //"redirige" vers la vue
        ]);
    }

    public static function connected() : void {
        if (!isset($_POST["login"]) && !isset($_POST["mdp"])){
            MessageFlash::ajouter("danger","Veuillez remplir le formulaire");
            $url="frontController.php?controller=utilisateur&action=connexion";
            header("Location: ".$url);
            exit();
        }else{
            $user=(new UtilisateurRepository())->selectWhere("login",$_POST["login"]);
            if ($user==null){
                MessageFlash::ajouter("warning","Utilisateur inconnu");
                $url="frontController.php?controller=utilisateur&action=connexion";
                header("Location: ".$url);
                exit();
            }
            else if (!MotDePasse::verifier($_POST["mdp"],$user[0]->getMdpHache())){
                MessageFlash::ajouter("warning","Mot de passe erroné");
                $url="frontController.php?controller=utilisateur&action=connexion";
                header("Location: ".$url);
                exit();
            }
            else{
                ConnexionUtilisateur::connecter($_POST["login"]);
                MessageFlash::ajouter("success","Bienvenue ".$_POST["login"]);
                $url="frontController.php?controller=utilisateur&action=read&login=".$_POST["login"];
                header("Location: ".$url);
                exit();
            }
        }
    }

    public static function deconnecter(): void
    {
        ConnexionUtilisateur::deconnecter();
        MessageFlash::ajouter("success","Vous êtes déconnecté(e)");
        $url="frontController.php?controller=question&action=readAll";
        header("Location: ".$url);
        exit();
    }

    public static function estUtilisateur($login): bool
    {
        return ConnexionUtilisateur::getLoginUtilisateurConnecte()==$login;
    }

    public static function create() : void {
        self::afficheVue('/view.php', ["pagetitle" => "Ajouter votre utilisateur",
            "cheminVueBody" => "utilisateur/create.php"   //"redirige" vers la vue
        ]);
    }


    public static function created() : void {
        if ($_POST["mdp"] == $_POST["mdp2"]) {
            $v = Utilisateur::construireDepuisFormulaire(["login" => $_POST["login"], "nom" => $_POST["nom"], "prenom" => $_POST["prenom"], "age" => $_POST["age"], "email" => $_POST["email"], "mdp" => $_POST["mdp"]]);
            (new UtilisateurRepository())->sauvegarder($v);
            MessageFlash::ajouter("success", "Merci de confirmer votre email");
            $url = "frontController.php?controller=utilisateur&action=connexion";
            header("Location: $url");
            exit();
        } else {
            MessageFlash::ajouter("warning", "Mots de passe distincts");
            $url = "frontController.php?controller=utilisateur&action=create";
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

    public static function readAll() : void {

        $utilisateurs =(new UtilisateurRepository())->selectAll();//appel au modèle pour gerer la BD
        self::afficheVue('/view.php', ["pagetitle" => "Liste des utilisateurs",
            "cheminVueBody" => "utilisateur/list.php",   //"redirige" vers la vue
            "utilisateurs"=>$utilisateurs]);
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
        $user =(new UtilisateurRepository())->selectWhere("login",ConnexionUtilisateur::getLoginUtilisateurConnecte());
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

//    private static function afficheVue(string $cheminVue, array $parametres = []) : void {
//        extract($parametres); // Crée des variables à partir du tableau $parametres
//        require "../src/View/$cheminVue"; // Charge la vue
//    }


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
