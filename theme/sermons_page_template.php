<?php
/**
 * Template Name: Sermons Page Template
 * Description: Page for Sermons
 *
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

// Enqueue showcase script for the slider
wp_enqueue_script( 'twentyeleven-showcase', get_template_directory_uri() . '/js/showcase.js', array( 'jquery' ), '2011-04-28' );

get_header(); ?>

  <div id="primary">
    <div id="content" role="main">
      <style type="text/css">
div.entry-content
{
	width: 100% !important;
}      

div.fcc-stow-sermon-post
{
    position:relative;
    padding-left: 7em;
    padding-right: 7em;
}

div.fcc-stow-sermon-post h2,span,a
{
}

div.fcc-stow-sermon-post span.fcc-stow-sermon-date
{
    position:absolute;
    left:0em;
}


div.fcc-stow-sermon-post span.fcc-stow-sermon-title
{

}

div.fcc-stow-sermon-post span.fcc-stow-sermon-speaker
{
	position:absolute; 
	right: 5em;

	padding-left: 0.5em;
	width: 15em; 
	background-color: white;
	
}

div.fcc-stow-sermon-post a.fcc-stow-sermon-audio-file
{
    position:absolute;
    right:0em;
}
      </style>
      <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'content', 'page' ); ?>
      <?php endwhile; ?>
    </div>
  </div>


<?php get_footer(); ?>