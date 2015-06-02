<?php if (have_posts()) { ?>
  <div class="case-studies">
		<?php while (have_posts()) : the_post(); ?>
		  <article <?php post_class(); ?>><?php the_content(); ?></article>      
		<?php endwhile; ?>
  </div>	
<?php } else { ?>
  <p><?php _e('No case studies found','montgo'); ?></p>
<?php } ?>