<?php

/* const FCC_STOW_SERMONS_TYPE = "fcc-stow-sermon"; */
/* const FCC_STOW_SERMONS_PAGE_SETTING = "fcc-stow-sermon-sermons-page"; */


function fcc_stow_special_event_init()
{
    $labels = array( "name"               => "Special Events",
                     "singular_name"      => "Special Event",
                     "add_new_item"       => "Add New Special Event",
                     "new_item"           => "New Special Event",
                     "edit_item"          => "Edit Special Event",
                     "view_item"          => "View Special Event",
                     "all_items"          => "All Special Events",
                     "search_items"       => "Search Special Events",
                     "not_found"          => "No Special Events found",
                     "not_found_in_trash" => "No Special Events found in trash" );

    $args = array( "labels" => $labels,
                   "public" => true,
                   "rewrite" => array( "slug" => "special-event" ),
                   "supports" => array( "title" ));

    register_post_type( "fcc-stow-special-event", $args );

    add_filter( "the_content", "fcc_stow_special_event_post_apply_metadata" );
}

function fcc_stow_special_event_admin_init()
{
  add_action( "add_meta_boxes", "fcc_stow_special_event_add_meta_boxes" );

  add_action( 'post_edit_form_tag' , 'fcc_stow_special_event_post_edit_form_tag' );

  register_setting( 'fcc_stow_special_event_setting-group', 
                    "fcc-stow-special_event-special-events-page" );

  add_settings_section( 'fcc_stow_special_event_setting-section', 
                        'Special Events Settings', 
                        'fcc_stow_special_event_settings_section', 
                        'fcc_stow_special_event_setting' );

  add_settings_field('fcc_stow_special_event_setting-special_events_page', 
                     'Special Events Page', 
                     'fcc_stow_special_event_settings_add_page', 
                     'fcc_stow_special_event_setting', 
                     'fcc_stow_special_event_setting-section' );
}

function fcc_stow_special_event_post_edit_form_tag( ) {
    echo ' enctype="multipart/form-data"';
}

function fcc_stow_special_event_add_meta_boxes()
{
  add_meta_box( "fcc-stow-special-event-date",
		"Set Date",
		"fcc_stow_special_event_add_date_meta_boxes",
		"fcc-stow-special-event" );

  add_meta_box( "fcc-stow-spcial-event-location",
                "Set Location",
                "fcc_stow_special_event_add_location",
                "fcc-stow-special-event" );
}

function fcc_stow_special_event_settings_section()
{
  echo "Set the page on which the list of special events will be rendered";
}

function fcc_stow_special_event_settings_add_page()
{
  $field_id = "fcc-stow-special-event-special-events-page";
  $selected_page_id = get_option($field_id, -1);

  include ( dirname(__FILE__) . 
	   "/../templates/select_page_dropdown.php" );
}

function fcc_stow_special_event_settings_menu()
{
  add_options_page('Special Event Settings', 
                   'Special Event', 
                   'manage_options', 
                   'fcc_stow_special_event', 
                   'fcc_stow_special_event_settings_page');
}

function fcc_stow_special_event_settings_page()
{
  if(!current_user_can('manage_options'))
    {
      wp_die(__('You do not have sufficient permissions to access this page.'));
    }
	
  // Render the settings template
  include(dirname(__FILE__) . "/../templates/settings.php" );
}

function fcc_stow_special_event_add_date_meta_boxes($post)
{
  include( dirname(__FILE__) . 
	   "/../templates/special_event_date_meta_box.php" );
}

function fcc_stow_special_event_add_location($post)
{
  include( dirname(__FILE__) . 
	   "/../templates/special_event_location_meta_box.php" );
}

function fcc_stow_special_event_save($post_id)
{
  if ( !isset($_POST['post_type']) ||
       $_POST['post_type'] != "fcc-stow-special-event" ||
       !current_user_can('edit_post', $post_id) ||

       // Stop WP from clearing custom fields on autosave
       (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) ||
       
       // Prevent quick edit from clearing custom fields
       (defined('DOING_AJAX') && DOING_AJAX) )
  {
    return;
  }
}

function fcc_stow_special_event_template_redirect( $query )
{
  if ( is_page( get_option("fcc-stow-special-event-page", -1) ) )
  {
    add_filter( 'the_content', 'fcc_stow_special_event_append_content' );
  }
}

function fcc_stow_special_event_append_page_content( $content )
{
  ob_start();
  include ( dirname(__FILE__) . 
	   "/../templates/fcc-stow-special-event-archive.php" );
  return $content . ob_get_clean();
}

function fcc_stow_special_event_post_apply_metadata( $content ) {

  if ( is_singular("fcc-stow-special-event") )
  {
    ob_start();
    include ( dirname(__FILE__) . 
	      "/../templates/fcc-stow-special-event-single.php" );
    return ob_get_clean().$content;
  }
  else
  {
    return $content;
  }
}

function fcc_stow_special_event_rewrite_flush()
{
  fcc_stow_special_event_init();

  flush_rewrite_rules();
}

function fcc_stow_special_event_plugin_activation()
{
  fcc_stow_special_event_init();

  flush_rewrite_rules();
}

function fcc_stow_special_event_after_switch_theme()
{
  flush_rewrite_rules();
}

add_action( "init", "fcc_stow_special_event_init" );
add_action( "admin_init", "fcc_stow_special_event_admin_init" );
add_action('admin_menu', 'fcc_stow_special_event_setting_menu');
add_action( "save_post", "fcc_stow_special_event_save" );
add_action( "template_redirect", "fcc_stow_special_event_template_redirect" );
add_action( "after_switch_theme", "fcc_stow_special_event_after_switch_theme" );
register_activation_hook( __FILE__, "fcc_stow_special_event_plugin_activation" );


