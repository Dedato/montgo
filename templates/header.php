<header class="banner navbar-fixed-top" role="banner">
  <div class="top container">
    <div class="row">
      <div class="col-sm-8">
        <?php if (is_front_page() && get_field('enable_one_page', 'option')) { ?>
          <a class="navbar-brand h1" href="#top"><?php bloginfo('name'); ?></a>
        <?php } else { ?>
          <a class="navbar-brand h1" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
        <?php } ?>
      </div>
      <div class="col-sm-4">
        <?php languages_list_switch(); ?>
      </div>  
    </div>
  </div>
  <div class="navbar navbar-default">
    <div class="container"> 
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <?php if (is_front_page() && get_field('enable_one_page', 'option')) { ?>
          <a class="navbar-brand h1" href="#top"><?php bloginfo('name'); ?></a>
        <?php } else { ?>
          <a class="navbar-brand h1" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
        <?php } ?>  
      </div>
      <nav class="collapse navbar-collapse" role="navigation">
          <?php 
          // Hashtag Navigation
          if (get_field('enable_one_page', 'option')) {
            if (has_nav_menu('primary_navigation')) :
              wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav', 'walker' => new Roots_Nav_One_Page_Walker() ));
              languages_list_navbar_switch();
            endif;
          // Normal Navigation  
          } else {
            if (has_nav_menu('primary_navigation')) :
              wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
              languages_list_navbar_switch();
            endif;
          } ?>
      </nav>
    </div>
  </div>  
</header>