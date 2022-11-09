<?php

namespace App\YourVoice\Model\Repository;
use App\YourVoice\Model\DataObject\Contributeur;
use App\YourVoice\Model\DataObject\Utilisateur;

class ContributeurRepository extends AbstractRepository {

    public function construire(array $questFormatTableau) : Contributeur {
        return new Contributeur($questFormatTableau['id_utilisateur'],$questFormatTableau['id_question']);
    }

    protected function getNomTable(): string{
        return "est_contributeur";
    }

    protected function getNomClePrimaire(): string
    {
        return "id_utilisateur";
    }
    protected function getNomsColonnes(): array
    {
        return ["id_utilisateur","id_question"];
    }
}
