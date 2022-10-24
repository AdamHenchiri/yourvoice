<?php
namespace App\Covoiturage\Model\Repository ;
use App\Covoiturage\Config\Conf as Conf;
use PDO;

class DatabaseConnection
{
    private static ?DatabaseConnection $instance = null;

    private PDO $pdo;

    public static function getPdo() : PDO {
        return static::getInstance()->pdo;
    }

    private function __construct () {
        // Code du constructeur
        $hostname=Conf::getHostname();
        $database_name=Conf::getDatabase();
        $login=Conf  ::getLogin();
        $password=Conf::getPassword();
        // Connexion à la base de données
        // Le dernier argument sert à ce que toutes les chaines de caractères
        // en entrée et sortie de MySql soit dans le codage UTF-8
        $this->pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        // On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    // getInstance s'assure que le constructeur ne sera
    // appelé qu'une seule fois.
    // L'unique instance crée est stockée dans l'attribut $instance
    private static function getInstance() : DatabaseConnection {
        // L'attribut statique $pdo s'obtient avec la syntaxe static::$pdo
        // au lieu de $this->pdo pour un attribut non statique
        if (is_null(static::$instance))
            // Appel du constructeur
            static::$instance = new DatabaseConnection();
        return static::$instance;
    }

}
