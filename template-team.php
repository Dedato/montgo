<?php
/*
Template Name: The Team
*/
?>

<?php show_header_image(); ?>

<div class="container">
  <div class="content template row">
    <main class="main" role="main">
      <h1><?php the_title(); ?></h1> 
      <?php the_content(); ?>
    </main><!-- /.main -->
  </div>
</div>  
      
<?php
// Get team members
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$wp_query = new WP_Query( array(	
	'post_type' 	=> 'team',
	'order_by'    => 'menu_order',
	'order'       => 'ASC',
	'nopaging' 		=> true
));
get_template_part('templates/loop', 'team'); 
wp_reset_query(); ?>