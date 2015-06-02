<div class="container">
  <div class="content row">
    <main class="main" role="main">
      <h1><?php echo roots_title(); ?></h1>
      <div class="alert alert-warning">
        <?php _e('Sorry, but the page you were trying to view does not exist.', 'roots'); ?>
      </div>
      <p><?php _e('It looks like this was the result of either:', 'roots'); ?></p>
      <ul class="error">
        <li><?php _e('a mistyped address', 'roots'); ?></li>
        <li><?php _e('an out-of-date link', 'roots'); ?></li>
      </ul>
      <?php //get_search_form(); ?>
    </main><!-- /.main -->
    <?php if (roots_display_sidebar()) : ?>
      <aside class="sidebar" role="complementary">
        <?php include roots_sidebar_path(); ?>
      </aside><!-- /.sidebar -->
    <?php endif; ?>
  </div>
</div>