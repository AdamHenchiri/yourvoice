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
        return "id_section";
    }
    protected function getNomsColonnes(): array
    {

        return ["id_section","titre","texte_explicatif", "numero", "id_question" ];
    }



}