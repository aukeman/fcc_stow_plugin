<?php
/*
Plugin Name: FCC Stow Sermons
Plugin URI: 
Description: Facilitates posting sermon transcripts and audio to the web 
Version: 0.1
Author: Jacob Aukeman
Author URI: http://www.jacobaukeman.com
License: GPL2
*/
/*
Copyright 1024  Jacob Aukeman  (email : jacob@jacobaukeman.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require( dirname(__FILE__) . "/post-types/fcc_stow_sermon.php" );

function fcc_stow_sermon_plugin_activate()
{
  /* no-op */
}

function fcc_stow_sermon_plugin_deactivate()
{
  /* no-op */
}



register_activation_hook(__FILE__, "fcc_stow_sermon_plugin_activate");
register_deactivation_hook(__FILE__, "fcc_stow_sermon_plugin_deactivate");


