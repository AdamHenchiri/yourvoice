<?php

namespace App\YourVoice\Model\DataObject;

class Votant extends AbstractDataObject
{
    private int $id_votant ;
    private ?int $vote;
    private string $id_question ;
    private ?int $id_reponse;


    /**
     * @param int $id_votant
     * @param int $vote
     * @param string $id_question
     */
    public function __construct(int $id_votant, ?int $vote, string $id_question, ?int $id_reponse)
    {
        $this->id_votant = $id_votant;
        $this->vote = $vote;
        $this->id_question = $id_question;
        $this->id_reponse = $id_reponse;
    }

    /**
     * @return int
     */
    public function getIdUtilisateur(): int
    {
        return $this->id_votant;
    }

    /**
     * @param int $id_votant
     */
    public function setIdUtilisateur(int $id_votant): void
    {
        $this->id_votant = $id_votant;
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

    /**
     * @return int
     */
    public function getIdVotant(): int
    {
        return $this->id_votant;
    }

    /**
     * @param int $id_votant
     */
    public function setIdVotant(int $id_votant): void
    {
        $this->id_votant = $id_votant;
    }

    /**
     * @return int|null
     */
    public function getIdReponse(): ?int
    {
        return $this->id_reponse;
    }

    /**
     * @param int|null $id_reponse
     */
    public function setIdReponse(?int $id_reponse): void
    {
        $this->id_reponse = $id_reponse;
    }


    public function formatTableau(): array{
        return array(
            "id_votantTag" => $this->getIdUtilisateur(),
            "voteTag" => $this->getVote(),
            "id_questionTag" => $this->getIdQuestion(),
            "id_reponseTag" => $this->getIdReponse(),

        );
    }

}