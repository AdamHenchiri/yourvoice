<?php

namespace App\YourVoice\Model\HTTP;
use Exception;

class Session
{

    private static ?Session $instance = null;

    /**
     * @throws Exception
     */
    private function __construct()
    {
        if (session_start() === false) {
            throw new Exception("La session n'a pas réussi à démarrer.");
        }
    }

    public static function getInstance(): Session
    {
        if (is_null(static::$instance))
            static::$instance = new Session();
        return static::$instance;
    }

    public function contient($name): bool
    {
        return isset($_SESSION[$name]);
    }

    public function enregistrer(string $name, mixed $value): void
    {
        $_SESSION[$name] = ($value);
    }

    public function lire(string $name): mixed
    {
        if ($this->contient($name)) {
            return ($_SESSION[$name]);
        }
        return null;

    }

    public function supprimer($name): void
    {
        if ($this->contient($name)) {
            unset($_SESSION[$name]);
        }
    }

    public function detruire(): void
    {
        session_unset();     // unset $_SESSION variable for the run-time
        session_destroy();   // destroy session data in storage
        Cookie::supprimer(session_name()); // deletes the session cookie
        // Il faudra reconstruire la session au prochain appel de getInstance()
        $instance = null;
    }

}