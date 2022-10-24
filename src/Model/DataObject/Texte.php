<?php

namespace App\YourVoice\Model\DataObject;
use App\YourVoice\Model\DataObject\Reponse;
use App\YourVoice\Model\DataObject\Section;

class Texte
{
    private int $id_texte;
    private String $texte;
    private Reponse $id_reponse;
    private Section $id_section;

    /**
     * @param int $id_texte
     * @param String $texte
     * @param Reponse $id_reponse
     * @param Section $id_section
     */
    public function __construct(int $id_texte, string $texte, Reponse $id_reponse, Section $id_section)
    {
        $this->id_texte = $id_texte;
        $this->texte = $texte;
        $this->id_reponse = $id_reponse;
        $this->id_section = $id_section;
    }

    /**
     * @return int
     */
    public function getIdTexte(): int
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
    public function getIdReponse(): Reponse
    {
        return $this->id_reponse;
    }

    /**
     * @param Reponse $id_reponse
     */
    public function setIdReponse(Reponse $id_reponse): void
    {
        $this->id_reponse = $id_reponse;
    }

    /**
     * @return Section
     */
    public function getIdSection(): Section
    {
        return $this->id_section;
    }

    /**
     * @param Section $id_section
     */
    public function setIdSection(Section $id_section): void
    {
        $this->id_section = $id_section;
    }




}