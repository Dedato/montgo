<?php
/*
Template Name: Case Studies
*/
?>

<?php show_header_image(); ?>

<div class="container">
  <div class="content row">
    <main class="main" role="main">
      <h1><?php the_title(); ?></h1> 
      <?php the_content(); ?>  
      <?php // Get case studies
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $wp_query = new WP_Query( array(	
      	'post_type' 	=> 'case_study',
      	'order_by'    => 'menu_order',
      	'nopaging' 		=> true
      ));
      get_template_part('templates/loop', 'case-study'); 
      wp_reset_query(); ?>
    </main><!-- /.main -->
  </div>
</div>