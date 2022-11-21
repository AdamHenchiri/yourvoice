<?php

namespace App\YourVoice\Model\DataObject;
use App\YourVoice\Model\DataObject\Question;
use App\YourVoice\Model\Repository\DatabaseConnection;

class Reponse
{

    private int $id_reponse;
    private int $id_utilisateur;
    private int $id_question;


    public function __construct(string $id_reponse, string $id_utilisateur, int $id_question)
    {
        $this->id_reponse = $id_reponse;
        $this->id_utilisateur = $id_utilisateur;
        $this->id_question = $id_question;
    }


    /**
     * @return string
     */

    public function getIdRponses(): string
    {
        return $this->id_reponse;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id_reponse;
    }

    /**
     * @return string
     */
    public function getIdUtilisateur(): string
    {
        return $this->id_utilisateur;
    }

    /**
     * @param string $id_utilisateur
     */
    public function setIdUtilisateur(string $id_utilisateur): void
    {
        $this->id_utilisateur = $id_utilisateur;
    }

    /**
     * @return Question
     */
    public function getIdQuestion(): Question
    {
        return $this->id_question;
    }

    /**
     * @param Question $id_question
     */
    public function setIdQuestion(Question $id_question): void
    {
        $this->id_question = $id_question;
    }

}