<?php

function getMapContent(){

    $postsList = array();


    $args = array(
        'post_type'  => array('clients'),
        'post_status'=>'publish',
        'orderby'   => 'menu_order', 
        'order' => ' ASC',
        'posts_per_page' => 9999
    );
    
    $loop = new WP_Query( $args );
    
    while ( $loop->have_posts() ) : $loop->the_post();
        $id = get_the_ID();
        $title = get_the_title();
        $post_type = get_post_type( $id );
        $url = get_permalink();
        $location = get_field('pin_location');
        $locationAddress = array();

        $locationAddress[] = array(
            'lat' => $location['lat'],
            'lng' => $location['lng']
        );

        $description = get_field('description');
        $displayed_location = get_field('location');
        $img = get_field('image');
        $postsList[] = array(
            'id_category'    => 1,
            'id_post'        => $id,
            'image'          => $img,
            'title_post'     => $title,
            'url'            => $url,
            'location'       => $locationAddress,
            'description'       => $description,
            'displayed_location' => $displayed_location
        );
        
    endwhile;

    die(json_encode($postsList));
}

add_action( 'wp_ajax_nopriv_getMapContent', 'getMapContent' );
add_action( 'wp_ajax_getMapContent', 'getMapContent' );


function getArticles(){

    $postsList = array();

    $args = array( 
        'post_type' => array('news'), 
        'posts_per_page' => 9999
    );

    $loop = new WP_Query( $args );

    while ( $loop->have_posts() ) : $loop->the_post();
        $news_id = get_the_ID();
        $img     = get_field('main_image', $news_id);
        $title   = get_the_title();
        $content = get_the_content();
        $date    = get_the_time('d/m/Y');

        $postsList[] = array(
            'id_post'        => $news_id,
            'image'          => $img,
            'title_post'     => $title,
            'content'        => $content,
            'date'           => $date
        );

    endwhile;

    die(json_encode($postsList));
}

add_action( 'wp_ajax_nopriv_getArticles', 'getArticles' );
add_action( 'wp_ajax_getArticles', 'getArticles' );


function sendFormData(){
    $api_key = 'd292b0ac71d7cce5eb4099ccc161f209';
    $auth = array('api_key' => $api_key);
    $wrap = new CS_REST_General($auth);
    $result = $wrap->get_clients();
    $client_id = $result->response[0]->ClientID;
    $list_id = '8828a2b100aaa905a5ef30258d2bcabd';
    $email = $_POST['email'];
    $subscribe = new CS_REST_Subscribers($list_id, $api_key);
    $resultSubscribe = $subscribe->add(array(
        'EmailAddress' => $email,
        'Resubscribe' => false
    ));

    return;
}

add_action( "wp_ajax_nopriv_sendFormData", "sendFormData" );
add_action( "wp_ajax_sendFormData", "sendFormData" );



// $output = array_slice($loop, $sequence, $posts_per_page);
   
// die(json_encode($output));
