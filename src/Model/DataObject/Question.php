<?php

namespace App\YourVoice\Model\DataObject;
use App\YourVoice\Model\DataObject\AbstractDataObject;
use App\YourVoice\Model\DataObject\Utilisateur;

class Question extends AbstractDataObject
{
    private ?int $id_question;
    private string $intitule;
    private string $explication;
    private string $dateDebut_redaction;
    private string $dateFin_redaction;
    private string $dateDebut_vote;
    private string $dateFin_vote;
    private int $id_organisateur  ;

    /**
     * @param string $intitule
     * @param string $explication
     * @param string $dateDebut_redaction
     * @param string $dateFin_redaction
     * @param string $dateDebut_vote
     * @param string $dateFin_vote
     * @param Utilisateur $id_organisateur
     */
    public function __construct(?int $id_question,string $intitule, string $explication, string $dateDebut_redaction, string $dateFin_redaction, string $dateDebut_vote, string $dateFin_vote, int $id_organisateur )
    {
        $this->id_question = $id_question;
        $this->intitule = $intitule;
        $this->explication = $explication;
        $this->dateDebut_redaction = $dateDebut_redaction;
        $this->dateFin_redaction = $dateFin_redaction;
        $this->dateDebut_vote = $dateDebut_vote;
        $this->dateFin_vote = $dateFin_vote;
        $this->id_organisateur  = $id_organisateur ;
    }

    /**
     * @return int
     */
    public function getIdQuestion(): ?int
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

    /**
     * @return string
     */
    public function getIntitule(): string
    {
        return $this->intitule;
    }

    /**
     * @param string $intitule
     */
    public function setIntitule(string $intitule): void
    {
        $this->intitule = $intitule;
    }

    /**
     * @return string
     */
    public function getExplication(): string
    {
        return $this->explication;
    }

    /**
     * @param string $explication
     */
    public function setExplication(string $explication): void
    {
        $this->explication = $explication;
    }

    /**
     * @return string
     */
    public function getDateDebutRedaction(): string
    {
        return $this->dateDebut_redaction;
    }

    /**
     * @param string $dateDebut_redaction
     */
    public function setDateDebutRedaction(string $dateDebut_redaction): void
    {
        $this->dateDebut_redaction = $dateDebut_redaction;
    }

    /**
     * @return string
     */
    public function getDateFinRedaction(): string
    {
        return $this->dateFin_redaction;
    }

    /**
     * @param string $dateFin_redaction
     */
    public function setDateFinRedaction(string $dateFin_redaction): void
    {
        $this->dateFin_redaction = $dateFin_redaction;
    }

    /**
     * @return string
     */
    public function getDateDebutVote(): string
    {
        return $this->dateDebut_vote;
    }

    /**
     * @param string $dateDebut_vote
     */
    public function setDateDebutVote(string $dateDebut_vote): void
    {
        $this->dateDebut_vote = $dateDebut_vote;
    }

    /**
     * @return string
     */
    public function getDateFinVote(): string
    {
        return $this->dateFin_vote;
    }

    /**
     * @param string $dateFin_vote
     */
    public function setDateFinVote(string $dateFin_vote): void
    {
        $this->dateFin_vote = $dateFin_vote;
    }

    /**
     * @return Utilisateur
     */
    public function getIdUtilisateur(): int
    {

        return $this->id_organisateur ;
    }

    /**
     * @param Utilisateur $id_organisateur
     */
    public function setIdUtilisateur(int $id_organisateur ): void
    {
        $this->id_organisateur  = $id_organisateur ;
    }



    public function formatTableau(): array{
        return array(
            "id_questionTag" => $this->getIdQuestion(),
            "intituleTag" => $this->getIntitule(),
            "explicationTag" => $this->getExplication(),
            "dateDebut_redactionTag" => $this->getDateDebutRedaction(),
            "dateFin_redactionTag" => $this->getDateFinRedaction(),
            "dateDebut_voteTag" => $this->getDateDebutVote(),
            "dateFin_voteTag" => $this->getDateFinVote(),
            "id_organisateur Tag" => $this->getIdUtilisateur(),
        );
    }


}