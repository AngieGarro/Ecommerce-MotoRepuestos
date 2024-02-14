<?php
class Connection{
    private $host;
    private $user;
    private $password;
    private $db;
    private $charset;
      
    
    //CONSTRUCTOR
    public function __construct() {
        $this->host = "localhost";
        $this->user = "root";
        $this->password = "";
        $this->db = "sistemarg";
        $this->charset = "utf8";
    }
    public function connect() {
        try{
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;

            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_EMULATE_PREPARES => false];

            $pdo = new PDO($connection, $this->user, $this->password, $options);

            return $pdo;

        }catch(PDOException $e){
            print_r("Error connection: " . $e->getMessage());
        }
    }

}

?>





