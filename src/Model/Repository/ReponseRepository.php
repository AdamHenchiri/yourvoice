<?php

namespace App\YourVoice\Model\Repository;

use App\YourVoice\Model\DataObject\Reponse;

class ReponseRepository
{
    public function construire(array $reponseFormatTableau) : Reponse {
        return new Reponse($reponseFormatTableau['$id_reponse'],$reponseFormatTableau['$id_utilisateur'],$reponseFormatTableau['$id_question']);
    }

    protected function getNomTable(): string{
        return "reponse";
    }

    protected function getNomClePrimaire(): string
    {
        return "id_reponse";
    }
    protected function getNomsColonnes(): array
    {
        return ["id_reponse","id_utilisateur","id_question"];
    }

}