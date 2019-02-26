<?php 
class Database{
  private $host = 'localhost';
  private $password ='sranje' ;
  private $username = 'root' ;
  private $dbname = 'myblog';
  private $pdo;

  public function connect(){
   $this->pdo = null ;

   try {
     $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password );
     $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
   } catch (PDOException $e) {
       echo 'connection error'.$e->getMessage();
   }

   
  return $this->pdo ; 
  }



}


?>