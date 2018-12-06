<?php
/**
 * Modo de Usar:
 * require_once './Database.class.php';
 * $db = Database::conexao();
 * $stmt = $pdo->prepare('SELECT * FROM usuarios');
 */
class Database {
    private static $instance;
    private $connection;
    
    private function __construct() {
        $db_host = "sql10.freemysqlhosting.net";
        $db_nome = "sql10267193";
        $db_usuario = "sql10267193";
        $db_senha = "5tRvScs4cH";
        $db_driver = "mysql";
        
        try
        { 
            $this->connection = new PDO("$db_driver:host=$db_host; dbname=$db_nome", $db_usuario, $db_senha);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->exec('SET NAMES utf8');
        }
        catch (PDOException $e)
        {
            # Então não carrega nada mais da página.
            die("Connection Error: " . $e->getMessage());
        }
        
    }
    
    public static function getConnection() {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance->connection;
    }
}

/*class Database{
    protected static $db;

    private function __construct()
    {
        
    }
    # Método estático - acessível sem instanciação.
    public static function conexao()
    {
        if (!self::$db)
        {
            new Database();
        }
        return self::$db;
    } 
} */
