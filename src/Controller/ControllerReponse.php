<?php

namespace App\YourVoice\Controller;

use App\YourVoice\Model\DataObject\Votant;
use App\YourVoice\Model\Repository\AbstractRepository;
use App\YourVoice\Model\Repository\ReponseRepository;
use App\YourVoice\Model\DataObject\Reponse ;
use App\YourVoice\Model\Repository\VotantRepository;
use http\Env\Response;
use App\YourVoice\Model\DataObject\CoAuteur;
use App\YourVoice\Model\Repository\ContributeurRepository;


class ControllerReponse
{

    public static function create() : void {
        self::afficheVue('/view.php', ["pagetitle" => "Ajouter une réponse",
            "cheminVueBody" => "reponse/create.php"   //"redirige" vers la vue
        ]);
    }


    public static function created() : void {
        $v=new Reponse($_POST["id_reponse"],$_POST["id_utilisateur"],$_POST["id_question"]);
        (new ReponseRepository())->sauvegarder($v);
        foreach ($_POST["idCoAuteur"] as $idUser) {
            if ($idUser) {
                $v2 = new CoAuteur($idUser, $v);
                (new ContributeurRepository())->sauvegarder($v2);
            }
        }

        self::afficheVue('/view.php', ["pagetitle" => "creation de utilisateur",
            "cheminVueBody" => "reponse/created.php"   //"redirige" vers la vue
        ]);
        self::readAll();
    }

    public static function update() : void {
        $v= (new ReponseRepository())->select($_GET['id_reponse']);
        self::afficheVue('/view.php',["pagetitle"=>"mettre à jour une utilisateur","cheminVueBody"=>"utilisateur/update.php","v"=>$v]);
    }

    public static function updated() : void {
        $v=new Response($_POST["id_reponse"],$_POST["id_utilisateur"],$_POST["id_question"]);
        (new ReponseRepository())->update($v);
        self::afficheVue('/view.php', ["pagetitle" => "creation de utilisateur",
            "cheminVueBody" => "utilisateur/updated.php" ,  //"redirige" vers la vue
            "login"=>htmlspecialchars($v->getId()),
        ]);
        self::readAll();
    }

    public static function delete() : void {
        $v=(new ReponseRepository())->select($_GET['login']);
        $rep=(new ReponseRepository())->supprimer($_GET['login']);
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

        $reponses =(new ReponseRepository())->selectAll();//appel au modèle pour gerer la BD
        self::afficheVue('/view.php', ["pagetitle" => "Liste des réponses",
            "cheminVueBody" => "reponse/detail.php",   //"redirige" vers la vue
            "reponses"=>$reponses]);
    }

    public static function read() : void {
        $user =(new ReponseRepository())->select($_GET['login']);
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