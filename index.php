<?php
/**
 * Plugin Name: Plugin for developers sites
 * Plugin URI: wpone.ru
 * Description: Plugin make custom post type flat and if it needed documents
 * Version: 1.0
 * Author: NickD
 * Author URI: http://wordpressone.ru/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: flats search
 */

/*

  Copyright (C) 2017  NickD  nickdvinskikh@gmail.com

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.
*/
require_once('plugin.class.php');

if( class_exists('DEV_MAIN')){
	
	$just_initialize = new DEV_MAIN;

  $just_initialize->initActions;
}

?>