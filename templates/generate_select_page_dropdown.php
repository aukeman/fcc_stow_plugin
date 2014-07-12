<?php

function generate_select_page_dropdown( $field_id, $selected_page_id = -1 )
{
  global $wpdb;

  // uses $field name
  //      $selected_page_id

  $results = 
    $wpdb->get_results( "select '' post_title, -1 ID " .
			"union " .
			"select post_title, ID from {$wpdb->posts} where " .
			"(post_status, post_type) = ('publish', 'page') " .
			"order by post_title" );

  $pages = $results ? $results : array();

  echo "<select name=\"$field_id\" id=\"$field_id\">";

  foreach( $pages as $page ) 
  { 
    $selected = ($selected_page_id == $page->ID ? 'selected="selected"' : ''); 

    echo "  <option value=\"$page->ID\" $selected>$page->post_title</option>";
  }

  echo "</select>";
}
