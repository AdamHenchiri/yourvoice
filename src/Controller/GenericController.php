<?php

namespace App\YourVoice\Controller;
use App\YourVoice\Lib\MessageFlash;

class GenericController
{

    protected static function afficheVue(string $cheminVue, array $parametres = []) : void {
        $parametres["messageFlash"] = MessageFlash::lireTousMessages();
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require "../src/View/$cheminVue"; // Charge la vue
    }

}