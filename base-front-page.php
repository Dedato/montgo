<?php get_template_part('templates/head'); ?>
<body <?php body_class(ICL_LANGUAGE_CODE); ?>>
  <!--[if lt IE 8]>
    <div class="alert alert-warning">
      <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
    </div>
  <![endif]-->

  <?php
  do_action('get_header');
  get_template_part('templates/header');
  ?>
  
  <?php 
  // Store original ID
  global $post;
  $curid = $post->ID;
  $i = 0;
  // Get Main Menu ID
  $menu_name  = 'primary_navigation';
  $locations  = get_nav_menu_locations();
  $menu       = wp_get_nav_menu_object($locations[$menu_name]);
  $menuitems  = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC')); ?>
  <div id="skrollr-body" role="document">
    <div class="wrap">
      <?php // Display all pages as one-page
      if (get_field('enable_one_page', 'option') && !is_404() && !is_search() && !is_archive() && !is_single() ) {
        // Loop through menu items to get page ID's
        foreach ($menuitems as $item):
          // Setup page
          $pageid   = get_post_meta($item->ID, '_menu_item_object_id', true);
          $post     = get_post($pageid);
          $pageslug = $post->post_name;
          setup_postdata($post);
          // Get page template
          $template_file = get_page_template_slug($pageid);
          $template_slug = pathinfo($template_file, PATHINFO_FILENAME);
          $template      = str_replace('template-', '', $template_slug);
          // Get ACF fields
          $bg_color     = get_field('page_bg_color');
          ?>
          <section id="<?php echo $pageslug; ?>" class="one-page" data-title="<?php echo get_the_title() . ' - ' . get_bloginfo('name'); ?>" data-menu-offset="-120" <?php if ($bg_color) { echo 'style="background-color:'.$bg_color.';"'; } ?>>
            <?php // Get template parts  
            if ($template) {
              get_template_part('template', $template);
            } else {
              get_template_part('page');
            } ?>
          </section>
          <?php wp_reset_postdata();
          wp_reset_query();
          $i++;
        endforeach;
      } else {
          include roots_template_path();
      } ?>
    </div><!-- end .wrap -->
    <?php get_template_part('templates/footer'); ?>
  </div><!-- end #skrollr-body -->
</body>
</html>
