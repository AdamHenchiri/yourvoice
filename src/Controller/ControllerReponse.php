<?php

namespace App\YourVoice\Controller;

use App\YourVoice\Lib\ConnexionUtilisateur;
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
        if (date('Y-m-d H:i:s') > $dateFin) {
            MessageFlash::ajouter("warning", "Date de rédaction écoulée");
            header("Location: frontController.php?controller=question&action=read&id_question=" . $_GET['id_question']);
        }
        if (date('Y-m-d H:i:s') < $dateDebut) {
            MessageFlash::ajouter("warning", "Rédaction pas encore commencée");
            header("Location: frontController.php?controller=question&action=read&id_question=" . $_GET['id_question']);
        }
        if (date('Y-m-d H:i:s') <= $dateFin and date('Y-m-d H:i:s') >= $dateDebut) {
            self::afficheVue('/view.php', ["pagetitle" => "Ajouter une réponse",
                "cheminVueBody" => "reponse/create.php",   //"redirige" vers la vue
            ]);
        }
    }


    public static function created(): void
    {
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
                if ($reponse->getIdUtilisateur() == ConnexionUtilisateur::getUtilisateurConnecte()->getIdUtilisateur()) {
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
            MessageFlash::ajouter("success", "réponse ajouter avec succès");
            $url = "frontController.php?controller=reponse&action=update&id_reponse=" . $id_reponse . "&id_question=" . $id_question;
            header("Location: $url");
            exit();
        } else {
            MessageFlash::ajouter("warning", "un problème dans s'est produit lors de l'ajout");
            $url = "frontController.php?controller=reponse&action=update&id_reponse=" . $id_reponse . "&id_question=" . $id_question;
            header("Location: $url");
            exit();
        }
    }

    public static function update(): void
    {
        $q = (new QuestionRepository())->select($_GET['id_question']);
        $dateFin = $q->getDateFinRedaction();
        $dateDebut = $q->getDateDebutRedaction();
        $textes = (new TexteRepository())->selectWhere("id_reponse", $_GET['id_reponse']);
        if (date('Y-m-d H:i:s') > $dateFin) {
            MessageFlash::ajouter("warning", "Date de rédaction écoulée");
            header("Location: frontController.php?controller=question&action=read&id_question=" . $_GET['id_question']);
        }
        if (date('Y-m-d H:i:s') < $dateDebut) {
            MessageFlash::ajouter("warning", "Rédaction pas encore commencée");
            header("Location: frontController.php?controller=question&action=read&id_question=" . $_GET['id_question']);
        }
        if (date('Y-m-d H:i:s') <= $dateFin and date('Y-m-d H:i:s') >= $dateDebut) {
            if (ConnexionUtilisateur::estResponsable($q) || ConnexionUtilisateur::estCoAuteur($_GET['id_question'])) {
                self::afficheVue('/view.php', ["pagetitle" => "Update d'une réponse",
                    "cheminVueBody" => "texte/update.php",   //"redirige" vers la
                    "textes" => $textes
                ]);
            } else {
                MessageFlash::ajouter("warning", "Autorisation déniée");
                $url = "frontController.php";
                header("Location: $url");
                exit();
            }
        }

    }

    public static function updated(): void
    {
        $test = false;
        $id_question = $_POST["id_question"];
        $q = (new QuestionRepository())->select($id_question);
        $id_reponse = $_POST["id_reponse"];
        $responsable = (new ReponseRepository())->selectWhereAnd("id_question", $id_question,"id_reponse",$id_reponse);
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
                if (ConnexionUtilisateur::estResponsable($q)) {
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
                        foreach ($_POST["idCoAuteur"] as $idUser) {
                            if ($idUser == $coauteur->getIdUtilisateur()) {
                                $aux = true;
                                break;
                            } else {
                                $aux = false;
                            }
                        }
                        if ($aux == false) {
                            (new CoauteurRepository())->supprimer([$id_reponse, $coauteur->getIdUtilisateur()]);
                            $test = true;
                        }
                    }
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
                //Sinon si l'utilisateur est coAuteurs
                else if (ConnexionUtilisateur::estCoAuteur($id_question)) {
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
        if ($test == true) {
            MessageFlash::ajouter("success", "mise à jour avec succès");
            $url = "frontController.php?controller=question&action=readAll";
            header("Location: $url");
            exit();
        } else {
            MessageFlash::ajouter("warning", "un problème s'est produit lors de la mise à jour ");
            $url = "frontController.php?controller=question&action=readAll";
            header("Location: $url");
            exit();
        }
    }

    public static function delete(): void
    {
        $bol = (new ReponseRepository())->supprimer($_GET['id_reponse']);
        if ($bol == true) {
            MessageFlash::ajouter("success", "supprimer avec succès");
            $url = "frontController.php?controller=question&action=readAll";
            header("Location: $url");
            exit();
        } else {
            MessageFlash::ajouter("warning", "un problème s'est produit");
            $url = "frontController.php?controller=question&action=readAll";
            header("Location: $url");
            exit();
        }
    }

    public static function readAll(): void
    {

        //$reponses =(new ReponseRepository())->selectAll();//appel au modèle pour gerer la BD
        $rep = (new ReponseRepository())->selectWhere("id_question", $_GET['id_question']);

        self::afficheVue('/view.php', ["pagetitle" => "Liste des réponses",
            "cheminVueBody" => "reponse/list.php",   //"redirige" vers la vue
            "reponses" => $rep]);
    }

    public static function read(): void
    {
        $textes = (new TexteRepository())->selectWhere("id_reponse", $_GET['id_reponse']);
        if (!empty($textes)) {
            self::afficheVue('/view.php', ["pagetitle" => "detail de la utilisateur",
                "cheminVueBody" => "texte/detail.php",   //"redirige" vers la vue
                "textes" => $textes]);
        } else {
            MessageFlash::ajouter("warning", "pas encore de réponses");
            $url = "frontController.php?controller=question&action=readAll";
            header("Location: $url");
            exit();
        }
    }

//    private static function afficheVue(string $cheminVue, array $parametres = []) : void {
//        extract($parametres); // Crée des variables à partir du tableau $parametres
//        require "../src/View/$cheminVue"; // Charge la vue
//    }


    public static function error(string $errorMessage): void
    {
        self::afficheVue('view.php', ["pagetitle" => "ERROR", "cheminVueBody" => "utilisateur/error.php", "s" => "Problème avec la utilisateur : $errorMessage "]);

    }

    public static function vote()
    {
        $v = (new VotantRepository())->select($_GET['id_votant']);
        $v2 = (new VotantRepository())->selectWhere('id_votant', $_GET['id_votant']);
        if ($v) {
            //var_dump($v);
            if ($_GET['vote'] == "positif") {
                if ($v->getVote() == null) {
                    $res = 1;
                } else {
                    $res = $v->getVote() + 1;
                }

            }
            if ($_GET['vote'] == "neutre") {
                if ($v->getVote() == null) {
                    $res = 0;
                } else {
                    $res = $v->getVote() + 0;
                }
            }
            if ($_GET['vote'] == "negatif") {
                if ($v->getVote() == null) {
                    $res = -1;
                } else {
                    $res = $v->getVote() - 1;
                }
            }

            $votant = new Votant($_GET['id_votant'], $res, $v->getIdQuestion(), $_GET['id_reponse']);
            var_dump($votant);
            (new VotantRepository())->update2($votant);
            MessageFlash::ajouter("seccess", "Erreur");

        } else {
            MessageFlash::ajouter("warning", "Votre choix a été pris en compte");
        }
        header("Location: frontController.php?controller=reponse&action=readAll&id_question=" . $_GET['id_question']);
        //$rep = (new ReponseRepository())->selectWhere("id_question",$_GET['id_question'] );

        /*self::afficheVue('/view.php', ["pagetitle" => "Liste des réponses",
            "cheminVueBody" => "reponse/list.php",   //"redirige" vers la vue
            "reponses"=>$rep, "id_question"=>$v->getIdQuestion()]);*/
    }

}