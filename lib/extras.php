<?php
/**
 * Clean up the_excerpt()
 */
function roots_excerpt_more($more) {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
}
add_filter('excerpt_more', 'roots_excerpt_more');

/**
 * Manage output of wp_title()
 */
function roots_wp_title($title) {
  if (is_feed()) {
    return $title;
  }

  $title .= get_bloginfo('name');

  return $title;
}
add_filter('wp_title', 'roots_wp_title', 10);


/* ==========================================================================
   ACF Pro Options page
   ========================================================================== */ 
 
if(function_exists('acf_add_options_page')) {
	acf_add_options_page();
	acf_add_options_sub_page('One Page');
}
add_filter('acf/settings/default_language', 'my_acf_settings_default_language');
function my_acf_settings_default_language($language) {
  return 'nl'; 
}
add_filter('acf/settings/current_language', 'my_acf_settings_current_language');
function my_acf_settings_current_language($language) {
  return 'nl';
}


/* ==========================================================================
   Add body classes to call JS
   ========================================================================== */
   
function my_body_class($classes) {
  // One Page
  if (get_field('enable_one_page', 'option') && is_front_page() ) {
    $classes[] = 'one-page';
  }
  return $classes;
}
add_filter('body_class','my_body_class');



/* ==========================================================================
   Custom wp-login & wp-admin screen
   ========================================================================== */
   
/* Custom style Wordpress login page */
function wp_custom_login() { 
	echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory').'/assets/css/wp-admin.css" />'; 
}
// Change url logo Wordpress login page
function put_my_url(){
	return (get_home_url());
}
// Custom style Wordpress dashboard
function wp_custom_admin() { 
	echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory').'/assets/css/wp-admin.css" />'; 
}
add_action('login_head', 'wp_custom_login');
add_filter('login_headerurl', 'put_my_url');
add_action('admin_head', 'wp_custom_admin');   



/* ==========================================================================
   Role capabilities editor
   ========================================================================== */
   
// get the the role object
$role_object = get_role('editor');
// add $cap capability to this role object
$role_object->add_cap('edit_theme_options');



/* ==========================================================================
   WPML Language Switcher
   ========================================================================== */
   
function languages_list_switch(){
  $languages = icl_get_languages('skip_missing=0&orderby=custom&order=desc');
  $total = count($languages);
  if(!empty($languages)){
    $i = 0;
    echo '<div class="language-list"><ul>';
    foreach($languages as $l){
      $i++;
      if(!$l['active']) {
      	echo '<li><a href="'.$l['url'].'">'. icl_disp_language($l['language_code']) . '</a>';
      	if($i < $total){
      	  echo '<span class="divider">/</span></li>';
      	} else {
        	echo '</li>';
      	}
      } else {
        echo '<li class="active"><a href="'.$l['url'].'">'. icl_disp_language($l['language_code']) . '</a>';
        if($i < $total){
      	  echo '<span class="divider">/</span></li>';
      	} else {
        	echo '</li>';
      	}
      }
    }
    echo '</ul></div>';
  }
}

function languages_list_navbar_switch(){
  $languages = icl_get_languages('skip_missing=0&orderby=custom&order=desc');
  $total = count($languages);
  if(!empty($languages)){
    $i = 0;
    echo '<ul id="lang-menu" class="nav navbar-nav"><li class="menu-languages">';
    foreach($languages as $l){
      $i++;
      if(!$l['active']) {
      	echo '<a class="menu-'.$l['language_code'].'" href="'.$l['url'].'">'. icl_disp_language($l['language_code']) . '</a>';
      	if($i < $total){
      	  echo '<span class="divider">/</span>';
      	}
      } else {
        echo '<a class="menu-'.$l['language_code'].' active" href="'.$l['url'].'">'. icl_disp_language($l['language_code']) . '</a>';
        if($i < $total){
      	  echo '<span class="divider">/</span>';
      	}
      }
    }
    echo '</li></ul>';
  }
}



/* ==========================================================================
   Show Header Image
   ========================================================================== */
   
function show_header_image() {
  // ACF variables
  $header_img   = get_field('page_header_img');
  if ($header_img) :
    // Sizes
    $img_alt    = $header_img['alt'];
    $img_cap    = $header_img['caption'];
    $img_sm_src = $header_img['sizes']['page-header-sm'];
    $img_md_src = $header_img['sizes']['page-header-md'];
    $img_lg_src = $header_img['sizes']['page-header-lg'];
    // Retina Images
		if (function_exists('wr2x_get_retina_from_url')) {
			$img_sm_2x_src 	= wr2x_get_retina_from_url($img_sm_src);
			$img_md_2x_src 	= wr2x_get_retina_from_url($img_md_src);
			$img_lg_2x_src 	= wr2x_get_retina_from_url($img_lg_src);
		} ?>
    <div class="header-image">
      <picture>
    		<!--[if IE 9]><video style="display: none;"><![endif]-->
    		<source srcset="<?php if ($img_lg_2x_src) { echo $img_lg_2x_src . ' 2x, '; } echo $img_lg_src .' 1x'; ?>" media="(min-width:1024px)">
        <source srcset="<?php if ($img_md_2x_src) { echo $img_md_2x_src . ' 2x, '; } echo $img_md_src .' 1x'; ?>" media="(min-width:768px)">
        <source srcset="<?php if ($img_sm_2x_src) { echo $img_sm_2x_src . ' 2x, '; } echo $img_sm_src .' 1x'; ?>">
    		<!--[if IE 9]></video><![endif]-->
    		<img srcset="<?php if ($img_lg_2x_src) { echo $img_lg_2x_src . ' 2x, '; } echo $img_lg_src .' 1x'; ?>" alt="<?php echo $img_alt; ?>" />
    	</picture>
    	<div class="header-caption container">
    	  <figcaption><?php echo $img_cap; ?></figcaption>
    	</div>
    </div>
  <?php endif;
}