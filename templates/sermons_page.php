<?php

// uses
//      FCC_STOW_SERMONS_TYPE 
// constant

$sermon_query = new WP_Query( "post_type=".FCC_STOW_SERMONS_TYPE );
while ( $sermon_query->have_posts() ) : $sermon_query->the_post(); ?>

<div id="post-<?php the_ID() ?>" <?php post_class('fcc-stow-sermon-post') ?>>
  <h2 class="fcc-stow-sermon-title">
    <a href="<?php the_permalink() ?>" title="Permalink to <?php the_title()?>" rel="bookmark">"<?php the_title() ?>"</a>
  </h2>

  <div class="fcc-stow-sermon-meta">
      <span class="fcc-stow-sermon-date"><?php echo get_the_date() ?></span>
      <span class="fcc-stow-sermon-speaker">
	<?php $guest_speaker = 
	      get_post_meta( get_the_ID(), 
	                     'fcc-stow-sermon-guest-speaker', 
			     true ); 
              echo ($guest_speaker == "" ? the_author() : $guest_speaker); ?>
      </span>
      <span class="fcc-stow-sermon-scripture-1">
	<?php echo get_post_meta(get_the_ID(), 'fcc-stow-sermon-scripture-1', true);?>
      </span>
      <span class="fcc-stow-sermon-scripture-2">
	<?php echo get_post_meta(get_the_ID(), 'fcc-stow-sermon-scripture-2', true);?>
      </span>
      <span class="fcc-stow-sermon-scripture-3">
	<?php echo get_post_meta(get_the_ID(), 'fcc-stow-sermon-scripture-3', true);?>
      </span>
      <span class="fcc-stow-sermon-scripture-4">
	<?php echo get_post_meta(get_the_ID(), 'fcc-stow-sermon-scripture-4', true);?>
      </span>
      <a class="fcc-stow-sermon-audio-file" 
	 href="<?php echo get_post_meta(get_the_ID(), 'fcc-stow-sermon-audio-file', true);?>">Listen...</a>
      <span class="fcc-stow-sermon-excerpt"><?php global $post; echo sanitize_text_field( $post->post_excerpt ) ?></span>
  </div>
</div> <!-- #post-<?php the_ID() ?> -->

<?php endwhile; wp_reset_postdata(); ?>
