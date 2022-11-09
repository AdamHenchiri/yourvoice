<?php

namespace App\YourVoice\Controller;

use App\YourVoice\Model\DataObject\Question;
use App\YourVoice\Model\DataObject\Utilisateur;
use App\YourVoice\Model\Repository\AbstractRepository;
use App\YourVoice\Model\Repository\UtilisateurRepository;


class ControllerUtilisateur
{

    public static function connexion(): void{
        self::afficheVue('/view.php', ["pagetitle" => "connection",
            "cheminVueBody" => "utilisateur/connexion.php"   //"redirige" vers la vue
        ]);
    }

    public static function connected() : void {
        $v= (new UtilisateurRepository())->select($_POST['login']);
        if ($v!=NULL && $v->getMdp()==$_POST['mdp']){
            self::afficheVue('/view.php', ["pagetitle" => "connected",
                "cheminVueBody" => "utilisateur/connected.php",//"redirige" vers la vue
                "prenom"=>$v->getPrenom()
            ]);
            ControllerQuestion::readAll();
        }
        else{
            echo "login ou mot de passe incorrecte";
            self::afficheVue('/view.php', ["pagetitle" => "connexion",
                "cheminVueBody" => "utilisateur/connexion.php",   //"redirige" vers la vue
            ]);
        }
    }

    public static function create() : void {
        self::afficheVue('/view.php', ["pagetitle" => "Ajouter votre utilisateur",
            "cheminVueBody" => "utilisateur/create.php"   //"redirige" vers la vue
        ]);
    }


    public static function created() : void {
        $v=new Utilisateur(null,$_POST["login"],$_POST["nom"],$_POST["prenom"],$_POST["age"],$_POST["email"],$_POST["mdp"]);
        (new UtilisateurRepository())->sauvegarder($v);
        self::afficheVue('/view.php', ["pagetitle" => "creation de utilisateur",
            "cheminVueBody" => "utilisateur/created.php"   //"redirige" vers la vue
        ]);
        self::readAll();
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