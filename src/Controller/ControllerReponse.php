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



class ControllerReponse
{

    public static function create() : void {

        self::afficheVue('/view.php', ["pagetitle" => "Ajouter une réponse",
            "cheminVueBody" => "reponse/create.php",   //"redirige" vers la vue
        ]);
    }


    public static function created() : void {
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
                    if ($_POST["idCoAuteur"]!=null) {
                        foreach ($_POST["idCoAuteur"] as $idUser) {
                            if ($idUser) {
                                $v3 = new CoAuteur($responsable->getIdRponses(), $idUser);
                                (new CoauteurRepository())->sauvegarder($v3);
                            }
                        }
                    }
                } else if ($coauteurs != null) {
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
        }//else{
                //impossible car utilisateur non valide
            //}


        self::afficheVue('/view.php', ["pagetitle" => "creation de utilisateur",
            "cheminVueBody" => "reponse/created.php"   //"redirige" vers la vue
        ]);
        //self::readAll();
    }

    public static function update() : void {
        $reponses= (new ReponseRepository())->select($_GET['id_reponse']);
        self::afficheVue('/view.php',["pagetitle"=>"mettre à jour une réponse","cheminVueBody"=>"reponse/update.php","reponses"=>$reponses]);
    }

    public static function updated() : void {
        $reponses=new Response($_POST["id_reponse"],$_POST["id_responsable"],$_POST["id_question"]);
        (new ReponseRepository())->update($reponses);
        self::afficheVue('/view.php', ["pagetitle" => "creation de utilisateur",
            "cheminVueBody" => "reponse/updated.php" ,  //"redirige" vers la vue
            "id_reponse"=>htmlspecialchars($reponses->getIdRponses()),
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
        $textes= (new TexteRepository())->selectWhere("id_reponse",$_GET['id_reponse']);
        if ($textes!==null) {
            self::afficheVue('/view.php', ["pagetitle" => "detail de la utilisateur",
                "cheminVueBody" => "texte/detail.php",   //"redirige" vers la vue
                "textes"=>$textes]);
        }else{
            self::afficheVue('/view.php', ["pagetitle" => "ERROR",
                "cheminVueBody" => "texte/error.php",   //"redirige" vers la vue
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