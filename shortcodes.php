<?php
/**
 * Shortcodes for posts and pages
 * Usage: [content_snippet title="Foo"]
 */
function iewp_content_snippet_shortcode( $atts, $content = null )
{
    global $wpdb;
    $atts = shortcode_atts(
 				array(
 						'title' => -1
 				), $atts
 			);

    $id = $atts['title'];

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

    $data = '';

	if ( $query->have_posts() )
	{
		while ( $query->have_posts() )
		{
			$query->the_post();
			$data = get_the_content();
		}
	}

	wp_reset_postdata();

    return $data;

}
add_shortcode( 'content_snippet', 'iewp_content_snippet_shortcode' );
