<?php
namespace App\YourVoice\Lib;

use App\YourVoice\Model\DataObject\Utilisateur;
use App\YourVoice\Model\Repository\UtilisateurRepository;
use App\YourVoice\Config\Conf;

class VerificationEmail
{
    public static function envoiEmailValidation(Utilisateur $utilisateur): void
    {

        $loginURL = rawurlencode($utilisateur->getLogin());
        $nonceURL = rawurlencode($utilisateur->getNonce());
        $absoluteURL = Conf::getAbsoluteURL();
        $lienValidationEmail = "$absoluteURL?action=validerEmail&controller=utilisateur&login=$loginURL&nonce=$nonceURL";
        $corpsEmail = "<a href=\"$lienValidationEmail\">Validation</a>";

        $mailURL = rawurldecode($utilisateur->getEmailAValider());
        // The message
        $message = $nonceURL;

        // In case any of our lines are larger than 70 characters, we should use wordwrap()
        $message = wordwrap($message, 70, "\r\n");

        // Send
        mail($mailURL, 'Vérifié votre mail !!', $corpsEmail);
        // Temporairement avant d'envoyer un vrai mail
        //   MessageFlash::ajouter("success", $corpsEmail);
    }

    public static function traiterEmailValidation($login, $nonce): bool
    {
        $u=(new UtilisateurRepository())->selectWhereAnd("login",$login,"nonce",$nonce);
        if ($u!=false){
        $client=$u[0];
                $mail = $client->getEmailAValider();
                $client->setEmail($mail);
                $client->setNonce("");
                (new UtilisateurRepository())->update($client);
            return true;
        }else{
            return false;
        }
    }

    public static function aValideEmail(Utilisateur $utilisateur) : bool
    {
        // À compléter
        return true;
    }
}



