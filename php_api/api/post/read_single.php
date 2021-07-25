<?php

//Headers
header( 'Access-Control-Allow-Origin: *' );
header( 'Content-Type: application/json' );

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// DB Connection
$database = new Database();
$db = $database->connect();

// Initiate post object
$post = new Post( $db );

//Post ID
$post->id = isset( $_GET['id'] ) ? $_GET['id'] : die();

//Get Post
$post->read_single();

//Create an array
$post_arr = array(
    'id'            => $post->id,
    'title'         => $post->title,
    'body'          => $post->body,
    'author'        => $post->author,
    'category_id'   => $post->category_id,
    'category_name' => $post->category_name,
);

//Make json object
echo json_encode( $post_arr );