<?php
/**
 * The Template for displaying all single sermon posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

<div id="primary">
  <div id="content" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

      <nav id="nav-single">
        <h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
          <span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous', 'twentyeleven' ) ); ?></span>
          <span class="nav-next"><?php next_post_link( '%link', __( 'Next <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></span>
      </nav><!-- #nav-single -->
      <div id="post-<?php the_ID() ?>" <?php post_class()?>>
        <div><?php echo get_the_date() ?></div>
        <h1>&ldquo;<?php the_title() ?>&rdquo;</h1>
        <div><?php fcc_stow_sermon_the_speaker() ?></div>
	<div><?php fcc_stow_sermon_the_scripture_passages() ?></div>
        <div><?php fcc_stow_sermon_the_audio_file_link() ?></div>
	<div><?php the_content() ?></div>
      </div>
    <?php endwhile; // end of the loop. ?>

  </div><!-- #content -->
</div><!-- #primary -->

	   <?php get_footer(); ?>
