<?php

namespace App\YourVoice\Lib;

use App\YourVoice\Model\HTTP\Session;

class MessageFlash
{
    private static string $cleFlash = "_messagesFlash";
    private static array $type = ["success", "info", "warning", "danger"];

    // $type parmi "success", "info", "warning" ou "danger"
    public static function ajouter(string $type, string $message): void
    {
        $tab = self::lireTousMessages();
        $tab[$type][] = $message;
        Session::getInstance()->enregistrer(static::$cleFlash, $tab);

    }

    public static function contientMessage(string $type): bool{
        if (!Session::getInstance()->contient(static::$cleFlash)) {
            return false;
        } else if (!isset(Session::getInstance()->lire(static::$cleFlash)[$type])) {
            return false;
        } else if (count(Session::getInstance()->lire(static::$cleFlash)[$type]) == 0) {
            return false;
        }
        return true;
    }

    // Attention : la lecture doit détruire le message
    public static function lireMessages(string $type): array
    {
        if (!self::contientMessage($type)) {
            return [];
        }

        // get message from the session
        $flash_message = Session::getInstance()->lire(static::$cleFlash);
        $res=$flash_message[$type];

        // delete the flash message
        unset($flash_message[$type]);

        // pour remettre les autres
        Session::getInstance()->enregistrer(static::$cleFlash,$flash_message);

        // display the flash message
        return ($res);
    }

    public static function lireTousMessages() : array{
        $tab=[
            "success"=>self::lireMessages("success"),
            "info"=>self::lireMessages("info"),
            "warning"=>self::lireMessages("warning"),
            "danger"=>self::lireMessages("danger")
        ];
        return $tab;
    }


}