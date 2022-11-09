<?php

namespace App\YourVoice\Model\Repository;
use App\YourVoice\Model\DataObject\Utilisateur as User;

class VotantRepository extends AbstractRepository {

    public function construire(array $questFormatTableau) : Votant {
        return new Votant($questFormatTableau['id_utilisateur'],$questFormatTableau['vote'],$questFormatTableau['id_question']);
    }

    protected function getNomTable(): string{
        return "est_votant";
    }

    protected function getNomClePrimaire(): string
    {
        return "id_utilisateur";
    }
    protected function getNomsColonnes(): array
    {
        return ["id_utilisateur","vote","id_question"];
    }
}
