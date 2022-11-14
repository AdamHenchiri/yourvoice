<?php

namespace App\YourVoice\Model\Repository;

use App\YourVoice\Model\DataObject\AbstractDataObject;
use App\YourVoice\Model\DataObject\Voiture;
use PDO;

abstract class AbstractRepository
{

    public function __construct()
    {
    }

    public function sauvegarder(AbstractDataObject $v):?int
    {
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
        //var_dump($pdoStatement);
        return DatabaseConnection::getPdo()->lastInsertId() ;
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

    public function supprimer(string|array $valeurClePrimaire): bool
    {
        $rep = true;
        if (is_array($valeurClePrimaire)){
            $sql = "DELETE FROM " . $this->getNomTable() . " WHERE " . $this->getNomClesPrimaires()[0] . " = :premierTag"." AND ". $this->getNomClesPrimaires()[1] . " = :secondTag";
            $values = array(
                "premierTag" => $valeurClePrimaire[0],
                "secondTag"=> $valeurClePrimaire [1],
            );
        }else {
            $sql = "DELETE FROM " . $this->getNomTable() . " WHERE " . $this->getNomClePrimaire() . " = :primaireTag";
            $values = array(
                "primaireTag" => $valeurClePrimaire,
            );
        }
        try {
            $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        } catch (PDOException $exception) {
            throw new MyDatabaseException($exception->getMessage(), $exception->getCode());
            $rep = false;
        }

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

    public function selectWhere(string $nomCle,string $valeurCle):?array
    {
        $sql = "SELECT * FROM ".$this->getNomTable()." WHERE ".$nomCle ."= :valeurCleTag";
        // Préparation de la requête
        try {
            $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        } catch (PDOException $exception) {
            //throw new MyDatabaseException($exception->getMessage(), $exception->getCode());
            $reponse = false;
        }
        $values = array(
            "valeurCleTag"=> $valeurCle,
            //nomdutag => valeur, ...
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);
        // On récupère les résultats comme précédemment
        // Note: fetch() renvoie false si pas de Voiture correspondante
        $tab =array();
        foreach ($pdoStatement as $acteur) {
            $tab[] = $this->construire($acteur);
        }
        return $tab;
    }

    public function selectAll(): ?array
    {
        $pdo = DatabaseConnection::getPdo();
        $pdoStatement = $pdo->query("select * from ".$this->getNomTable());
        foreach ($pdoStatement as $tableFormatTableau) {
            $tab[] = $this->construire($tableFormatTableau);
        }
        //var_dump($tab);
        return $tab;
    }

    public function selection(string $valeurClePrimaire, string $nomTable): ?array
    {
        $sql = "SELECT * FROM ". $nomTable ." WHERE ".$this->getNomClePrimaire()." = :primaireTag";
        // Préparation de la requête
        try {
            $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        } catch (PDOException $exception) {
            //throw new MyDatabaseException($exception->getMessage(), $exception->getCode());
            $reponse = false;
        }
        $values = array(
            "primaireTag"=> $valeurClePrimaire,
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


    protected abstract function getNomTable(): string;



    protected abstract function construire(array $objetFormatTableau);

    protected abstract function getNomClePrimaire(): string;

    protected abstract function getNomsColonnes() : array;
}