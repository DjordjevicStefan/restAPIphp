<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods");



include("../../config/Database.php");
include("../../models/Post.php");

$init = new Database();
$pdo  =  $init->connect();

$post = new Post($pdo);

///// iz get req uzimamo id koji posle koristimo da izbrisemo zeljeni post, to jest post sa tim id
$post->id = $_GET["deleteId"];

///// a moze i na ovaj nacin ,preko postmena se onda salje delete req i u bodiju req mora da stoji id.plus u hederu allow mthod mora biti DELETE !!!!!!!!!!!!

// $data = json_decode(file_get_contents("php://input"));
// $post->id = $data->id;




///// obrisati post
if ($post->delete()) {
   echo json_encode(array("mess" => "zeljeni post je obrisan"));
} else {
    echo json_encode(array("mess" => "nije proslo brisanje posta"));
}

?>