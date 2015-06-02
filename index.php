<div class="container">
  <div class="content row">
    <main class="main <?php echo roots_main_class(); ?>" role="main">
      <?php get_template_part('templates/page', 'header'); ?>
      
      <?php if (!have_posts()) : ?>
        <div class="alert alert-warning">
          <?php _e('Sorry, no results were found.', 'roots'); ?>
        </div>
        <?php get_search_form(); ?>
      <?php endif; ?>
      
      <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('templates/content', get_post_format()); ?>
      <?php endwhile; ?>
      
      <?php if ($wp_query->max_num_pages > 1) : ?>
        <nav class="post-nav">
          <ul class="pager">
            <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
            <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
          </ul>
        </nav>
      <?php endif; ?>
    </main><!-- /.main -->
    <?php if (roots_display_sidebar()) : ?>
      <aside class="sidebar <?php echo roots_sidebar_class(); ?>" role="complementary">
        <?php include roots_sidebar_path(); ?>
      </aside><!-- /.sidebar -->
    <?php endif; ?>
  </div>
</div>  