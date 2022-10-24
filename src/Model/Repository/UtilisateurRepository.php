<?php

namespace App\Covoiturage\Model\Repository;
use App\Covoiturage\Model\DataObject\Utilisateur as User;

class UtilisateurRepository extends AbstractRepository
{
    public function construire(array $userFormatTableau) : User {
        return new User($userFormatTableau['login'],$userFormatTableau['nom'],$userFormatTableau['prenom']);
    }

    protected function getNomTable(): string{
        return "utilisateur";
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