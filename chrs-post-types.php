<?php
/**
 * Location Custom Post Type
 *
 * This script defines and registers a custom post type "Location" for WordPress.
 * It includes settings for labels, arguments, messages, and a custom icon.
 */

// Define constants for the custom post type. Replace these with your custom values.
define('CHRS_LOCATION_TEXT_DOMAIN', 'chrs_cpt_domain_location');
define('CHRS_LOCATION_POST_TYPE', 'location');
define('CHRS_LOCATION_LABEL_SINGLE', 'Location');
define('CHRS_LOCATION_LABEL_PLURAL', 'Locations');
define('CHRS_LOCATION_SINGLE_SLUG', 'location');
define('CHRS_LOCATION_ARCHIVE_SLUG', 'locations');

// Register the custom post type on WordPress initialization.
add_action('init', 'chrs_cpt_location');

// Customize the update messages for the custom post type.
add_filter('post_updated_messages', 'chrs_cpt_location_messages');

// Customize the title placeholder text in the admin editor.
add_filter('enter_title_here', 'chrs_cpt_location_title');

// Add a custom icon for the post type in the admin menu.
add_action('admin_head', 'chrs_cpt_location_icon');


/**
 * Registers the custom post type "Location".
 */
function chrs_cpt_location() {
    // Define labels for the custom post type.
    $labels = array(
        'name' => __(CHRS_LOCATION_LABEL_PLURAL, CHRS_LOCATION_TEXT_DOMAIN),
        'singular_name' => __(CHRS_LOCATION_LABEL_SINGLE, CHRS_LOCATION_TEXT_DOMAIN),
        'add_new' => sprintf(__('Add New %s', CHRS_LOCATION_TEXT_DOMAIN), CHRS_LOCATION_LABEL_SINGLE),
        'add_new_item' => sprintf(__('Add New %s', CHRS_LOCATION_TEXT_DOMAIN), CHRS_LOCATION_LABEL_SINGLE),
        'edit_item' => sprintf(__('Edit %s', CHRS_LOCATION_TEXT_DOMAIN), CHRS_LOCATION_LABEL_SINGLE),
        'new_item' => sprintf(__('New %s', CHRS_LOCATION_TEXT_DOMAIN), CHRS_LOCATION_LABEL_SINGLE),
        'view_item' => sprintf(__('View %s', CHRS_LOCATION_TEXT_DOMAIN), CHRS_LOCATION_LABEL_SINGLE),
        'search_items' => sprintf(__('Search %s', CHRS_LOCATION_TEXT_DOMAIN), CHRS_LOCATION_LABEL_PLURAL),
        'not_found' => sprintf(__('No %s found', CHRS_LOCATION_TEXT_DOMAIN), CHRS_LOCATION_LABEL_PLURAL),
        'not_found_in_trash' => sprintf(__('No %s found in Trash', CHRS_LOCATION_TEXT_DOMAIN), CHRS_LOCATION_LABEL_PLURAL),
        'menu_name' => __(CHRS_LOCATION_LABEL_PLURAL, CHRS_LOCATION_TEXT_DOMAIN)
    );

    // Define arguments for the custom post type.
    $locationargs = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => CHRS_LOCATION_SINGLE_SLUG),
        'has_archive' => CHRS_LOCATION_ARCHIVE_SLUG,
        'hierarchical' => false,
        'menu_position' => 20,
        'supports' => array('title','thumbnail','editor')
    );

    // Register the post type with WordPress.
    register_post_type( CHRS_LOCATION_POST_TYPE, $locationargs);
}

/**
 * Customizes the update messages for the "Location" custom post type.
 *
 * @param array messages Existing post update messages.
 * @return array Modified update messages.
 */
function chrs_cpt_location_messages( $messages ) {
    global $post, $post_ID;

    $messages[CHRS_LOCATION_POST_TYPE] = array(
        0 => '',
        1 => sprintf( __(CHRS_LOCATION_LABEL_SINGLE . ' updated. <a href="%s">View ' . CHRS_LOCATION_LABEL_SINGLE . '</a>', CHRS_LOCATION_TEXT_DOMAIN), esc_url( get_permalink($post_ID) ) ),
        2 => __('Custom field updated.', CHRS_LOCATION_TEXT_DOMAIN),
        3 => __('Custom field deleted.', CHRS_LOCATION_TEXT_DOMAIN),
        4 => sprintf( __(CHRS_LOCATION_LABEL_SINGLE . ' updated.', CHRS_LOCATION_TEXT_DOMAIN)),
        5 => isset($_GET['revision']) ? sprintf( __(CHRS_LOCATION_LABEL_SINGLE . ' restored to revision from %s', CHRS_LOCATION_TEXT_DOMAIN), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __(CHRS_LOCATION_LABEL_SINGLE . ' published. <a href="%s">View ' . CHRS_LOCATION_LABEL_SINGLE . '</a>', CHRS_LOCATION_TEXT_DOMAIN), esc_url( get_permalink($post_ID) ) ),
        7 => sprintf( __(CHRS_LOCATION_LABEL_SINGLE . ' saved.', CHRS_LOCATION_TEXT_DOMAIN)),
        8 => sprintf( __(CHRS_LOCATION_LABEL_SINGLE . ' submitted. <a target="_blank" href="%s">Preview ' . CHRS_LOCATION_LABEL_SINGLE . '</a>', CHRS_LOCATION_TEXT_DOMAIN), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __(CHRS_LOCATION_LABEL_SINGLE . ' scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview ' . CHRS_LOCATION_LABEL_SINGLE . '</a>', CHRS_LOCATION_TEXT_DOMAIN),
            date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __(CHRS_LOCATION_LABEL_SINGLE . ' draft updated. <a target="_blank" href="%s">Preview ' . CHRS_LOCATION_LABEL_SINGLE . '</a>', CHRS_LOCATION_TEXT_DOMAIN), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );

    return $messages;
}

/**
 * Customizes the "Enter title here" placeholder text for the "Location" custom post type.
 *
 * @param string title The original placeholder text.
 * @return string Modified placeholder text.
 */
function chrs_cpt_location_title( $title ){
    $screen = get_current_screen();

    if  ( CHRS_LOCATION_POST_TYPE === $screen->post_type ) {
        $title = CHRS_LOCATION_LABEL_SINGLE .' Name';
    }

    return $title;
}

/**
 * Adds a custom icon for the "Location" custom post type in the admin menu.
 * You can find more icons here: https://developer.wordpress.org/resource/dashicons/
 */
function chrs_cpt_location_icon() {
    echo '
	<style>
		#adminmenu #menu-posts-location div.wp-menu-image:before,
		.page-count.location-count a:before { content: "\f223" !important; }
	</style>
	';
}
