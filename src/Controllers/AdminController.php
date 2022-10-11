<?php
namespace src\Controllers;
use src\Utilities\Database;
use PDO;
class AdminController{
    public static function attemptLogin($email,$password){
        $pdo = Database::connect();
        $stmt = $pdo->query('SELECT * FROM admins');
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($results as $row){
            if($row->email === $email){
                if(password_verify($password,$row->password)){
                    $_SESSION['loggedinadmin']=$row->email;
                    return true;
                }
                return false;
            }
        }
        return false;
    }
}