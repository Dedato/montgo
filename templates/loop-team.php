<?php if (have_posts()) { ?>
  <div class="team-members">
  	<?php while (have_posts()) : the_post();
  	  // ACF variables
  		$title      = get_field('team_member_title');
  		$birthyear  = get_field('team_member_birthyear');
  		$portrait   = get_field('team_member_portrait');
  		// Sizes
  		$img_alt    = $portrait['alt'];
  		$img_sm_src = $portrait['sizes']['portrait-sm'];
  		$img_md_src = $portrait['sizes']['portrait-md']; 
  		$img_lg_src = $portrait['sizes']['portrait-lg'];
  		// Retina Images
			if (function_exists('wr2x_get_retina_from_url')) {
				$img_sm_2x_src 	= wr2x_get_retina_from_url($img_sm_src);
				$img_md_2x_src 	= wr2x_get_retina_from_url($img_md_src);
				$img_lg_2x_src 	= wr2x_get_retina_from_url($img_lg_src);
			} ?> 
  	  <article <?php post_class(); ?>>
  	    <div class="team-header">
  			  <?php if($portrait) { ?>					
  				  <div class="container">
  				    <div class="portrait">
  				      <div class="entry-image">
  				        <picture>
      							<!--[if IE 9]><video style="display: none;"><![endif]-->
      							<source srcset="<?php if ($img_lg_2x_src) { echo $img_lg_2x_src . ' 2x, '; } echo $img_lg_src .' 1x'; ?>" media="(min-width:970px)">
      							<source srcset="<?php if ($img_md_2x_src) { echo $img_md_2x_src . ' 2x, '; } echo $img_md_src .' 1x'; ?>" media="(min-width:798px)">
      							<source srcset="<?php if ($img_sm_2x_src) { echo $img_sm_2x_src . ' 2x, '; } echo $img_sm_src .' 1x'; ?>">
      							<!--[if IE 9]></video><![endif]-->
      							<img srcset="<?php if ($img_lg_2x_src) { echo $img_lg_2x_src . ' 2x, '; } echo $img_lg_src .' 1x'; ?>" alt="<?php echo $img_alt; ?>" />
      						</picture>
  				      </div>
  				      <div class="entry-title">
                  <h2><?php the_title(); ?></h2>
                  <h3><?php echo $title .' ('. $birthyear .')'; ?></h3>
  				      </div>
              </div>
  				  </div>
          <?php } ?>
  			</div>
        <div class="team-content container">
           <div class="entry-content">
              <?php the_content(); ?>
           </div>
        </div>	      
      </article>      
  	<?php endwhile; ?>
  </div>	
<?php } else { ?>
  <div class="container">
    <p><?php _e('No team members found','montgo'); ?></p>
  </div>
<?php } ?>