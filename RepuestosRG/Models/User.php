<?php
include_once ("autoload.php");

class User extends Connection{
    private $id_User;
    private $Last_Name;
    private $Email;
    private $Password;
    private $User_id_UserType;
    private $Phone;
    private $connection;

    public function userExists($user,$pwrd){
       $query = $this->connect()->prepare("SELECT * FROM user
       INNER JOIN usertype ON user.UserType_id = usertype.id_UserType
       WHERE user.Email = :user AND user.Password = :pwrd");

        $query ->execute(['user' => $user,'pwrd' => $pwrd]);
        
        if ($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }
     
    public function getNombre(){
        return $this->Email;
    }

    //Valida permisos de rol
    public function getRol($user, $pwrd) {
        $query = "SELECT * FROM user 
                  LEFT JOIN usertype ON user.UserType_id = usertype.id_UserType 
                  WHERE Email = :user AND Password = :pwrd";
    
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(':user', $user, PDO::PARAM_STR);
        $stmt->bindParam(':pwrd', $pwrd, PDO::PARAM_STR);
        $stmt->execute();
    
        $row = $stmt->fetch();
        return $row["UserType_id"];
    }

    public function getId($user, $pwrd) {
        $query = "SELECT * FROM user WHERE Email = :user AND Password = :pwrd";
    
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(':user', $user, PDO::PARAM_STR);
        $stmt->bindParam(':pwrd', $pwrd, PDO::PARAM_STR);
        $stmt->execute();
    
        $row = $stmt->fetch();
        return $row["id_User"];
    }
  
}
?>
