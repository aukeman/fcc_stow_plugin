<?php

// uses 
//      $field_id
//      $selected_page_id
// variables

if ( ! isset($field_id) )
{
  $field_id = "fcc_stow_sermon_selected_page";
}

if ( ! isset($selected_page_id) )
{
  $selected_page_id = -1;
}

global $wpdb;

$results = 
 $wpdb->get_results( "select '' post_title, -1 ID " .
		     "union " .
		     "select post_title, ID from {$wpdb->posts} where " .
		     "(post_status, post_type) = ('publish', 'page') " .
		     "order by post_title" );

$pages = $results ? $results : array();
?>  

<select name="<?php echo $field_id ?>" id="<?php echo $field_id ?>">

<?php 
  foreach( $pages as $page ) 
  { 
    $selected = ($selected_page_id == $page->ID ? 'selected="selected"' : ''); 
?>
    <option value="<?php echo $page->ID ?>" <?php echo $selected ?>><?php echo $page->post_title?></option>

<?php
  }
?>

</select>
