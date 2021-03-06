<?php

/* const FCC_STOW_SERMONS_TYPE = "fcc-stow-sermon"; */
/* const FCC_STOW_SERMONS_PAGE_SETTING = "fcc-stow-sermon-sermons-page"; */


function fcc_stow_sermon_get_the_year()
{
  static $last_year = 0;

  $year = get_the_time('Y');

  if ( $year == $last_year ){
    return;
  }

  $last_year = $year;

  return $year;
}

function fcc_stow_sermon_the_speaker()
{
   $guest_speaker = 
     get_post_meta( get_the_ID(), 	   
                    'fcc-stow-sermon-guest-speaker', 
		    true ); 
			 
   echo ($guest_speaker == "" ? get_the_author() : htmlspecialchars( $guest_speaker) );
}

function fcc_stow_sermon_the_audio_file_link( $class = "fcc-stow-sermon-audio-file", 
                                              $link_text = "Listen..." )
{
  $audio_file = get_post_meta( get_the_ID(),
                               'fcc-stow-sermon-audio-file',
                               true );
  if ( !empty($audio_file) )
  {
?>
    <a class="<?php echo $class ?>" href="<?php echo ($audio_file["url"]) ?>"><?php echo htmlspecialchars($link_text) ?></a>
<?php
  }
}

function fcc_stow_sermon_the_scripture_passages( $class = "fcc-stow-sermon-scripture" )
{
  foreach ( array(1, 2, 3, 4) as $id ) 
  {
    $passage = get_post_meta( get_the_ID(),
                              'fcc-stow-sermon-scripture-'.$id,
                              true );

    if ( $passage != "" )
    {
?>
      <div class="<?php echo $class ?>"><?php echo htmlspecialchars( $passage ) ?></div>
<?php 
    }
  }
}

function fcc_stow_sermon_init()
{
  $labels = array( "name"               => "Sermons",
		   "singular_name"      => "Sermon",
		   "add_new_item"       => "Add New Sermon",
		   "new_item"           => "New Sermon",
		   "edit_item"          => "Edit Sermon",
		   "view_item"          => "View Sermon",
		   "all_items"          => "All Sermons",
		   "search_items"       => "Search Sermons",
		   "not_found"          => "No sermons found",
		   "not_found_in_trash" => "No sermons found in trash" );

  $args = array( "labels" => $labels,
		 "public" => true,
		 "rewrite" => array( "slug" => "sermon" ),
		 "supports" => array( "title", "author", "editor" ));

  register_post_type( "fcc-stow-sermon", $args );

  add_filter( "the_content", "fcc_stow_sermon_post_apply_metadata" );
  add_filter( "the_title", "fcc_stow_sermon_add_quotes_to_title" );
}

function fcc_stow_sermon_admin_init()
{
  add_action( "add_meta_boxes", "fcc_stow_sermon_add_meta_boxes" );

  add_action( 'post_edit_form_tag' , 'fcc_stow_sermon_post_edit_form_tag' );

  register_setting( 'fcc_stow_sermon_setting-group', 
		    "fcc-stow-sermon-sermons-page" );

  add_settings_section( 'fcc_stow_sermon_setting-section', 
			'Sermon Settings', 
			'fcc_stow_sermon_settings_section', 
                        'fcc_stow_sermon_setting' );

  add_settings_field('fcc_stow_sermon_setting-sermons_page', 
                'Sermons Page', 
		'fcc_stow_sermon_settings_add_page', 
                'fcc_stow_sermon_setting', 
                'fcc_stow_sermon_setting-section' );
}

function fcc_stow_sermon_post_edit_form_tag( ) {
    echo ' enctype="multipart/form-data"';
}

function fcc_stow_sermon_add_quotes_to_title($title)
{
  if ( in_the_loop() && get_post_type() == "fcc-stow-sermon" )
  {
    return '&ldquo;'.$title.'&rdquo;';
  }
  else
  {
    return $title;
  }
}

function fcc_stow_sermon_add_meta_boxes()
{
  add_meta_box( "fcc-stow-sermon-guest-speaker-meta",
		"Set Guest Speaker",
		"fcc_stow_sermon_add_guest_speaker_meta_boxes",
		"fcc-stow-sermon" );

  add_meta_box( "fcc-stow-sermon-scripture-meta",
		"Set Scripture Passage",
		"fcc_stow_sermon_add_scripture_meta_boxes",
		"fcc-stow-sermon" );

  add_meta_box( "fcc-stow-sermon-audio-file-meta",
		"Set Audio File",
		"fcc_stow_sermon_add_audio_file_meta_boxes",
		"fcc-stow-sermon" );
}

function fcc_stow_sermon_settings_section()
{
  echo "Set the page on which the list of sermons will be rendered";
}

function fcc_stow_sermon_settings_add_page()
{
  $field_id = "fcc-stow-sermon-sermons-page";
  $selected_page_id = get_option("fcc-stow-sermon-sermons-page", -1);

  include ( dirname(__FILE__) . 
	   "/../templates/select_page_dropdown.php" );
}

function fcc_stow_sermon_setting_menu()
{
  add_options_page('Sermon Settings', 
        	   'Sermon', 
        	   'manage_options', 
        	   'fcc_stow_sermon', 
		   'fcc_stow_sermon_settings_page');
}

function fcc_stow_sermon_settings_page()
{
  if(!current_user_can('manage_options'))
    {
      wp_die(__('You do not have sufficient permissions to access this page.'));
    }
	
  // Render the settings template
  include(dirname(__FILE__) . "/../templates/settings.php" );
}

function fcc_stow_sermon_add_guest_speaker_meta_boxes($post)
{
  include( dirname(__FILE__) . 
	   "/../templates/guest_speaker_meta_box.php" );
}

function fcc_stow_sermon_add_scripture_meta_boxes($post)
{
  include( dirname(__FILE__) . 
	   "/../templates/scripture_meta_box.php" );
}

function fcc_stow_sermon_add_audio_file_meta_boxes($post)
{
  include( dirname(__FILE__) . 
	   "/../templates/audio_file_meta_box.php" );
}

function fcc_stow_sermon_save($post_id)
{
  if ( !isset($_POST['post_type']) ||
       $_POST['post_type'] != "fcc-stow-sermon" ||
       !current_user_can('edit_post', $post_id) ||

       // Stop WP from clearing custom fields on autosave
       (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) ||
       
       // Prevent quick edit from clearing custom fields
       (defined('DOING_AJAX') && DOING_AJAX) )
  {
    return;
  }

  foreach( array( 'fcc-stow-sermon-guest-speaker',
		  'fcc-stow-sermon-scripture-1',
		  'fcc-stow-sermon-scripture-2',
		  'fcc-stow-sermon-scripture-3',
		  'fcc-stow-sermon-scripture-4' ) as $field )
  {
    update_post_meta( $post_id, 
		      $field, 
		      sanitize_text_field( $_REQUEST[$field] ) );
  }

  if ( isset( $_REQUEST['fcc-stow-sermon-remove-audio-file'] ) )
  {
    delete_post_meta( $post_id, 'fcc-stow-sermon-audio-file' );
  }

  $sermon_file_info=$_FILES['fcc-stow-sermon-upload-audio-file'];

  // Make sure the file array isn't empty
  if(!empty($sermon_file_info['name'])) 
  {
    // Use the WordPress API to upload the file
    $upload = 
      wp_upload_bits($sermon_file_info['name'], 
		     null, 
		     file_get_contents($sermon_file_info['tmp_name']));
     
    if(isset($upload['error']) && $upload['error'] != 0) 
    {
      wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
    } 
    else 
    {
      update_post_meta($post_id, 'fcc-stow-sermon-audio-file', $upload);
    } // end if/else
  } // end if
}

function fcc_stow_sermon_template_redirect( $query )
{
  if ( is_page( get_option("fcc-stow-sermon-sermons-page", -1) ) )
  {
    add_filter( 'the_content', 'fcc_stow_sermon_append_sermon_page_content' );
  }
}

function fcc_stow_sermon_append_sermon_page_content( $content )
{
  ob_start();
  include ( dirname(__FILE__) . 
	   "/../templates/fcc-stow-sermon-archive.php" );
  return $content . ob_get_clean();
}

function fcc_stow_sermon_post_apply_metadata( $content ) {

  if ( is_singular("fcc-stow-sermon") )
  {
    ob_start();
    include ( dirname(__FILE__) . 
	      "/../templates/fcc-stow-sermon-single.php" );
    return ob_get_clean().$content;
  }
  else
  {
    return $content;
  }
}

function fcc_stow_sermon_rewrite_flush()
{
  fcc_stow_sermon_init();

  flush_rewrite_rules();
}

function fcc_stow_sermon_plugin_activation()
{
  fcc_stow_sermon_init();

  flush_rewrite_rules();
}

function fcc_stow_sermon_after_switch_theme()
{
  flush_rewrite_rules();
}

add_action( "init", "fcc_stow_sermon_init" );
add_action( "admin_init", "fcc_stow_sermon_admin_init" );
add_action('admin_menu', 'fcc_stow_sermon_setting_menu');
add_action( "save_post", "fcc_stow_sermon_save" );
add_action( "template_redirect", "fcc_stow_sermon_template_redirect" );
add_action( "after_switch_theme", "fcc_stow_sermon_after_switch_theme" );
register_activation_hook( __FILE__, "fcc_stow_sermon_plugin_activation" );


