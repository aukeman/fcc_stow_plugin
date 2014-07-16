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
					  <h1><?php the_title() ?></h1>
					  <div><?php echo get_the_date() ?></div>
					  <div><?php $guest_speaker = 
						      get_post_meta( get_the_ID(), 	   
						      	             'fcc-stow-sermon-guest-speaker', 
								     true ); 
					      echo ($guest_speaker == "" ? the_author() : $guest_speaker); ?>
					  </div>
					  <div><a href="<?php echo get_post_meta( get_the_ID(),
					                                          'fcc-stow-sermon-audio-file',
                                                                                  true ); ?>">Listen...</a></div>
					  <div><?php echo get_post_meta( get_the_ID(),
					                                 'fcc-stow-sermon-scripture-1',
                                                                          true ); ?></div>
					  <div><?php echo get_post_meta( get_the_ID(),
					                                 'fcc-stow-sermon-scripture-2',
                                                                          true ); ?></div>
					  <div><?php echo get_post_meta( get_the_ID(),
					                                 'fcc-stow-sermon-scripture-3',
                                                                          true ); ?></div>
					  <div><?php echo get_post_meta( get_the_ID(),
					                                 'fcc-stow-sermon-scripture-4',
                                                                          true ); ?></div>
					  <div><?php the_content() ?></div>
					</div>
				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
