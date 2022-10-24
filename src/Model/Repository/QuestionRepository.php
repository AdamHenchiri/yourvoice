<?php

namespace App\Covoiturage\Model\Repository;
use App\Covoiturage\Model\DataObject\Question as Quest;

class QuestionRepository extends AbstractRepository
{
    public function construire(array $questFormatTableau) : Quest {
        return new Quest($questFormatTableau['idQ'],$questFormatTableau['intitule'],$questFormatTableau['textQuestion'],$questFormatTableau['utilisateurResponsable'],$questFormatTableau['dateDebutVote'],$questFormatTableau['dateFinVote'],$questFormatTableau['dateDebutRedac'],$questFormatTableau['dateFinRedac'],$questFormatTableau['section'],$questFormatTableau['reponse']);
    }

    protected function getNomTable(): string{
        return "question";
    }

    protected function getNomClePrimaire(): string
    {
        return "idQ";
    }
    protected function getNomsColonnes(): array
    {
     return ["idQ","intitule","textQuestion","utilisateurResponsable","dateDebutVote","dateFinVote","dateDebutRedac","dateFinRedac","section","reponse"];
    }
}