<?php

namespace App\YourVoice\Model\DataObject;
use App\YourVoice\Model\DataObject\Reponse;
use App\YourVoice\Model\DataObject\Section;
use App\YourVoice\Model\DataObject;

class CoAuteur extends AbstractDataObject
{
    private int $id_reponse;
    private int $id_coauteur ;

    /**
     * @param int $id_reponse
     * @param int $id_coauteur
     */
    public function __construct(int $id_reponse, int $id_coauteur )
    {
        $this->id_reponse = $id_reponse;
        $this->id_coauteur  = $id_coauteur ;
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
        return $this->id_coauteur ;
    }

    /**
     * @param int $id_coauteur
     */
    public function setIdUtilisateur(int $id_coauteur ): void
    {
        $this->id_coauteur  = $id_coauteur ;
    }


    public function formatTableau(): array{
        return array(
            "id_reponseTag" => $this->getIdReponse(),
            "id_coauteurTag" => $this->getIdUtilisateur(),

        );
    }


}