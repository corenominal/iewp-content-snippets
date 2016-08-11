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
    # Generate a list of all snippets for quick selection
    global $wpdb;
    $sql = "SELECT `id`, `post_title`
            FROM $wpdb->posts
            WHERE `post_type` = 'content_snippet' AND `post_status` = 'publish'
            ORDER BY `post_title` ASC";
    $snippets = $wpdb->get_results( $sql, ARRAY_A );
    ?>

	<div>
		<div class="meta-row">
            <div id="iewp-content-snippets-select" class="iewp-content-snippets-select">
                Select snippet:<br>
                <select>
                <?php
                    foreach ( $snippets as $snippet )
                    {
                        echo '<option data-title="' . $snippet['post_title'] . '" value="' . $snippet['id'] . '">' . $snippet['post_title'] . '</option>';
                    }
                ?>
                </select>
            </div>
            <div id="iewp-content-snippets-examples" class="iewp-content-snippets-examples">
                <strong>By snippet ID (<em>preferred</em>):</strong><br>
                [content_snippet title="<span id="iewp-content-snippets-example-one">1</span>"]
                <br><br>
                <strong>By snippet title:</strong><br>
                [content_snippet title="<span id="iewp-content-snippets-example-two">Foo</span>"]
            </div>
		</div>
	</div>

	<?php
}

/**
 * Enqueue additional JavaScript and CSS
 */
function iewp_content_snippets_enqueue_scripts( $hook )
{
    if( 'post.php' != $hook )
	{
		return;
	}
	wp_register_style( 'iewp_content_shippets_metabox_css', plugin_dir_url( __FILE__ ) . 'css/iewp_content_shippets_metabox.css', array(), '0.0.1', 'all' );
	wp_enqueue_style( 'iewp_content_shippets_metabox_css' );
	wp_register_script( 'iewp_content_shippets_metabox_js', plugin_dir_url( __FILE__ ) . 'js/iewp_content_shippets_metabox.js', array('jquery'), '0.0.1', true );
	wp_enqueue_script( 'iewp_content_shippets_metabox_js' );
	wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'iewp_content_snippets_enqueue_scripts' );
