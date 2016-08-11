<?php
if ( ! defined( 'WPINC' ) ) { die('Direct access prohibited!'); }
/**
 * Return array of the content snippet
 */
function iewp_get_content_snippet( $id )
{
	global $wpdb;

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
