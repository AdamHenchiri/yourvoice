<?php

namespace App\Covoiturage\Model\DataObject;
use App\Covoiturage\Model\DataObject\AbstractDataObject;

class Utilisateur extends AbstractDataObject
{

    private string $login;
    private string $nom;
    private string $prenom;

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    public function __construct(
        string $login,
        string $nom,
        string $prenom,
    ){
        $this->login = $login;
        $this-> nom = $nom;
        $this-> prenom = $prenom;
    }

    public function formatTableau(): array{
        return array(
            "loginTag" => $this->getLogin(),
            "nomTag" => $this->getNom(),
            "prenomTag" => $this->getPrenom(),
        );
    }


}