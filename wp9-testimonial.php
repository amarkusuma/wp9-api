<?php

add_action('init', 'testimonial');

function testimonial()
{
    register_post_type(
        'wt9-testimonial',
        array(
            'labels' => array(
                'name' => 'wt9-testimonial',
                'singular_name' => 'Testimonial',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Testimonial',
                'edit' => 'Edit',
                'edit_item' => 'Edit Testimonial',
                'new_item' => 'New Testimonial',
                'view' => 'View',
                'view_item' => 'View Testimonial',
                'search_items' => 'Search Testimonials',
                'not_found' => 'No Testimonials found',
                'not_found_in_trash' => 'No Testimonials found in Trash',
                'parent' => 'Parent Testimonial'
            ),

            'public' => true,
            'menu_position' => 15,
            'supports' => array('title', 'editor', 'comments', 'thumbnail', 'custom-fields'),
            'taxonomies' => array(''),
            // 'menu_icon' => plugins_url('images/image.png', __FILE__),
            'has_archive' => true
        )
    );
}
