<?php
 namespace App\YourVoice\Model\HTTP;

class Cookie
{
    public static function enregistrer(string $cle, mixed $valeur, ?int $dureeExpiration = null): void{
        $newValue = serialize($valeur);
        if($dureeExpiration != null)
            setcookie($cle, $newValue, time() + $dureeExpiration);
        else{
            setcookie($cle, $newValue);
        }
    }

    public static function lire(string $cle): mixed
    {
        $c1 = unserialize($_COOKIE[$cle]);
        echo $c1;
        return $c1;
    }

    public static function contient(string $cle) : bool{
        var_dump(isset($_COOKIE[$cle]));
        return isset($_COOKIE[$cle]);
    }

    public static function supprimer($cle) : void{
        setcookie ($cle, "", 1);
        unset($_COOKIE[$cle]);
    }
}