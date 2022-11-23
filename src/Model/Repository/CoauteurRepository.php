<?php

namespace App\YourVoice\Model\Repository;
use App\YourVoice\Model\DataObject\CoAuteur;
use App\YourVoice\Model\DataObject\Contributeur;
use App\YourVoice\Model\DataObject\Utilisateur;

class CoauteurRepository extends AbstractRepository {

    public function construire(array $questFormatTableau) : CoAuteur {
        return new CoAuteur($questFormatTableau['id_reponse'],$questFormatTableau['id_coauteur']);
    }

    protected function getNomTable(): string{
        return "est_coAuteur";
    }

    protected function getNomClePrimaire(): string
    {
        return "id_reponse";
    }
    protected function getNomClesPrimaires(): array
    {
        return ["id_reponse","id_coauteur"];
    }
    protected function getNomsColonnes(): array
    {
        return ["id_reponse","id_coauteur"];
    }
}
