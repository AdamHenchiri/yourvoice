<?php

namespace App\YourVoice\Model\Repository;

use App\YourVoice\Model\DataObject\Reponse;

class ReponseRepository extends AbstractRepository
{
    public function construire(array $reponseFormatTableau) : Reponse {
        return new Reponse($reponseFormatTableau['id_reponse'],$reponseFormatTableau['id_responsable'],$reponseFormatTableau['id_question']);
    }

    protected function getNomTable(): string{
        return "reponse";
    }

    protected function getNomClePrimaire(): string
    {
        return "id_reponse";
    }
    protected function getNomClesPrimaires(): array
    {
        return ["id_responsable","id_question"];
    }
    protected function getNomsColonnes(): array
    {
        return ["id_reponse","id_responsable","id_question"];
    }

}