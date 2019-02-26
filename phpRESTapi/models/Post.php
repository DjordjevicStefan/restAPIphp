<?php
class Post{
  private $pdo ;
  private $table = "posts";

  public $id ;
  public $category_name ;
  public $category_id ;
  public $title ;
  public $body ;
  public $author;
  public $created_at ;


  public function __construct($db){
   $this->pdo = $db;

  }

  public function read(){
    $query = "SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at FROM $this->table p LEFT JOIN categories c ON p.category_id=c.id ORDER BY p.created_at DESC";
    
   

    $stmt = $this->pdo->prepare($query);
    $stmt->execute();
    // $result = $stmt->fetchAll();
    // echo var_dump($result);

    return $stmt ;
  }
 

 public function read_single(){
  if (isset($_GET["id"])) {
    $query = "SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at FROM $this->table p LEFT JOIN categories c ON p.category_id=c.id WHERE p.id=?";
    
     $id = $_GET["id"];


    $stmt = $this->pdo->prepare($query);
    ///////moze ovako ali moze i sa bindParam !!!!!!!!!!!!!!!!!!
    
    $stmt->execute([$id]);

    // $stmt->bindParam(1, $id);
    // $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //////stavljanje vrednosti u varijable klase  
      $this->id = $result["id"]; 
      $this->title = $result["title"];
      $this->body = $result["body"];
      $this->category_name = $result["category_name"];
      $this->created_at = $result["created_at"];
      $this->category_id = $result["category_id"];
      $this->author = $result["author"];
   }  else {

    echo "trazeni post ne postoji" ;
  }

  }

  public function create(){
   $query = "INSERT INTO $this->table SET category_id=?,title=?,body=?,author=?" ;

   $stmt = $this->pdo->prepare($query);

   $stmt->bindParam(1, $this->category_id);
   $stmt->bindParam(2, $this->title);
   $stmt->bindParam(3, $this->body);
   $stmt->bindParam(4, $this->author);

    $stmt->execute();

    if ($stmt->execute()) {
      return true ;
    } else {
      printf("Error", $stmt->error);
      return false ;
    }
  }

  public function update(){
    $query = "UPDATE $this->table SET category_id=?,title=?,body=?,author=? WHERE id=? " ;
 
    $stmt = $this->pdo->prepare($query);
 
    $stmt->bindParam(1, $this->category_id);
    $stmt->bindParam(2, $this->title);
    $stmt->bindParam(3, $this->body);
    $stmt->bindParam(4, $this->author);
    $stmt->bindParam(5, $this->id);
 
     $stmt->execute();
 
     if ($stmt->execute()) {
       return true ;
     } else {
       printf("Error", $stmt->error);
       return false ;
     }
   }

   public function delete(){
    $query = "DELETE FROM $this->table  WHERE id=? " ;
 
    $stmt = $this->pdo->prepare($query);
 
    $stmt->bindParam(1, $this->id);
 
     $stmt->execute();
 
     if ($stmt->execute()) {
       return true ;
     } else {
       printf("Error", $stmt->error);
       return false ;
     }
   }

}

?>