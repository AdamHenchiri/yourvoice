<?php

namespace App\YourVoice\Model\Repository;
use App\YourVoice\Model\DataObject\Question;
use App\YourVoice\Model\DataObject\Question as Quest;

class QuestionRepository extends AbstractRepository
{


    public function construire(array $questFormatTableau) : Question {
        return new Question(
            $questFormatTableau['id_question'],
            $questFormatTableau['intitule'],
            $questFormatTableau['explication'],
            $questFormatTableau['dateDebut_redaction'],
            $questFormatTableau['dateFin_redaction'],
            $questFormatTableau['dateDebut_vote'],
            $questFormatTableau['dateFin_vote'],
            $questFormatTableau['id_organisateur'],
            $questFormatTableau['actif']);
    }

    protected function getNomTable(): string{
        return "question";
    }

    protected function getNomClePrimaire(): string
    {
        return "id_question";
    }
    protected function getNomsColonnes(): array
    {
     return ["id_question","intitule","explication","dateDebut_redaction","dateFin_redaction","dateDebut_vote","dateFin_vote","id_organisateur", "actif"];
    }
}