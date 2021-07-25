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

// Blog post query
$result = $post->read();
// Get row count
$num = $result->rowCount();

//Check if there is any post
if ( $num > 0 ) {
//post array
    $posts_arr = array();
    $posts_arr['data'] = array();

    while ( $row = $result->fetch( PDO::FETCH_ASSOC ) ) {
        extract( $row );
        $post_item = array(
            'id'            => $id,
            'title'         => $title,
            'body'          => html_entity_decode( $body ),
            'author'        => $author,
            'category_id'   => $category_id,
            'Category_name' => $category_name,
        );

        //push to 'data'
        array_push( $posts_arr['data'], $post_item );
    }

    echo json_encode( $posts_arr );

} else {
    // No post is there
    echo json_encode(
        array( 'message' => 'No posts found!' )
    );
}