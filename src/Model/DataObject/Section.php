<?php

namespace App\YourVoice\Model\DataObject;
use App\YourVoice\Model\DataObject\Question;

class Section extends AbstractDataObject
{

    private ?int $id_section;
    private string $titre;
    private string $texte_explicatif;
    private int $id_question;

    /**
     * @param string $id_section
     * @param string $titre
     * @param string $texte_explicatif
     * @param int $id_question
     */
    public function __construct(?int $id_section, string $titre, string $texte_explicatif, int $id_question)
    {
        $this->id_section = $id_section;
        $this->titre = $titre;
        $this->texte_explicatif = $texte_explicatif;
        $this->id_question = $id_question;
    }

    /**
     * @return string
     */
    public function getIdSection(): ?int
    {
        return $this->id_section;
    }

    /**
     * @param string $id_section
     */
    public function setIdSection(int $id_section): void
    {
        $this->id_section = $id_section;
    }

    /**
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getTexteExplicatif(): string
    {
        return $this->texte_explicatif;
    }

    /**
     * @param string $texte_explicatif
     */
    public function setTexteExplicatif(string $texte_explicatif): void
    {
        $this->texte_explicatif = $texte_explicatif;
    }

    /**
     * @return int
     */
    public function getIdQuestion(): int
    {
        return $this->id_question;
    }

    /**
     * @param int $id_question
     */
    public function setIdQuestion(int $id_question): void
    {
        $this->id_question = $id_question;
    }


    public function formatTableau(): array
    {
        return array(
            "id_sectionTag" => $this->getIdSection(),
            "titreTag" => $this->getTitre(),
            "texte_explicatifTag" => $this->getTexteExplicatif(),
            "id_questionTag" => $this->getIdQuestion(),
        );
    }
}