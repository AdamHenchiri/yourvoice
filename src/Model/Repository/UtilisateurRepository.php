<?php

namespace App\YourVoice\Model\Repository;
use App\YourVoice\Model\DataObject\Utilisateur as User;

class UtilisateurRepository extends AbstractRepository
{
    public function construire(array $userFormatTableau) : User {
        return new User($userFormatTableau['id_utilisateur'],$userFormatTableau['login'],$userFormatTableau['nom'],$userFormatTableau['prenom'],$userFormatTableau['age'],$userFormatTableau['email'],$userFormatTableau["mdpHache"],$userFormatTableau["emailAValider"],$userFormatTableau["nonce"],$userFormatTableau["estOrganisateur"],$userFormatTableau["demandeOrga"]);

    }

    protected function getNomTable(): string{
        return "utilisateurs";
    }

    protected function getNomClePrimaire(): string
    {
        return "id_utilisateur";
    }
    protected function getNomsColonnes(): array
    {
     return ["id_utilisateur","login","nom","prenom","age","email","mdpHache","emailAValider","nonce","estOrganisateur","demandeOrga"];
    }
}