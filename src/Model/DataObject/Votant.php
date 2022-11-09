<?php

namespace App\YourVoice\Model\DataObject;

class Votant
{
    private int $id_reponse;
    private int $id_utilisateur;
    private string $vote;

    /**
     * @param int $id_reponse
     * @param int $id_utilisateur
     * @param string $vote
     */
    public function __construct(int $id_reponse, int $id_utilisateur, string $vote)
    {
        $this->id_reponse = $id_reponse;
        $this->id_utilisateur = $id_utilisateur;
        $this->vote = $vote;
    }

    /**
     * @return int
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
     * @return string
     */
    public function getVote(): string
    {
        return $this->vote;
    }

    /**
     * @param string $vote
     */
    public function setVote(string $vote): void
    {
        $this->vote = $vote;
    }


}