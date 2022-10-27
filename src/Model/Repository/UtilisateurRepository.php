<?php

namespace App\YourVoice\Model\Repository;
use App\YourVoice\Model\DataObject\Utilisateur as User;

class UtilisateurRepository extends AbstractRepository
{
    public function construire(array $userFormatTableau) : User {
        return new User($userFormatTableau['login'],$userFormatTableau['nom'],$userFormatTableau['prenom']);
    }

    protected function getNomTable(): string{
        return "utilisateurs";
    }

    protected function getNomClePrimaire(): string
    {
        return "login";
    }
    protected function getNomsColonnes(): array
    {
     return ["login","nom","prenom"];
    }
}