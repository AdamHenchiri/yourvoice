<?php

namespace App\YourVoice\Model\DataObject;

class Votant extends AbstractDataObject
{
    private int $id_utilisateur ;
    private ?int $vote;
    private string $id_question ;

    /**
     * @param int $id_utilisateur
     * @param int $vote
     * @param string $id_question
     */
    public function __construct(int $id_utilisateur, ?int $vote, string $id_question)
    {
        $this->id_utilisateur = $id_utilisateur;
        $this->vote = $vote;
        $this->id_question = $id_question;
    }

    /**
     * @return int
     */
    public function getIdUtilisateur(): int
    {
        return $this->id_utilisateur;
    }

    /**
     * @param int $id_utilisateur
     */
    public function setIdUtilisateur(int $id_utilisateur): void
    {
        $this->id_utilisateur = $id_utilisateur;
    }

    /**
     * @return int
     */
    public function getVote(): ?int
    {
        return $this->vote;
    }

    /**
     * @param int $vote
     */
    public function setVote(int $vote): void
    {
        $this->vote = $vote;
    }

    /**
     * @return string
     */
    public function getIdQuestion(): string
    {
        return $this->id_question;
    }

    /**
     * @param string $id_question
     */
    public function setIdQuestion(string $id_question): void
    {
        $this->id_question = $id_question;
    }

    public function formatTableau(): array{
        return array(
            "id_utilisateurTag" => $this->getIdUtilisateur(),
            "voteTag" => $this->getVote(),
            "id_questionTag" => $this->getIdQuestion(),
        );
    }

}