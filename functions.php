<?php
session_start();

ini_set('display_errors', 1);
require_once 'functions/custom-posts.php';
require_once 'functions/ajax-queries.php';
// require_once 'lib/create-send/csrest_general.php';
// require_once 'lib/create-send/csrest_subscribers.php';


function six_menus() {
    register_nav_menus(
        array(
          'header-menu' => __( 'Header Menu' ),
          'language-menu' => __( 'Language Menu' )
        )
    );


}
function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

add_action( 'init', 'six_menus' );


function send_planner(){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $about = $_POST["about"];
    $budget = $_POST["budget"];
    $deadline = $_POST["deadline"];


    $mailTo = "info@vuzum.com";
    $subject = "Project Planner @ Vuzum's website";
    $EmailMessage = "
    Name: $name\r\n
    Email: $email\r\n
    About: $about\r\n
    Budget: $budget\r\n
    Deadline: $deadline\r\n";

    $headers = "MIME-Version: 1.0rn";
    $headers .= "Content-type: text/plain; charset=iso-8859-1rn";
    $headers .= "From: $email\r\n";

    mail($mailTo, $subject, $EmailMessage, "From: ".$email);

    die;
}
add_action( "wp_ajax_nopriv_send_planner", "send_planner" );
add_action( "wp_ajax_send_planner", "send_planner" );


function get_social_image() {
    global $post;
    if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
        $img="http://example.com/image.jpg"; //replace this with a default image on your server or an image in your media library
    }
    else{
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
        $img = esc_attr( $thumbnail_src[0] );
    }
    return $img;
}

add_theme_support( 'post-thumbnails' );

function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );
