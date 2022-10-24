<?php

namespace App\YourVoice\Model\DataObject;
use App\YourVoice\Model\DataObject\Question;
use App\YourVoice\Model\Repository\DatabaseConnection;

class Reponse
{

    private int $id;
    private string $id_utilisateur;
    private Question $id_question;


    public function __construct(int $id, string $id_utilisateur, Question $id_question)
    {
        $this->id = $id;
        $this->id_utilisateur = $id_utilisateur;
        $this->id_question = $id_question;
    }


    /**
     * @return string
     */

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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