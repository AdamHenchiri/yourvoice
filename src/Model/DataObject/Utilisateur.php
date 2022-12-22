<?php

namespace App\YourVoice\Model\DataObject;

use App\YourVoice\Lib\VerificationEmail;
use App\YourVoice\Model\DataObject\AbstractDataObject;
use App\YourVoice\Lib\MotDePasse;


class Utilisateur extends AbstractDataObject
{
    private ?int $id_utilisateur;
    private string $login;
    private string $nom;
    private string $prenom;
    private int $age;
    private string $email;
    private string $mdpHache;
    private string $emailAValider;
    private string $nonce;
    private bool $estOrganisateur;
    private bool $demandeOrga;

    /**
     * @param int|null $id_utilisateur
     * @param string $login
     * @param string $nom
     * @param string $prenom
     * @param int $age
     * @param string $email
     * @param string $mdpHache
     * @param string $emailAValider
     * @param string $nonce
     * @param bool $estOrganisateur
     * @param bool $demandeOrga
     */
    public function __construct(?int $id_utilisateur, string $login, string $nom, string $prenom, int $age, string $email, string $mdpHache, string $emailAValider, string $nonce, bool $estOrganisateur, bool $demandeOrga)
    {
        $this->id_utilisateur = $id_utilisateur;
        $this->login = $login;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
        $this->email = $email;
        $this->mdpHache = $mdpHache;
        $this->emailAValider = $emailAValider;
        $this->nonce = $nonce;
        $this->estOrganisateur = $estOrganisateur;
        $this->demandeOrga = $demandeOrga;
    }


    /**
     * @return string
     */
    public function getEmailAValider(): string
    {
        return $this->emailAValider;
    }

    /**
     * @param string $emailAValider
     */
    public function setEmailAValider(string $emailAValider): void
    {
        $this->emailAValider = $emailAValider;
    }

    /**
     * @return string
     */
    public function getNonce(): string
    {
        return $this->nonce;
    }

    /**
     * @param string $nonce
     */
    public function setNonce(string $nonce): void
    {
        $this->nonce = $nonce;
    }

    /**
     * @return string
     */
    public function getMdpHache(): string
    {
        return $this->mdpHache;
    }

    /**
     * @param string $mdpHache
     */
    public function setMdpHache(string $mdpClair): void
    {
        $this->mdpHache = MotDePasse::hacher($mdpClair);
    }

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

    /**
     * @return bool
     */
    public function isEstOrganisateur(): bool
    {
        return $this->estOrganisateur;
    }

    /**
     * @param bool $estOrganisateur
     */
    public function setEstOrganisateur(bool $estOrganisateur): void
    {
        $this->estOrganisateur = $estOrganisateur;
    }

    /**
     * @return bool
     */
    public function isDemandeOrga(): bool
    {
        return $this->demandeOrga;
    }

    /**
     * @param bool $demandeOrga
     */
    public function setDemandeOrga(bool $demandeOrga): void
    {
        $this->demandeOrga = $demandeOrga;
    }


    public static function construireDepuisFormulaire (array $tableauFormulaire) : Utilisateur{
        $mdpClair=$tableauFormulaire["mdp"];
        $mdpHashe=MotDePasse::hacher($mdpClair);
        $utilisateur= new Utilisateur(null,$tableauFormulaire["login"],$tableauFormulaire["nom"],$tableauFormulaire["prenom"],$tableauFormulaire["age"],"", $mdpHashe, $tableauFormulaire["email"],MotDePasse::genererChaineAleatoire(),0,0);
        VerificationEmail::envoiEmailValidation($utilisateur);
        return $utilisateur;
    }
    public function formatTableau(): array{
        if($this->isEstOrganisateur()){
            $res = 1;
        }else{
            $res=0;
        }

        if($this->isDemandeOrga()){
            $res2 = 1;
        }else{
            $res2=0;
        }

        return array(
            "id_utilisateurTag"=>$this->getIdUtilisateur(),
            "loginTag" => $this->getLogin(),
            "nomTag" => $this->getNom(),
            "prenomTag" => $this->getPrenom(),
            "ageTag" => $this->getAge(),
            "emailTag" => $this->getEmail(),
            "mdpHacheTag"=> $this->getMdpHache(),
            "emailAValiderTag"=>$this->getEmailAValider(),
            "nonceTag"=>$this->getNonce(),
            "estOrganisateurTag" => $res,
            "demandeOrgaTag"=>$res2
        );
    }


}