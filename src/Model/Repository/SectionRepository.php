<?php

namespace App\YourVoice\Model\Repository;

use App\YourVoice\Model\DataObject\Reponse;
use App\YourVoice\Model\DataObject\Section;

class SectionRepository extends AbstractRepository
{
    public function construire(array $sectionFormatTableau) : Section {
        return new Section($sectionFormatTableau['id_section'],$sectionFormatTableau['titre'],$sectionFormatTableau['texte_explicatif'], $sectionFormatTableau['numero'], $sectionFormatTableau['id_question']);
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