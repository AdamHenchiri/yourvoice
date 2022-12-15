<?php

namespace App\YourVoice\Lib;

use App\YourVoice\Model\DataObject\Utilisateur;
use App\YourVoice\Model\HTTP\Session;
use App\YourVoice\Model\Repository\ReponseRepository;
use App\YourVoice\Model\Repository\UtilisateurRepository;
use mysql_xdevapi\Statement;

class ConnexionUtilisateur
{
    // L'utilisateur connecté sera enregistré en session associé à la clé suivante
    private static string $cleConnexion = "_utilisateurConnecte";

    public static function connecter(string $loginUtilisateur): void
    {
        Session::getInstance()->enregistrer(static::$cleConnexion,$loginUtilisateur);
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
        if (!self::estConnecte()){
            return null;
        }else{
            return Session::getInstance()->lire(static::$cleConnexion);
        }
    }
    public static function getUtilisateurConnecte(): ?Utilisateur
    {
        if (!self::estConnecte()){
            return null;
        }else{
           $tab= (new UtilisateurRepository())->selectWhere("login",Session::getInstance()->lire(static::$cleConnexion)) ;
           return $tab[0];
        }
    }
    //Cette méthode doit renvoyer true si un utilisateur est connecté et qu’il est administrateur. Les informations sur l’utilisateur devront être récupérées de la base de données
    public static function estAdministrateur() : bool{
        $user=Session::getInstance()->lire(static::$cleConnexion);
        if ($user!=null) {
            $userAdmin = (new UtilisateurRepository())->selectWhereAnd("login", $user, "estAdmin", 1);
            return ($userAdmin == null) ? false : true;
        }else{
            return false;
        }
    }

    public static function estResponsable() : bool
    {
        $user = Session::getInstance()->lire(static::$cleConnexion);
        if (self::estConnecte()) {
            $log = self::getUtilisateurConnecte();
            $u = (new UtilisateurRepository())->select($log);
            $rep = (new ReponseRepository())->selectWhere('id_utilisateur', $log);
            if (empty($rep)) {
                return false;
            } else {
                return true;
            }
        }
        else{
            return false;
        }
    }
}