<?php

namespace App\YourVoice\Controller;

use App\YourVoice\Lib\ConnexionAdmin;
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
        if (!isset($_POST["login"]) && !isset($_POST["mdp"]) ){
            MessageFlash::ajouter("danger","Veuillez remplir le formulaire");
            $url="frontController.php?controller=utilisateur&action=connexion";
            header("Location: ".$url);
            exit();
        }else{
            $user=(new UtilisateurRepository())->selectWhere("login",$_POST["login"]);
                if ($user == null) {
                    MessageFlash::ajouter("warning", "Utilisateur inconnu");
                    $url = "frontController.php?controller=utilisateur&action=connexion";
                    header("Location: " . $url);
                    exit();
                } else if (!MotDePasse::verifier($_POST["mdp"], $user[0]->getMdpHache())) {
                    MessageFlash::ajouter("warning", "Mot de passe erroné");
                    $url = "frontController.php?controller=utilisateur&action=connexion";
                    header("Location: " . $url);
                    exit();
                }
                else if (VerificationEmail::aValideEmail($user[0])) {
                    ConnexionUtilisateur::connecter($_POST["login"]);
                    MessageFlash::ajouter("success", "Bienvenue " . $_POST["login"]);
                    $url = "frontController.php?controller=utilisateur&action=read&login=" . $_POST["login"];
                    header("Location: " . $url);
                    exit();
                }
                else{
                    MessageFlash::ajouter("warning", "Vous n'avez pas vérifié votre email");
                    $url = "frontController.php?controller=utilisateur&action=connexion";
                    header("Location: " . $url);
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
        $u = (new UtilisateurRepository())->select($_POST['id']);
        if (ConnexionUtilisateur::getUtilisateurConnecte() == $u || ConnexionAdmin::estConnecte() ) {
            if (ConnexionAdmin::estConnecte() && MotDePasse::verifier($_POST["mdp1"],ConnexionAdmin::getUtilisateurConnecte()->getPassword())){
                if($_POST["mdp2"]==$_POST["mdp3"] && $_POST["mdp2"]!=null && $_POST["mdp3"]!=null){
                    $v =new Utilisateur($_POST["id"],$_POST["login"],$_POST["nom"],$_POST["prenom"], $_POST["age"],"",MotDePasse::hacher($_POST["mdp3"]),$_POST["email"],$u->getNonce(),$u->isEstOrganisateur(),$u->isDemandeOrga() );
                    (new UtilisateurRepository())->update($v);
                    MessageFlash::ajouter("success","L'utilisateur a été mise à jour! ");
                    $url="frontController.php?controller=admin&action=readAllUsers";
                    header("Location: ".$url);
                    exit();
                }else if ($_POST["mdp2"]==null && $_POST["mdp3"]==null){
                    $v =new Utilisateur($_POST["id"],$_POST["login"],$_POST["nom"],$_POST["prenom"], $_POST["age"],"",$u->getMdpHache(),$_POST["email"],$u->getNonce(),$u->isEstOrganisateur(),$u->isDemandeOrga() );
                    (new UtilisateurRepository())->update($v);
                    MessageFlash::ajouter("success","L'utilisateur a été mise à jour! ");
                    $url="frontController.php?controller=admin&action=readAllUsers";
                    header("Location: ".$url);
                }
            }
            if (ConnexionUtilisateur::estConnecte() && MotDePasse::verifier($_POST["mdp1"],ConnexionUtilisateur::getUtilisateurConnecte()->getMdpHache())){
                if($_POST["mdp2"]==$_POST["mdp3"] && $_POST["mdp2"]!=null && $_POST["mdp3"]!=null){
                    $v =new Utilisateur($_POST["id"],$_POST["login"],$_POST["nom"],$_POST["prenom"], $_POST["age"],"",MotDePasse::hacher($_POST["mdp3"]),$_POST["email"],$u->getNonce(),$u->isEstOrganisateur(),$u->isDemandeOrga() );
                    (new UtilisateurRepository())->update($v);
                    MessageFlash::ajouter("success","Vos informations personnelles ont été mise à jour! ");
                    $url="frontController.php?controller=Utilisateur&action=monCompte";
                    header("Location: ".$url);
                    exit();
                }else if ($_POST["mdp2"]==null && $_POST["mdp3"]==null){
                    $v =new Utilisateur($_POST["id"],$_POST["login"],$_POST["nom"],$_POST["prenom"], $_POST["age"],"",$u->getMdpHache(),$_POST["email"],$u->getNonce(),$u->isEstOrganisateur(),$u->isDemandeOrga() );
                    (new UtilisateurRepository())->update($v);
                    MessageFlash::ajouter("success","L'utilisateur a été mise à jour! ");
                    $url="frontController.php?controller=Utilisateur&action=monCompte";
                    header("Location: ".$url);
                }
            }
        }

    }

    public static function delete() : void {
        if (isset($_GET['login']) && !is_null($_GET['login']) && ConnexionAdmin::estConnecte()) {
            $v = (new UtilisateurRepository())->selectWhere("login", $_GET['login']);
            if (count($v) != null) {
                $rep = (new UtilisateurRepository())->supprimer($v[0]->getIdUtilisateur());
                MessageFlash::ajouter("success", "L'utilisateur a été supprimée ! ");
                $url = "frontController.php?";
                header("Location: " . $url);
            } else {
                MessageFlash::ajouter("warning", "L'utilisateur n'existe pas ! ");
                $url = "frontController.php?";
                header("Location: " . $url);
            }
        }else{
            MessageFlash::ajouter("warning", "Autorisation déniée");
            $url = "frontController.php";
            header("Location: $url");
            exit();
        }
    }

    public static function readAll() : void {

        $utilisateurs =(new UtilisateurRepository())->selectAll();//appel au modèle pour gerer la BD
        self::afficheVue('/view.php', ["pagetitle" => "Liste des utilisateurs",
            "cheminVueBody" => "utilisateur/list.php",   //"redirige" vers la vue
            "utilisateurs"=>$utilisateurs]);
    }

    public static function read() : void {
        if (isset($_GET['login']) && (ConnexionUtilisateur::getLoginUtilisateurConnecte()==$_GET['login'] || ConnexionAdmin::estConnecte()) ) {
            $user = (new UtilisateurRepository())->selectWhere("login", $_GET['login']);
            if ($user !== null) {
                self::afficheVue('/view.php', ["pagetitle" => "detail de la utilisateur",
                    "cheminVueBody" => "utilisateur/detail.php",   //"redirige" vers la vue
                    "user" => $user[0]]);
            } else {
                self::afficheVue('/view.php', ["pagetitle" => "ERROR",
                    "cheminVueBody" => "utilisateur/error.php",   //"redirige" vers la vue
                ]);
            }
        }else{
            MessageFlash::ajouter("warning", "Autorisation déniée");
            $url = "frontController.php?controller=reponse&action=readMyResponse";
            header("Location: $url");
            exit();
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
                MessageFlash::ajouter("success","Bravo! Vous avez validé votre email");
                $url="frontController.php?controller=utilisateur&action=read&login=".$_GET["login"];
                header("Location: ".$url);
                exit();
            }else{
                MessageFlash::ajouter("warning","Error :: email non valide");
                $url="frontController.php?";
                header("Location: ".$url);
                exit();
            }
        }else{
            MessageFlash::ajouter("warning","Login ou nonce introuvable");
            $url="frontController.php?";
            header("Location: ".$url);
            exit();
        }
    }
}
