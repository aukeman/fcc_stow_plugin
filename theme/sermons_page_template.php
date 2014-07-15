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
 overflow:hidden;
}

div.fcc-stow-sermon-post h2,span,a
{
 display:inline-block;
}

div.fcc-stow-sermon-post span.fcc-stow-sermon-date
{
 width:7em;
}


div.fcc-stow-sermon-post span.fcc-stow-sermon-title
{
 width:20em;
}

div.fcc-stow-sermon-post span.fcc-stow-sermon-speaker
{
}

div.fcc-stow-sermon-post a.fcc-stow-sermon-audio-file
{
  float:right;
}
      </style>
      <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'content', 'page' ); ?>
      <?php endwhile; ?>
    </div>
  </div>


<?php get_footer(); ?>
