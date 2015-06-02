<?php
/*
Template Name: Contact
*/
?>

<?php show_header_image(); ?>

<div class="container">
  <div class="content row">
    <main class="main" role="main">
      <h1><?php the_title(); ?></h1>
      <div class="entry-content no-columns">
        <?php the_content(); ?>
        <div class="row">
          <?php
          // ACF Fields
          $visiting_address = get_field('visiting_address');
          $r_sinke          = get_field('r_sinke_details');
          $b_lokhorst       = get_field('b_lokhorst_details');
          $call_button_text = get_field('call_button_text');
          $call_button_tel  = get_field('call_button_telnr');
          ?>
          <div class="col-sm-3"><?php echo $visiting_address; ?></div>
          <div class="col-sm-3"><?php echo $r_sinke; ?></div>
          <div class="col-sm-3"><?php echo $b_lokhorst; ?></div>
          <div class="col-sm-3">
            <?php if($call_button_text && $call_button_tel) { ?>
              <a class="btn btn-primary" href="tel:<?php echo $call_button_tel; ?>"><i class="icon-phone-hang-up"></i><?php echo $call_button_text; ?></a>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php
      $id = icl_object_id(1, 'page', true);
      gravity_form($id, false, false, false, null, true);
      ?>
    </main><!-- /.main -->
  </div>
</div>