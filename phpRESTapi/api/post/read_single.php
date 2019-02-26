<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");


include("../../config/Database.php");
include("../../models/Post.php");

$init = new Database();
$pdo  =  $init->connect();

$post = new Post($pdo);
$post->read_single();

if (isset($_GET)) {
    $post_arr =  array('id' =>$post->id ,'title' =>$post->title,'category_name' =>$post->category_name,'category_id' =>$post->category_id,'body' =>$post->body,'author' =>$post->author,'created_at' =>$post->created_at );
 
    echo json_encode($post_arr) ;


} else {
    throw new Exception("Error Processing Request", 1);
    
}

?>