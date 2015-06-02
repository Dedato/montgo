<?php
/* ==========================================================================
   Case Study
   ========================================================================== */

/* Post Type */   
function case_study_init() {
	register_post_type('case_study', array(
		'hierarchical'        => false,
		'public'              => true,
		'show_in_nav_menus'   => true,
		'show_ui'             => true,
		'menu_position'		    => 5,
		'supports'            => array('title', 'editor', 'excerpt'),
		'has_archive'         => 'case-study',
		'query_var'           => true,
		'rewrite'             => array('slug' => 'case-study'),
		'labels'              => array(
			'name'                => __( 'Case Studies' ),
			'singular_name'       => __( 'Case Study' ),
			'add_new'             => __( 'Voeg case study toe' ),
			'all_items'           => __( 'Case Studies' ),
			'add_new_item'        => __( 'Voeg case study toe' ),
			'edit_item'           => __( 'Bewerk case study' ),
			'new_item'            => __( 'Nieuw case study' ),
			'view_item'           => __( 'Bekijk case study' ),
			'search_items'        => __( 'Zoek case studies' ),
			'not_found'           => __( 'Geen case studies gevonden' ),
			'not_found_in_trash'  => __( 'Geen case studies gevonden in prullenbak' ),
			'parent_item_colon'   => __( 'Hoofd case study' ),
			'menu_name'           => __( 'Case Studies' ),
		),
	));
}
/* Messages */
function case_study_updated_messages( $messages ) {
	global $post;
	$permalink = get_permalink( $post );
	$messages['case_study'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Case study bijgewerkt. <a target="_blank" href="%s">Bekijk case study</a>'), esc_url( $permalink ) ),
		2 => __('Aangepast veld bijgewerkt.'),
		3 => __('Aangepast veld verwijderd.'),
		4 => __('Case study bijgewerkt.'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Case study hersteld tot revisie van %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Case study gepubliceerd. <a href="%s">Bekijk case study</a>'), esc_url( $permalink ) ),
		7 => __('Case study bewaard.'),
		8 => sprintf( __('Case study ingediend. <a target="_blank" href="%s">Voorvertoning case study</a>'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Case study gepland voor: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Voorvertoning case study</a>'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Case study concept bijgewerkt. <a target="_blank" href="%s">Voorvertoning case study</a>'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);
	return $messages;
}
add_action( 'init', 'case_study_init' );
add_filter( 'post_updated_messages', 'case_study_updated_messages' );