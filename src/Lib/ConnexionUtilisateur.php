<?php

namespace App\YourVoice\Lib;

use App\YourVoice\Model\DataObject\Utilisateur;
use App\YourVoice\Model\HTTP\Session;
use App\YourVoice\Model\Repository\CoauteurRepository;
use App\YourVoice\Model\Repository\ReponseRepository;
use App\YourVoice\Model\Repository\UtilisateurRepository;

class ConnexionUtilisateur
{

    // L'utilisateur connecté sera enregistré en session associé à la clé suivante
    private static string $cleConnexion = "_utilisateurConnecte";

    public static function connecter(string $loginUtilisateur): void
    {
        Session::getInstance()->enregistrer(static::$cleConnexion, $loginUtilisateur);
    }

    public static function estConnecte(): bool
    {
        return Session::getInstance()->contient(static::$cleConnexion);
    }

    public static function deconnecter(): void
    {
        Session::getInstance()->supprimer(static::$cleConnexion);
    }

    public static function getLoginUtilisateurConnecte(): ?string
    {
        if (!self::estConnecte()) {
            return null;
        } else {
            return Session::getInstance()->lire(static::$cleConnexion);
        }
    }

    public static function getUtilisateurConnecte(): ?Utilisateur
    {
        if (!self::estConnecte()) {
            return null;
        } else {
            $tab = (new UtilisateurRepository())->selectWhere("login", Session::getInstance()->lire(static::$cleConnexion));
            return $tab[0];
        }
    }

    //Cette méthode doit renvoyer true si un utilisateur est connecté et qu’il est administrateur. Les informations sur l’utilisateur devront être récupérées de la base de données


    /*public static function estAdministrateur() : bool{
        $user=Session::getInstance()->lire(static::$cleConnexion);
        if ($user!=null) {
            $userAdmin = (new UtilisateurRepository())->selectWhereAnd("login", $user, "estAdmin", 1);
            return ($userAdmin == null) ? false : true;
        }else{
            return false;
        }
    }*/

    public static function estOrganisateur($question): bool // Fonctionne ok
    {
        $user = Session::getInstance()->lire(static::$cleConnexion);
        if (self::estConnecte()) {
            $log = self::getUtilisateurConnecte()->getLogin();
            //$q = (new QuestionRepository())->select($question->getIdQuestion());
            $id = $question->getIdUtilisateur();
            $utilisateur = (new UtilisateurRepository())->select($id);
            $exist = $utilisateur->getLogin();
            //echo "<p> utilisateur ? ". $exist. "// </p>";
            //echo "<p> connecter : ". $log. "// </p>";
            if ($exist == $log) {
                //echo "<p> yes </p>";
                return true;
            } else {
                //echo "<p> no </p>";

                return false;
            }
        } else {
            return false;
        }
    }

    // confirmer que l'utilisateur en session est responsable de la question $question
    public static function estResponsable($question)
    {
        if (self::estConnecte()) {
            $u = (self::getUtilisateurConnecte())->getIdUtilisateur();
            $reponseTab = (new ReponseRepository())->selectWhere('id_question', $question->getIdQuestion());
            foreach ($reponseTab as $reponse) {
                if ($reponse->getIdUtilisateur() == $u) {
                    // echo 'true';
                    return true;
                }

            }

        } else {
            return false;
        }
        return false;

    }

    public static function estResponsableReponse($reponse): bool //Fonctionne ok
    {
        if (self::estConnecte()) {
            $log = self::getUtilisateurConnecte()->getLogin();
            $reponseTab = (new ReponseRepository())->selectWhere('id_reponse', $reponse->getIdRponses());
            foreach ($reponseTab as $reponse) {
                $idUtilisateur = $reponse->getIdUtilisateur();
                $responsable = (new UtilisateurRepository())->select($idUtilisateur);
                $loginResponsable = $responsable->getLogin();
                if ($loginResponsable == $log) {
                    return true;
                } else {
                    return false;
                }

            }

        } else {
            return false;
        }
        return false;
    }

    public static function estCoAuteur($question): bool
    {
        $user = Session::getInstance()->lire(static::$cleConnexion);
        if (self::estConnecte()) {
            $log = self::getUtilisateurConnecte()->getLogin();
            $reponseTab = (new ReponseRepository())->selectWhere('id_question', $question->getIdQuestion());
            foreach ($reponseTab as $reponse) {
                $idResponsable = $reponse->getIdRponses();
                $coAuteurs = (new CoauteurRepository())->selectWhere("id_reponse", $idResponsable);
                foreach ($coAuteurs as $coAuteur) {
                    $idCoAuteur = $coAuteur->getIdUtilisateur();
                    $utilisateur = (new UtilisateurRepository())->select($idCoAuteur);
                    $loginCoAuteur = $utilisateur->getLogin();
                    //echo "<p> utilisateur ? ". $loginCoAuteur. "// </p>";
                    //echo "<p> connecter : ". $log. "// </p>";
                    if ($loginCoAuteur == $log) {
                        return true;
                    }
                }

            }
        } else {
            return false;
        }
        return false;
    }

    public static function estCoAuteurReponse($reponse): bool
    {
        $user = Session::getInstance()->lire(static::$cleConnexion);
        if (self::estConnecte()) {
            $log = self::getUtilisateurConnecte()->getLogin();
            $reponseTab = (new ReponseRepository())->selectWhere('id_reponse', $reponse->getIdRponses());
            foreach ($reponseTab as $reponse) {
                $idResponsable = $reponse->getIdRponses();
                $coAuteurs = (new CoauteurRepository())->selectWhere("id_reponse", $idResponsable);
                //var_dump($coAuteurs);
                foreach ($coAuteurs as $coAuteur) {
                    $idCoAuteur = $coAuteur->getIdUtilisateur();
                    $utilisateur = (new UtilisateurRepository())->select($idCoAuteur);
                    $loginCoAuteur = $utilisateur->getLogin();
                    //echo "<p> utilisateur ? ". $loginCoAuteur. "// </p>";
                    //echo "<p> connecter : ". $log. "// </p>";
                    if ($loginCoAuteur == $log) {
                        return true;
                    }
                }

            }
        } else {
            return false;
        }
        return false;
    }

    public static function estAdministrateur(): bool
    {
        if (self::estConnecte()) {
            $log = self::getLoginUtilisateurConnecte();
            $u = (new AdminRepository())->select($log);
            if ($u->isEstAdmin()) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }
    }

}