<?php
/**************************************/
/*                FAQ                 */
/**************************************/
add_action( 'init', 'chrs_cpt_faq' );
add_filter( 'post_updated_messages', 'chrs_cpt_faq_messages' );
add_filter( 'enter_title_here', 'chrs_cpt_faq_title' );
add_action( 'admin_head', 'chrs_cpt_faq_icon' );

function chrs_cpt_faq() {

    $labels = array(
        'name' => __('FAQs', 'post type general name'),
        'singular_name' => __('FAQ', 'post type singular name'),
        'add_new' => __('Add New', 'faq'),
        'add_new_item' => __('Add New FAQ'),
        'edit_item' => __('Edit FAQ'),
        'new_item' => __('New FAQ'),
        'view_item' => __('View FAQ'),
        'search_items' => __('Search FAQs'),
        'not_found' =>  __('No faqs found'),
        'not_found_in_trash' => __('No faqs found in Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'FAQs'
    );

    $faqargs = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'faq', 'with_front' => 'false'),
        'has_archive' => 'faqs',
        'hierarchical' => false,
        'menu_position' => 20,
        'supports' => array('title','thumbnail','editor')
    );

    register_post_type( 'faq', $faqargs);
}

function chrs_cpt_faq_messages( $messages ) {
    global $post, $post_ID;

    $messages['faq'] = array(
        0 => '',
        1 => sprintf( __('FAQ updated. <a href="%s">View faq</a>', 'your_text_domain'), esc_url( get_permalink($post_ID) ) ),
        2 => __('Custom field updated.', 'your_text_domain'),
        3 => __('Custom field deleted.', 'your_text_domain'),
        4 => __('FAQ updated.', 'your_text_domain'),
        5 => isset($_GET['revision']) ? sprintf( __('FAQ restored to revision from %s', 'your_text_domain'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __('FAQ published. <a href="%s">View faq</a>', 'your_text_domain'), esc_url( get_permalink($post_ID) ) ),
        7 => __('FAQ saved.', 'your_text_domain'),
        8 => sprintf( __('FAQ submitted. <a target="_blank" href="%s">Preview faq</a>', 'your_text_domain'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __('FAQ scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview faq</a>', 'your_text_domain'),
            date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('FAQ draft updated. <a target="_blank" href="%s">Preview faq</a>', 'your_text_domain'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );

    return $messages;
}

function chrs_cpt_faq_title( $title ){
    $screen = get_current_screen();

    if  ( 'faq' == $screen->post_type ) {
        $title = 'FAQ Question';
    }

    return $title;
}

// https://developer.wordpress.org/resource/dashicons/
function chrs_cpt_faq_icon() {
    echo '
	<style>
		#adminmenu #menu-posts-faq div.wp-menu-image:before,
		.page-count.faq-count a:before { content: "\f223" !important; }
	</style>
	';
}
