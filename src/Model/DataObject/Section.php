<?php

namespace App\YourVoice\Model\DataObject;
use App\YourVoice\Model\DataObject\Question;

class Section
{

    private string $section;
    private string $titre;
    private string $texteExplicatif;
    private int $numero;
    private $texteReponse;
    private Question $id_question;


    /**
     * @param String $section
     * @param String $titre
     * @param String $texteExplicatif
     * @param int $numero
     * @param $texteReponse
     * @param Question $id_question
     */
    public function __construct(string $section, string $titre, string $texteExplicatif, int $numero, $texteReponse, Question $id_question)
    {
        $this->section = $section;
        $this->titre = $titre;
        $this->texteExplicatif = $texteExplicatif;
        $this->numero = $numero;
        $this->texteReponse = $texteReponse;
        $this->id_question = $id_question;
    }

    /**
     * @return String
     */
    public function getSection(): string
    {
        return $this->section;
    }

    /**
     * @param String $section
     */
    public function setSection(string $section): void
    {
        $this->section = $section;
    }

    /**
     * @return String
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * @param String $titre
     */
    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @return String
     */
    public function getTexteExplicatif(): string
    {
        return $this->texteExplicatif;
    }

    /**
     * @param String $texteExplicatif
     */
    public function setTexteExplicatif(string $texteExplicatif): void
    {
        $this->texteExplicatif = $texteExplicatif;
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
     * @return mixed
     */
    public function getTexteReponse()
    {
        return $this->texteReponse;
    }

    /**
     * @param mixed $texteReponse
     */
    public function setTexteReponse($texteReponse): void
    {
        $this->texteReponse = $texteReponse;
    }

    /**
     * @return Question
     */
    public function getid_question(): Question
    {
        return $this->id_question;
    }

    /**
     * @param Question $id_question
     */
    public function setid_question(Question $id_question): void
    {
        $this->id_question = $id_question;
    }

}