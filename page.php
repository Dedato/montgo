<?php show_header_image(); ?>
<?php $col_count = get_field('page_column_count'); ?>
<div class="container">
  <div class="content row">
    <main class="main" role="main">
      <h1><?php the_title(); ?></h1>
      <div class="entry-content<?php if(!$col_count) echo ' no-columns' ?>">
        <?php the_content(); ?>
      </div>
    </main><!-- /.main -->
    <?php if (roots_display_sidebar()) : ?>
      <aside class="sidebar" role="complementary">
        <?php include roots_sidebar_path(); ?>
      </aside><!-- /.sidebar -->
    <?php endif; ?>
  </div>
</div>