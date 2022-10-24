<?php

namespace App\YourVoice\Model\Repository;

use App\YourVoice\Model\DataObject\Reponse;
use App\YourVoice\Model\DataObject\Section;

class SectionRepository
{
    public function construire(array $sectionFormatTableau) : Section {
        return new Section($sectionFormatTableau['section'],$sectionFormatTableau['titre'],$sectionFormatTableau['texteExplicatif'], $sectionFormatTableau['numero'], $sectionFormatTableau['texteReponse'], $sectionFormatTableau['question']);
    }

    protected function getNomTable(): string{
        return "section";
    }

    protected function getNomClePrimaire(): string
    {
        return "section";
    }
    protected function getNomsColonnes(): array
    {
        return ["section","titre","texteExplicatif", "numero", "texteReponse", "question" ];
    }



}