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
        if (self::contientMessage($type)) {
            $tab = Session::getInstance()->lire(static::$cleFlash);
            $res = $tab[$type];
            unset($tab[$type]);
            Session::getInstance()->enregistrer(static::$cleFlash, $tab);
            return $res;
        }
        return [];
    }

    public static function lireTousMessages() : array{
        $res = [];
        foreach(static::$type as $k) {
            $res[$k] = self::lireMessages($k);
        }
        return $res;
    }


}