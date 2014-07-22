<table class="fcc-stow-sermon-archive-container">
<?php

// uses
//      FCC_STOW_SERMONS_TYPE 
// constant

$sermon_query = new WP_Query( array('post_type' => FCC_STOW_SERMONS_TYPE) );
while ( $sermon_query->have_posts() ) : $sermon_query->the_post(); ?>
<?php if ( $sermon_year = fcc_stow_sermon_get_the_year() ) : ?>
  <tr>
    <th colspan="4" class="fcc-stow-sermon-archive-year"><?php echo $sermon_year?></th>
  </tr>
<?php $first_row = false; endif ?>
<tr id="post-<?php the_ID() ?>" >
  <td class="fcc-stow-sermon-archive-date"><?php the_date("F j") ?></td>
  <td class="fcc-stow-sermon-archive-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></td>
  <td class="fcc-stow-sermon-archive-speaker"><?php fcc_stow_sermon_the_speaker() ?></td>
  <td class="fcc-stow-sermon-archive-audio"><?php fcc_stow_sermon_the_audio_file_link() ?>
</tr>
<?php endwhile; wp_reset_postdata(); ?>
</table>

