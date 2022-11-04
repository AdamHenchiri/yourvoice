<?php

namespace App\YourVoice\Model\DataObject;
use App\YourVoice\Model\DataObject\AbstractDataObject;

class Utilisateur extends AbstractDataObject
{

    private string $login;
    private string $nom;
    private string $prenom;
    private int $age;
    private string $role;
    private string $email;
    private string $mdp;

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getMdp(): string
    {
        return $this->mdp;
    }

    /**
     * @param string $mdp
     */
    public function setMdp(string $mdp): void
    {
        $this->mdp = $mdp;
    }

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
        int $age,
        string $role,
        string $email,
        string $mdp,

    ){
        $this->login = $login;
        $this-> nom = $nom;
        $this-> prenom = $prenom;
        $this-> age = $age;
        $this-> role = $role;
        $this-> email = $email;
        $this-> mdp = $mdp;

    }

    public function formatTableau(): array{
        return array(
            "loginTag" => $this->getLogin(),
            "nomTag" => $this->getNom(),
            "prenomTag" => $this->getPrenom(),
            "ageTag" => $this->getAge(),
            "roleTag" => $this->getRole(),
            "emailTag" => $this->getEmail(),
            "mdpTag" => $this->getMdp(),
        );
    }


}