<?php
if ( ! defined( 'WPINC' ) ) { die('Direct access prohibited!'); }
/**
 * Add custom metabox for entering the link
 */
function iewp_content_snippets_add_metabox_shortcodes()
{
    # Only show if content snippets are available
    $count_posts = wp_count_posts( 'content_snippet' );
    if( isset( $count_posts->publish ) && $count_posts->publish > 0 ):

        add_meta_box(
    		'iewp_content_snippets_metabox_shortcodes',
    		'Content Snippet Shortcodes',
    		'iewp_content_snippets_metabox_shortcode_callback',
    		array('page','post'),
    		'normal',
    		'default'
    		);

    endif;
}
add_action( 'add_meta_boxes', 'iewp_content_snippets_add_metabox_shortcodes' );

/**
 * The metabox callback
 */
function iewp_content_snippets_metabox_shortcode_callback( $post )
{
    ?>

	<div>
		<div class="meta-row">
            <strong>By snippet ID (<em>preferred</em>):</strong><br>
            <code>[content_snippet title="1"]</code>
            <br><br>
            <strong>By snippet title:</strong><br>
            <code>[content_snippet title="Foo"]</code>
		</div>
	</div>

	<?php
}
