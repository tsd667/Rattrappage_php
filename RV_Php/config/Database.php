<?php 
class Database{
    private \PDO|null $pdo=null; 

    public  function __construct()
    {
        try {
           $host = 'localhost:8889';
           $dbname = 'gestionRv_hopital';
           $username = 'root';
           $password = 'root';
           $charset = 'utf8mb4';
           $dsn="mysql:host=$host;dbname=$dbname;charset=$charset";
            if ($this->pdo ==null) {
                 $this->pdo = new PDO($dsn, $username, $password, [
                 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
               ]);
            }
           
        }
         catch (\PDOException $ex) {
            echo("Erreur ".$ex->getMessage());
            exit;
       }  
        
    }

   
    public function getPdo(): ?\PDO
    {
        return $this->pdo;
    }
}