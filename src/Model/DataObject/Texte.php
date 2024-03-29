<?php

namespace App\YourVoice\Model\DataObject;
use App\YourVoice\Model\DataObject\Reponse;
use App\YourVoice\Model\DataObject\Section;

class Texte extends AbstractDataObject
{
    private ?int $id_texte;
    private String $texte;
    private int $id_reponse;
    private int $id_section;

    /**
     * @param int $id_texte
     * @param String $texte
     * @param int $id_reponse
     * @param int $id_section
     */
    public function __construct(?int $id_texte, string $texte, int $id_reponse, int $id_section)
    {
        $this->id_texte = $id_texte;
        $this->texte = $texte;
        $this->id_reponse = $id_reponse;
        $this->id_section = $id_section;
    }

    /**
     * @return int
     */
    public function getIdTexte(): ?int
    {
        return $this->id_texte;
    }

    /**
     * @param int $id_texte
     */
    public function setIdTexte(int $id_texte): void
    {
        $this->id_texte = $id_texte;
    }

    /**
     * @return String
     */
    public function getTexte(): string
    {
        return $this->texte;
    }

    /**
     * @param String $texte
     */
    public function setTexte(string $texte): void
    {
        $this->texte = $texte;
    }

    /**
     * @return Reponse
     */
    public function getIdReponse(): int
    {
        return $this->id_reponse;
    }

    /**
     * @param int $id_reponse
     */
    public function setIdReponse(int $id_reponse): void
    {
        $this->id_reponse = $id_reponse;
    }

    /**
     * @return int
     */
    public function getIdSection(): int
    {
        return $this->id_section;
    }

    /**
     * @param int $id_section
     */
    public function setIdSection(int $id_section): void
    {
        $this->id_section = $id_section;
    }

    public function formatTableau(): array{
        return array(
            "id_texteTag" => $this->getIdTexte(),
            "texteTag" => $this->getTexte(),
            "id_reponseTag" => $this->getIdReponse(),
            "id_sectionTag" => $this->getIdSection(),
        );
    }



}