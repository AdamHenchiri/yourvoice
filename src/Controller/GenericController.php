<?php

namespace App\YourVoice\Controller;

class GenericController
{

    protected static function afficheVue(string $cheminVue, array $parametres = []) : void {
        //$parametres["msgFlash"] = MessageFlash::lireTousMessages();
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require "../src/View/$cheminVue"; // Charge la vue
    }

}