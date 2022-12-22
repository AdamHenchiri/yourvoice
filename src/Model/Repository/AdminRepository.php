<?php

namespace App\YourVoice\Model\Repository;
use App\YourVoice\Model\DataObject\Admin ;

class AdminRepository extends AbstractRepository
{
    public function construire(array $userFormatTableau) : Admin {
        return new Admin($userFormatTableau['login'],$userFormatTableau['password'],$userFormatTableau['email'],$userFormatTableau["emailAValider"],$userFormatTableau["nonce"]);

    }

    protected function getNomTable(): string{
        return "admin";
    }

    protected function getNomClePrimaire(): string
    {
        return "login";
    }
    protected function getNomsColonnes(): array
    {
     return ["login","password","email","emailAValider","nonce"];
    }
}