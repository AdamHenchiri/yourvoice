<?php

namespace App\YourVoice\Model\Repository;
use App\YourVoice\Model\DataObject\Votant;

class VotantRepository extends AbstractRepository {

    public function construire(array $questFormatTableau) : Votant {
        return new Votant($questFormatTableau['id_votant'],$questFormatTableau['vote'],$questFormatTableau['id_question'],$questFormatTableau['id_reponse']);
    }

    protected function getNomTable(): string{
        return "est_votant";
    }

    protected function getNomClePrimaire(): string
    {
        return "id_votant";
    }

    /*protected function getNomClesPrimaires(): array
    {
        return ["id_votant", "id_question"];
    }*/
    protected function getNomsColonnes(): array
    {
        return ["id_votant","vote","id_question","id_reponse"];
    }
}
