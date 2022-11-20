<?php

namespace App\YourVoice\Model\DataObject;
use App\YourVoice\Model\DataObject\AbstractDataObject;

class Utilisateur extends AbstractDataObject
{
    private ?int $id_utilisateur;
    private string $login;
    private string $nom;
    private string $prenom;
    private int $age;
    private string $email;
    private string $mdp;

    /**
     * @return int
     */
    public function getIdUtilisateur(): ?int
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
        ?int $id_utilisateur,
        string $login,
        string $nom,
        string $prenom,
        int $age,
        string $email,
        string $mdp,

    ){
        $this->id_utilisateur = $id_utilisateur;
        $this->login = $login;
        $this-> nom = $nom;
        $this-> prenom = $prenom;
        $this-> age = $age;
        $this-> email = $email;
        $this-> mdp = $mdp;

    }

    public function formatTableau(): array{
        return array(
            "id_utilisateurTag"=>$this->getIdUtilisateur(),
            "loginTag" => $this->getLogin(),
            "nomTag" => $this->getNom(),
            "prenomTag" => $this->getPrenom(),
            "ageTag" => $this->getAge(),
            "emailTag" => $this->getEmail(),
            "mdpTag" => $this->getMdp(),
        );
    }


}