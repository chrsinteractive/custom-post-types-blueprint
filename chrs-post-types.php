<?php
// **************************************************
// ** FAQ Custom Post Type Registration and Setup **
// **************************************************

// Define constants for reusable values / Replace with your custom post type name and slug
define('CHRS_FAQ_TEXT_DOMAIN', 'faq');
define('CHRS_FAQ_POST_TYPE', 'faq');
define('CHRS_FAQ_LABEL_SINGLE', 'FAQ');
define('CHRS_FAQ_LABEL_PLURAL', 'FAQs');
define('CHRS_FAQ_SINGLE_SLUG', 'faq');
define('CHRS_FAQ_ARCHIVE_SLUG', 'faqs');

// Hook into the 'init' action to register the custom post type
add_action('init', 'chrs_cpt_faq');

// Register a function to handle custom post type update messages
add_filter('post_updated_messages', 'chrs_cpt_faq_messages');

// Filter the default "Enter title here" text for FAQ posts
add_filter('enter_title_here', 'chrs_cpt_faq_title');

// Add a custom icon for the FAQ post type in the admin menu
add_action('admin_head', 'chrs_cpt_faq_icon');


// Function to register the FAQ custom post type
function chrs_cpt_faq() {

    // Define labels for the post type using string concatenation for localization
    $labels = array(
        'name' => __(CHRS_FAQ_LABEL_PLURAL, CHRS_FAQ_TEXT_DOMAIN),
        'singular_name' => __(CHRS_FAQ_LABEL_SINGLE, CHRS_FAQ_TEXT_DOMAIN),
        'add_new' => __('Add New ' . CHRS_FAQ_LABEL_SINGLE, CHRS_FAQ_TEXT_DOMAIN),
        'add_new_item' => __('Add New ' . CHRS_FAQ_LABEL_SINGLE, CHRS_FAQ_TEXT_DOMAIN),
        'edit_item' => __('Edit ' . CHRS_FAQ_LABEL_SINGLE, CHRS_FAQ_TEXT_DOMAIN),
        'new_item' => __('New ' . CHRS_FAQ_LABEL_SINGLE, CHRS_FAQ_TEXT_DOMAIN),
        'view_item' => __('View ' . CHRS_FAQ_LABEL_SINGLE, CHRS_FAQ_TEXT_DOMAIN),
        'search_items' => __('Search ' . CHRS_FAQ_LABEL_PLURAL, CHRS_FAQ_TEXT_DOMAIN),
        'not_found' =>  __('No  ' . CHRS_FAQ_LABEL_SINGLE . ' found', CHRS_FAQ_TEXT_DOMAIN),
        'not_found_in_trash' => __('No  ' . CHRS_FAQ_LABEL_SINGLE . ' found in Trash', CHRS_FAQ_TEXT_DOMAIN),
        'menu_name' => CHRS_FAQ_LABEL_PLURAL
    );

    // Define arguments for the post type
    $faqargs = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => CHRS_FAQ_SINGLE_SLUG, 'with_front' => true),
        'has_archive' => CHRS_FAQ_ARCHIVE_SLUG,
        'hierarchical' => false,
        'menu_position' => 20,
        'supports' => array('title','thumbnail','editor')
    );

    // Register the custom post type
    register_post_type( CHRS_FAQ_POST_TYPE, $faqargs);
}

// Function to customize post updated messages for the FAQ post type
function chrs_cpt_faq_messages( $messages ) {
    global $post, $post_ID;

    $messages[CHRS_FAQ_POST_TYPE] = array(
        0 => '',
        1 => sprintf( __( CHRS_FAQ_LABEL_SINGLE . ' updated. <a href="%s">View ' . CHRS_FAQ_LABEL_SINGLE . '</a>', CHRS_FAQ_TEXT_DOMAIN), esc_url( get_permalink($post_ID) ) ),
        2 => __('Custom field updated', CHRS_FAQ_TEXT_DOMAIN),
        3 => __('Custom field deleted', CHRS_FAQ_TEXT_DOMAIN),
        4 => __( CHRS_FAQ_LABEL_SINGLE . ' updated', CHRS_FAQ_TEXT_DOMAIN),
        5 => isset($_GET['revision']) ? sprintf( __( CHRS_FAQ_LABEL_SINGLE . ' restored to revision from %s', CHRS_FAQ_TEXT_DOMAIN), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __( CHRS_FAQ_LABEL_SINGLE . ' published. <a href="%s">View ' . CHRS_FAQ_LABEL_SINGLE . '</a>', CHRS_FAQ_TEXT_DOMAIN), esc_url( get_permalink($post_ID) ) ),
        7 => __( CHRS_FAQ_LABEL_SINGLE . ' saved', CHRS_FAQ_TEXT_DOMAIN),
        8 => sprintf( __( CHRS_FAQ_LABEL_SINGLE . ' submitted. <a target="_blank" href="%s">Preview ' . CHRS_FAQ_LABEL_SINGLE . '</a>', CHRS_FAQ_TEXT_DOMAIN), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __( CHRS_FAQ_LABEL_SINGLE . ' scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview ' . CHRS_FAQ_LABEL_SINGLE . '</a>', CHRS_FAQ_TEXT_DOMAIN),
            date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __( CHRS_FAQ_LABEL_SINGLE . ' draft updated. <a target="_blank" href="%s">Preview ' . CHRS_FAQ_LABEL_SINGLE . '</a>', CHRS_FAQ_TEXT_DOMAIN), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );
    return $messages;
}

// Function to customize the "Enter title here" text for FAQ posts
function chrs_cpt_faq_title( $title ){
    $screen = get_current_screen();

    if (CHRS_FAQ_POST_TYPE === $screen->post_type) {
        $title = __(CHRS_FAQ_LABEL_SINGLE . ' Title', CHRS_FAQ_TEXT_DOMAIN);
    }
    return $title;
}

// Function to add a custom icon for the FAQ post type in the admin menu
// You can fine more icons here: https://developer.wordpress.org/resource/dashicons/
function chrs_cpt_faq_icon() {
    echo '
	<style>
		#adminmenu #menu-posts-faq div.wp-menu-image:before,
		.page-count.faq-count a:before { content: "\f223" !important; }
	</style>
	';
}
