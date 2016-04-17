<?php
/**
 * Plugin Name: IEWP Content Snippets
 * Plugin URI: https://github.com/corenominal/iewp-content-snippets
 * Description: A WordPress plugin for creating and displaying content snippets. Uses a custom post type to create content snippets which can be embedded into template files.
 * Author: Philip Newborough
 * Version: 0.0.1
 * Author URI: https://corenominal.org
 */

/**
 * Custom post type for content snippets
 */
function iewp_register_post_type_content_snippet()
{
	
	$singular = 'Content Snippet';
	$plural = 'Content Snippets';
	$slug = str_replace( ' ', '_', strtolower( $singular ) );

	$labels = array(
		'name' 					=> $plural,
		'singular_name' 		=> $singular,
		'add_new' 				=> 'Add New',
		'add_new_item'  		=> 'Add New ' . $singular,
		'edit'		        	=> 'Edit',
		'edit_item'	        	=> 'Edit ' . $singular,
		'new_item'	        	=> 'New ' . $singular,
		'view' 					=> 'View ' . $singular,
		'view_item' 			=> 'View ' . $singular,
		'search_term'   		=> 'Search ' . $plural,
		'parent' 				=> 'Parent ' . $singular,
		'not_found' 			=> 'No ' . $plural .' found',
		'not_found_in_trash' 	=> 'No ' . $plural .' in Trash'
		);

	$args = array(
			'labels'              => $labels,
	        'public'              => true,
	        'publicly_queryable'  => false,
	        'exclude_from_search' => true,
	        'show_in_nav_menus'   => true,
	        'show_ui'             => true,
	        'show_in_menu'        => true,
	        'show_in_admin_bar'   => true,
	        'menu_position'       => 20,
	        'menu_icon'           => 'dashicons-media-text',
	        'can_export'          => true,
	        'delete_with_user'    => false,
	        'hierarchical'        => false,
	        'has_archive'         => false,
	        'query_var'           => true,
	        'capability_type'     => 'page',
	        'map_meta_cap'        => true,
	        'rewrite'             => false,
	        'supports'            => array( 
	        	'title', 
	        	'editor', 
	        	'author'
	        )
	);
	register_post_type( $slug, $args );
}
add_action( 'init', 'iewp_register_post_type_content_snippet' );


/**
 * Return array of the content snippet
 */
function iewp_get_content_snippet( $id )
{
	$data['title'] = 'No snippet title';
	$data['content'] = '<p>No snippet body.</p>';

	if( ! is_numeric( $id ) )
	{
		$id = $wpdb->get_col("SELECT ID from $wpdb->posts WHERE post_title = '$id' AND post_type = 'content_snippet' ");
		if( empty( $id ) )
		{
			$id = -1;
		}
		else
		{
			$id = $id[0];
		}
	}

	$args = array (
		'p'                      => $id,
		'post_type'              => array( 'content_snippet' ),
		'post_status'            => array( 'published' ),
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() )
	{
		while ( $query->have_posts() )
		{
			$query->the_post();
			$data['title'] = get_the_title();
			$data['content'] = get_the_content();
		}
	}

	return $data;

	wp_reset_postdata();
}

/**
 * Echo the content snippet
 */
function iewp_content_snippet( $id )
{

	global $wpdb;
	
	$data['content'] = '<p>No snippet body.</p>';

	if( ! is_numeric( $id ) )
	{
		$id = $wpdb->get_col("SELECT ID from $wpdb->posts WHERE post_title = '$id' AND post_type = 'content_snippet' ");
		if( empty( $id ) )
		{
			$id = -1;
		}
		else
		{
			$id = $id[0];
		}
	}

	$args = array (
		'p'                      => $id,
		'post_type'              => array( 'content_snippet' ),
		'post_status'            => array( 'published' ),
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() )
	{
		while ( $query->have_posts() )
		{
			$query->the_post();
			the_content();
		}
	}

	wp_reset_postdata();
}
