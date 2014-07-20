<?php

// uses
//      FCC_STOW_SERMONS_TYPE 
// constant

$sermon_query = new WP_Query( "post_type=".FCC_STOW_SERMONS_TYPE );
while ( $sermon_query->have_posts() ) : $sermon_query->the_post(); 
  $guest_speaker = get_post_meta( get_the_ID(), 
	           		  'fcc-stow-sermon-guest-speaker', 
				  true ); 
  $audio_file = get_post_meta(get_the_ID(), 
			      'fcc-stow-sermon-audio-file', 
			      true);
?>
<div id="post-<?php the_ID() ?>" class="fcc-stow-sermon fcc-stow-sermon-post status-<?php echo get_post_status() ?>">
  <span class="fcc-stow-sermon-date"><?php echo get_the_date() ?></span>
  <span class="fcc-stow-sermon-title">
    <a href="<?php the_permalink() ?>" title="Permalink to <?php the_title()?>" rel="bookmark"><?php the_title() ?></a>
  </span>
  <span><?php fcc_stow_sermon_the_speaker() ?></span>
  <?php fcc_stow_sermon_the_audio_file_link() ?>
</div> <!-- #post-<?php the_ID() ?> -->
<?php endwhile; wp_reset_postdata(); ?>
