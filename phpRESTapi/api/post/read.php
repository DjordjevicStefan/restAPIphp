<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");


include("../../config/Database.php");
include("../../models/Post.php");

$init = new Database();
$pdo  =  $init->connect();

$post = new Post($pdo);
$stmt =  $post->read();


$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$posts_arr = array();
$posts_arr["data"] = array();

foreach ($result as $key) {
    array_push($posts_arr["data"], $key);
}

echo json_encode($posts_arr);
// echo var_dump($posts_arr);

?>