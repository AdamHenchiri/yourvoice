<?php

namespace App\YourVoice\Model\DataObject;

use App\YourVoice\Lib\VerificationEmail;
use App\YourVoice\Model\DataObject\AbstractDataObject;
use App\YourVoice\Lib\MotDePasse;


class Admin extends AbstractDataObject
{
    private string $login;
    private string $password;
    private string $email;
    private string $emailAValider;
    private string $nonce;

    /**
     * @param string $login
     * @param string $password
     * @param string $email
     * @param string $emailAValider
     * @param string $nonce
     */
    public function __construct(string $login, string $password, string $email, string $emailAValider, string $nonce)
    {
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->emailAValider = $emailAValider;
        $this->nonce = $nonce;
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
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $passwordClair): void
    {
        $this->password = MotDePasse::hacher($passwordClair);
    }

    public static function construireDepuisFormulaire (array $tableauFormulaire) : Admin{
        $mdpClair=$tableauFormulaire["password"];
        $mdpHashe=MotDePasse::hacher($mdpClair);
        $admin= new Admin($tableauFormulaire["login"],$mdpHashe,"", $tableauFormulaire["email"],MotDePasse::genererChaineAleatoire());
        VerificationEmail::envoiEmailValidation($admin);
        return $admin;
    }
    public function formatTableau(): array{
        return array(
            "loginTag" => $this->getLogin(),
            "passwordTag"=> $this->getPassword(),
            "emailTag" => $this->getEmail(),
            "emailAValiderTag"=>$this->getEmailAValider(),
            "nonceTag"=>$this->getNonce()
        );
    }


}