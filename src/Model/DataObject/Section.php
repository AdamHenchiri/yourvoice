<?php

namespace App\YourVoice\Model\DataObject;
use App\YourVoice\Model\DataObject\Question;

class Section
{

    private string $id_section;
    private string $titre;
    private string $texte_explicatif;
    private int $numero;
    private Question $id_question;

    /**
     * @param string $id_section
     * @param string $titre
     * @param string $texte_explicatif
     * @param int $numero
     * @param \App\YourVoice\Model\DataObject\Question $id_question
     */
    public function __construct(string $id_section, string $titre, string $texte_explicatif, int $numero, \App\YourVoice\Model\DataObject\Question $id_question)
    {
        $this->id_section = $id_section;
        $this->titre = $titre;
        $this->texte_explicatif = $texte_explicatif;
        $this->numero = $numero;
        $this->id_question = $id_question;
    }

    /**
     * @return string
     */
    public function getIdSection(): string
    {
        return $this->id_section;
    }

    /**
     * @param string $id_section
     */
    public function setIdSection(string $id_section): void
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
    public function getNumero(): int
    {
        return $this->numero;
    }

    /**
     * @param int $numero
     */
    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }

    /**
     * @return \App\YourVoice\Model\DataObject\Question
     */
    public function getIdQuestion(): \App\YourVoice\Model\DataObject\Question
    {
        return $this->id_question;
    }

    /**
     * @param \App\YourVoice\Model\DataObject\Question $id_question
     */
    public function setIdQuestion(\App\YourVoice\Model\DataObject\Question $id_question): void
    {
        $this->id_question = $id_question;
    }


}