<?php

namespace App\Covoiturage\Model\DataObject;
use App\Covoiturage\Model\DataObject\AbstractDataObject;

class Question extends AbstractDataObject
{

    private string $idQ;
    private string $intitule;
    private string $textQuestion;
    private Utilisateur $utilisateurResponsable;
    private string $dateDebutVote;
    private string $dateFinVote;
    private string $dateDebutRedac;
    private string $datefinRedac;
    private Section $section;
    private array $reponses;

    /**
     * @param string $idQ
     * @param string $intitule
     * @param string $textquestion
     * @param Utilisateur $utilisateurResponsable
     * @param string $dateDebutVote
     * @param string $dateFinVote
     * @param string $dateDebutRedac
     * @param string $datefinRedac
     * @param Section $section
     * @param array $reponses
     */
    public function     __construct(string $idQ, string $intitule, string $textQuestion, Utilisateur $utilisateurResponsable, string $dateDebutVote, string $dateFinVote, string $dateDebutRedac, string $datefinRedac, Section $section, array $reponses)
    {
        $this->idQ = $idQ;
        $this->intitule = $intitule;
        $this->textquestion = $textQuestion;
        $this->utilisateurResponsable = $utilisateurResponsable;
        $this->dateDebutVote = $dateDebutVote;
        $this->dateFinVote = $dateFinVote;
        $this->dateDebutRedac = $dateDebutRedac;
        $this->datefinRedac = $datefinRedac;
        $this->section = $section;
        $this->reponses = $reponses;
    }


    /**
     * @return string
     */
    public function getTextquestion(): string
    {
        return $this->textquestion;
    }

    /**
     * @param string $textQuestion
     */
    public function setTextquestion(string $textQuestion): void
    {
        $this->textquestion = $textQuestion;
    }

    /**
     * @return Utilisateur
     */
    public function getUtilisateurResponsable(): Utilisateur
    {
        return $this->utilisateurResponsable;
    }

    /**
     * @param Utilisateur $utilisateurResponsable
     */
    public function setUtilisateurResponsable(Utilisateur $utilisateurResponsable): void
    {
        $this->utilisateurResponsable = $utilisateurResponsable;
    }

    /**
     * @return array
     */
    public function getReponses(): array
    {
        return $this->reponses;
    }

    /**
     * @param array $reponses
     */
    public function setReponses(array $reponses): void
    {
        $this->reponses = $reponses;
    }

    /**
     * @return string
     */
    public function getIdQ(): string
    {
        return $this->idQ;
    }

    /**
     * @param string $idQ
     */
    public function setIdQ(string $idQ): void
    {
        $this->idQ = $idQ;
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
    public function getDateDebutVote(): string
    {
        return $this->dateDebutVote;
    }

    /**
     * @param string $dateDebutVote
     */
    public function setDateDebutVote(string $dateDebutVote): void
    {
        $this->dateDebutVote = $dateDebutVote;
    }

    /**
     * @return string
     */
    public function getDateFinVote(): string
    {
        return $this->dateFinVote;
    }

    /**
     * @param string $dateFinVote
     */
    public function setDateFinVote(string $dateFinVote): void
    {
        $this->dateFinVote = $dateFinVote;
    }

    /**
     * @return string
     */
    public function getDateDebutRedac(): string
    {
        return $this->dateDebutRedac;
    }

    /**
     * @param string $dateDebutRedac
     */
    public function setDateDebutRedac(string $dateDebutRedac): void
    {
        $this->dateDebutRedac = $dateDebutRedac;
    }

    /**
     * @return string
     */
    public function getDatefinRedac(): string
    {
        return $this->datefinRedac;
    }

    /**
     * @param string $datefinRedac
     */
    public function setDatefinRedac(string $datefinRedac): void
    {
        $this->datefinRedac = $datefinRedac;
    }

    /**
     * @return Section
     */
    public function getSection(): Section
    {
        return $this->section;
    }

    /**
     * @param Section $section
     */
    public function setSection(Section $section): void
    {
        $this->section = $section;
    }



    public function formatTableau(): array{
        return array(
            "loginTag" => $this->getLogin(),
            "nomTag" => $this->getNom(),
            "prenomTag" => $this->getPrenom(),
        );
    }


}