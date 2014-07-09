<?php

const FCC_STOW_SERMONS_TYPE = "fcc-stow-sermons";

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
		 "supports" => array( "title", "author", "excerpt", "editor" ));

  register_post_type( FCC_STOW_SERMONS_TYPE, $args );
}

function fcc_stow_sermon_admin_init()
{
  add_action( "add_meta_boxes", "fcc_stow_sermon_add_meta_boxes" );
}

function fcc_stow_sermon_add_meta_boxes()
{
  add_meta_box( "fcc-stow-sermon-guest-speaker-meta",
		"Set Guest Speaker",
		"fcc_stow_sermon_add_guest_speaker_meta_boxes",
		FCC_STOW_SERMONS_TYPE );

  add_meta_box( "fcc-stow-sermon-scripture-meta",
		"Set Scripture Passage",
		"fcc_stow_sermon_add_scripture_meta_boxes",
		FCC_STOW_SERMONS_TYPE );

  add_meta_box( "fcc-stow-sermon-audio-file-meta",
		"Set Audio File",
		"fcc_stow_sermon_add_audio_file_meta_boxes",
		FCC_STOW_SERMONS_TYPE );
}

function fcc_stow_sermon_add_scripture_meta_boxes()
{
  include( dirname(__FILE__) . 
	   "/../templates/scripture_meta_box.php" );
}

function fcc_stow_sermon_add_guest_speaker_meta_boxes()
{
  include( dirname(__FILE__) . 
	   "/../templates/guest_speaker_meta_box.php" );
}

function fcc_stow_sermon_add_audio_file_meta_boxes()
{
  include( dirname(__FILE__) . 
	   "/../templates/audio_file_meta_box.php" );
}

function fcc_stow_sermon_save($post_id)
{
  if ( !isset($_POST['post_type']) ||
       $_POST['post_type'] != FCC_STOW_SERMONS_TYPE ||
       !current_user_can('edit_post', $post_id) )
  {
    return;
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
add_action( "save_post", "fcc_stow_sermon_save" );
add_action( "after_switch_theme", "fcc_stow_sermon_after_switch_theme" );
register_activation_hook( __FILE__, "fcc_stow_sermon_plugin_activation" );


