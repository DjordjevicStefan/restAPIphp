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

///// get row posted data , ne iz inpta nego iz onog postman programa
$data = json_decode(file_get_contents("php://input"));

///// uzimamo i id i stavljamo u istancu Post klase koju smo gore napravili:
$post->id = $data->id;

$post->category_id = $data->category_id;
$post->title = $data->title;
$post->body = $data->body;
$post->author= $data->author;


///// updejt posta
if ($post->update()) {
   echo json_encode(array("mess" => "zeljeni post je updejtovan"));
} else {
    echo json_encode(array("mess" => "updejt nije bio uspesan"));
}

?>