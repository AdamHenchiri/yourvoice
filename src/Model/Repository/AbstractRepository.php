<?php

namespace App\Covoiturage\Model\Repository;

use App\Covoiturage\Model\DataObject\AbstractDataObject;
use App\Covoiturage\Model\DataObject\Voiture;

abstract class AbstractRepository
{

    public function sauvegarder(AbstractDataObject $v)
    {
        $reponse = true;
        $sql = "INSERT INTO ".$this->getNomTable()." (";
        foreach ($this->getNomsColonnes() as $nomChamps){
            $sql.=$nomChamps.", ";
        }
        $sql=substr($sql,0,-2);
        $sql.=") VALUES (";
        foreach ($this->getNomsColonnes() as $nomChamps){
            $sql.=":".$nomChamps."Tag, ";
        }
        $sql=substr($sql,0,-2);
        $sql.=")";
        try {
            $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        } catch (PDOException $exception) {
            // throw new MyDatabaseException($exception->getMessage(), $exception->getCode());
            $reponse = false;
        }
        $values=$v->formatTableau();
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);
        return $reponse;
    }

    public function update(AbstractDataObject $v)
    {
        $sql = "UPDATE ".$this->getNomTable()." SET ";
        foreach ($this->getNomsColonnes() as $nomChamps){
            $sql.=$nomChamps." = :".$nomChamps."Tag, ";
        }
        $sql=substr($sql,0,-2);
        $sql.=" WHERE ". $this->getNomClePrimaire() . "= :".$this->getNomClePrimaire()."Tag";
        try {
            $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        } catch (PDOException $Exception) {
            throw new MyDatabaseException($Exception->getMessage(), $Exception->getCode());
        }
        $values=$v->formatTableau();
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);
    }

    public function supprimer(string $valeurClePrimaire): bool
    {
        $rep = true;
        $sql = "DELETE FROM ".$this->getNomTable()." WHERE ".$this->getNomClePrimaire()." = :primaireTag";
        try {
            $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        } catch (PDOException $exception) {
            throw new MyDatabaseException($exception->getMessage(), $exception->getCode());
            $rep = false;
        }
        $values = array(
            "primaireTag" => $valeurClePrimaire,
        );
        $rep = $pdoStatement->execute($values);
        return $rep;
    }

    public function select(string $valeurClePrimaire):?AbstractDataObject
    {
        $sql = "SELECT * FROM ".$this->getNomTable()." WHERE ".$this->getNomClePrimaire()." = :primaireTag";
        // Préparation de la requête
        try {
            $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        } catch (PDOException $exception) {
            //throw new MyDatabaseException($exception->getMessage(), $exception->getCode());
            $reponse = false;
        }
        $values = array(
            "primaireTag"=> $valeurClePrimaire,
            //nomdutag => valeur, ...
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        // On récupère les résultats comme précédemment
        // Note: fetch() renvoie false si pas de Voiture correspondante
        $acteur = $pdoStatement->fetch();
        if ($acteur) {
            return $this->construire($acteur);
        } else {
            return null;
        }
    }

    public function selectAll(): array
    {
        $pdo = DatabaseConnection::getPdo();
        $pdoStatement = $pdo->query("select * from ".$this->getNomTable());
        foreach ($pdoStatement as $tableFormatTableau) {
            $tab[] = $this->construire($tableFormatTableau);
        }
        return $tab;
    }

    protected abstract function getNomTable(): string;

    protected abstract function construire(array $objetFormatTableau);

    protected abstract function getNomClePrimaire(): string;

    protected abstract function getNomsColonnes() : array;
}