<?php
/* ==========================================================================
   Team
   ========================================================================== */

/* Post Type */   
function team_init() {
	register_post_type('team', array(
		'hierarchical'        => false,
		'public'              => true,
		'show_in_nav_menus'   => true,
		'show_ui'             => true,
		'menu_position'		    => 5,
		'supports'            => array('title', 'editor', 'page-attributes'),
		'has_archive'         => 'team',
		'query_var'           => true,
		'rewrite'             => array('slug' => 'team'),
		'labels'              => array(
			'name'                => __( 'Team' ),
			'singular_name'       => __( 'Teamlid' ),
			'add_new'             => __( 'Voeg teamlid toe' ),
			'all_items'           => __( 'Team' ),
			'add_new_item'        => __( 'Voeg teamlid toe' ),
			'edit_item'           => __( 'Bewerk teamlid' ),
			'new_item'            => __( 'Nieuw teamlid' ),
			'view_item'           => __( 'Bekijk teamlid' ),
			'search_items'        => __( 'Zoek teamleden' ),
			'not_found'           => __( 'Geen teamleden gevonden' ),
			'not_found_in_trash'  => __( 'Geen teamleden gevonden in prullenbak' ),
			'parent_item_colon'   => __( 'Hoofd teamlid' ),
			'menu_name'           => __( 'Team' ),
		),
	));
}
/* Messages */
function team_updated_messages( $messages ) {
	global $post;
	$permalink = get_permalink( $post );
	$messages['team'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Teamlid bijgewerkt. <a target="_blank" href="%s">Bekijk teamlid</a>'), esc_url( $permalink ) ),
		2 => __('Aangepast veld bijgewerkt.'),
		3 => __('Aangepast veld verwijderd.'),
		4 => __('Teamlid bijgewerkt.'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Teamlid hersteld tot revisie van %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Teamlid gepubliceerd. <a href="%s">Bekijk teamlid</a>'), esc_url( $permalink ) ),
		7 => __('Teamlid bewaard.'),
		8 => sprintf( __('Teamlid ingediend. <a target="_blank" href="%s">Voorvertoning teamlid</a>'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Teamlid gepland voor: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Voorvertoning teamlid</a>'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Teamlid concept bijgewerkt. <a target="_blank" href="%s">Voorvertoning teamlid</a>'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);
	return $messages;
}
add_action( 'init', 'team_init' );
add_filter( 'post_updated_messages', 'team_updated_messages' );