<?php

namespace App\YourVoice\Model\Repository;

use App\YourVoice\Model\DataObject\Texte;

class TexteRepository extends AbstractRepository
{
    public function construire(array $texteFormatTableau) : Texte {
        return new Texte($texteFormatTableau['id_texte'],$texteFormatTableau['texte'],$texteFormatTableau['id_reponse'],  $texteFormatTableau['id_section']);
    }

    protected function getNomTable(): string{
        return "texte";
    }

    protected function getNomClePrimaire(): string
    {
        return "id_texte";
    }
    protected function getNomsColonnes(): array
    {

        return ["id_texte","texte","id_reponse", "id_section" ];
    }



}