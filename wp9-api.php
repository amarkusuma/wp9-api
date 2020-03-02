<?php

/*
Plugin Name: Create Rest Api 
Description: Crete Rest Api Wordpress 
Author: Ammar
*/

require_once('wp9-testimonial.php');

function get_testimonial($request)
{
    $mypost = array(
        'post_type' => 'wt9-testimonial',
        'posts_per_page' => $request['per_page'],
    );
    $data = new WP_Query($mypost);
    return $data;
}

add_action('rest_api_init', function () {
    register_rest_route('wp9-api/v1', '/testimonial', array(
        'methods' => 'GET',
        'callback' => 'get_testimonial',
    ));
});

function get_testimonial_id($request)
{
    $mypost = array(
        'post_type' => 'wt9-testimonial',
        // 'posts_per_page' => $request['per_page'],
        'p' => $request['id'],
    );
    $data = new WP_Query($mypost);
    return $data;
}

add_action('rest_api_init', function () {
    register_rest_route('wp9-api/v1', '/testimonial/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'get_testimonial_id',
        'id' => array(
            'required' => true,
        ),

    ));
});


function post_testimonial($request)
{
    $data = $request->get_params();
    $mypost = array(
        'author' =>  $data['author'],
        'content' => $data['content'],
        'date' => $data['date'],
        'rate' =>  $data['rate'],
    );
    $data = new WP_Query($mypost);
    return $data;
}

add_action('rest_api_init', function () {
    register_rest_route('wp9-api/v1', '/testimonial', array(
        'methods' => 'POST',
        'callback' => 'post_testimonial',
        'author' => array(
            'required' => true,
            'type' => 'string',
        ),
        'content' => array(
            'required' => true,
            'type' => 'string',
        ),
        'date' => array(
            'required' => true,
            'type' => 'date',
        ),
        'rate' => array(
            'required' => true,
            'type' => 'string',
        ),
    ));
});
