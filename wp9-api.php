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
        'paged' => $request['page'],
    );
    $data = new WP_Query($mypost);

    return $data->posts;
}

function post_testimonial(WP_REST_Request $request)
{

    $mypost = array(
        'post_author'  =>  $request['post_author'],
        'post_content' => $request['post_content'],
        'date' => $request['date'],
        'rate' =>  $request['rate'],
        'post_type' => 'wt9-testimonial',
    );

    $pdata =   wp_insert_post($mypost, true);
    return get_post($pdata);
}

add_action('rest_api_init', function () {
    register_rest_route(
        'wp9-api/v1',
        '/testimonial',
        array(
            array(
                'methods' => 'GET',
                'callback' => 'get_testimonial',
            ),
            array(

                'callback' => 'post_testimonial',
                'methods'   => WP_REST_Server::CREATABLE,

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
            ),
        )
    );
});

function get_testimonial_id($request)
{
    $mypost = array(
        'post_type' => 'wt9-testimonial',
        // 'posts_per_page' => $request['per_page'],
        'p' => $request['id'],
    );

    $data = new WP_Query($mypost);
    return $data->posts;
}


function delete_testimonial(WP_REST_Request $request)
{

    $id = $request['id'];
    $data = wp_delete_post($id, true);
    return $data;
}


function update_testimonial(WP_REST_Request $request)
{

    $my_post = array(
        'ID'           => $request['id'],
        'post_content'   => $request['post_content'],
        'post_author'   => $request['post_author'],
    );

    $data = wp_update_post($my_post, true);
    return get_post($data);
}


add_action('rest_api_init', function () {
    register_rest_route(
        'wp9-api/v1',
        '/testimonial/(?P<id>\d+)',
        array(
            array(
                'methods' => 'GET',
                'callback' => 'get_testimonial_id',
                'id' => array(
                    'required' => true,
                ),
            ),
            array(
                'methods' => WP_REST_Server::DELETABLE,
                'callback' => 'delete_testimonial',

            ),
            array(
                'methods' => 'PATCH ',
                'callback' => 'update_testimonial',

            )

        )
    );
});
