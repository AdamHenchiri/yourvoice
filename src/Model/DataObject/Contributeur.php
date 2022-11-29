<?php

namespace App\YourVoice\Model\DataObject;

class Contributeur extends AbstractDataObject
{
    private int $id_utilisateur ;
    private string $id_question ;

    /**
     * @param int $id_utilisateur
     * @param string $id_question
     */
    public function __construct(int $id_utilisateur, string $id_question)
    {
        $this->id_utilisateur = $id_utilisateur;
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
            "id_questionTag" => $this->getIdQuestion(),
        );
    }

}