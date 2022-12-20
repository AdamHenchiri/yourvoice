<?php

namespace App\YourVoice\Model\DataObject;
use App\YourVoice\Model\DataObject\Question;
use App\YourVoice\Model\Repository\DatabaseConnection;

class Reponse extends AbstractDataObject
{

    private ?int $id_reponse;
    private int $id_responsable;
    private int $id_question;
    private bool $actif;


    public function __construct(?int $id_reponse, string $id_responsable, int $id_question, bool $actif)
    {
        $this->id_reponse = $id_reponse;
        $this->id_responsable = $id_responsable;
        $this->id_question = $id_question;
        $this->actif= $actif;
    }


    /**
     * @return string
     */

    public function getIdRponses(): ?int
    {
        return $this->id_reponse;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id_reponse = $id;
    }

    /**
     * @return string
     */
    public function getIdUtilisateur(): int
    {
        return $this->id_responsable;
    }

    /**
     * @param string $id_responsable
     */
    public function setIdUtilisateur(string $id_responsable): void
    {
        $this->id_responsable = $id_responsable;
    }

    /**
     * @return Question
     */
    public function getIdQuestion(): int
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

    /**
     * @return bool
     */
    public function isActif(): bool
    {
        return $this->actif;
    }

    /**
     * @param bool $actif
     */
    public function setActif(bool $actif): void
    {
        $this->actif = $actif;
    }



    public function formatTableau(): array
    {
        if($this->isActif()){
            $res = 1;
        }
        if(!$this->isActif()){
            $res = 0;
        }
        return array(
            "id_reponseTag" => $this->getIdRponses(),
            "id_responsableTag" => $this->getIdUtilisateur(),
            "id_questionTag" => $this->getIdQuestion(),
            "actifTag" => $res
        );
    }

}