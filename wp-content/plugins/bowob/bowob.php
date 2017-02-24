<?php

/*
Plugin Name: BoWoB
Version: 7.4
Plugin URI: http://www.bowob.com/wordpress_chat_plugin
Description: Chat Wordpress Integrated
Author: BoWoB
Author URI: http://www.bowob.com/
*/

/**
 * @file bowob.php
 *
 * Implements main functions and calls the BoWoB API.
 */

$bowob_type = is_numeric(@$_GET['type']) ? intval($_GET['type']) : -1;

if($bowob_type < 0)
{
  add_action('activate_bowob/bowob.php', 'bowob_activate');
  add_action('deactivate_bowob/bowob.php', 'bowob_deactivate');
  add_action('wp_footer', 'bowob_code');
  add_action('admin_init', 'bowob_admin_init');
  add_action('admin_menu', 'bowob_admin_menu');
  add_action('network_admin_menu', 'bowob_admin_network_menu');
  add_action('admin_notices', 'bowob_admin_notices');
  add_action('network_admin_notices', 'bowob_admin_network_notices');
}
else
{
  require(dirname(dirname(dirname(dirname(realpath(__FILE__))))) . '/wp-load.php'); // Depends on the path of this file: /wp-content/plugins/bowob/bowob.php
  
  if($bowob_type == 2)
  {
    bowob_server_sync();
  }
  elseif($bowob_type == 3)
  {
    bowob_client_sync();
  }
  elseif($bowob_type == 4)
  {
    bowob_redirect_login();
  }
  elseif($bowob_type == 5)
  {
    bowob_redirect_profile();
  }
}

/**
 * Prints synchronization data to be readed by BoWoB server.
 * @return void.
 */
function bowob_server_sync()
{
  header('Cache-Control: no-cache, must-revalidate');
  header('Content-Type: text/plain; charset=utf-8');

  include(dirname(realpath(__FILE__)) . '/bowob_api.php');

  echo bowob_api_get_sync_data(
    is_numeric(@$_GET['id']) ? intval($_GET['id']) : -1,
    is_string(@$_GET['sync']) ? $_GET['sync'] : '',
    @$_GET['name'] == '1',
    @$_GET['avatar'] == '1',
    @$_GET['friends'] == '1'
  );
}

/**
 * Creates a synchronization record and prints record identifiers to be readed by BoWoB client.
 * @return void.
 */
function bowob_client_sync()
{
  header('Cache-Control: no-cache, must-revalidate');
  header('Content-Type: text/plain');

  include(dirname(realpath(__FILE__)) . '/bowob_api.php');
  
  echo bowob_api_new_sync(
    is_string(@$_GET['nick']) ? $_GET['nick'] : '',
    @$_GET['name'] == '1',
    @$_GET['avatar'] == '1'
  );
}

/**
 * Redirects to login page.
 * @return void.
 */
function bowob_redirect_login()
{
  wp_redirect(get_bloginfo('url') . '/wp-login.php');
  exit();
}

/**
 * Redirects to user profile page.
 * @return void.
 */
function bowob_redirect_profile()
{
  $userid = is_numeric(@$_GET['id']) ? intval($_GET['id']) : -1;

  if($userid > 0)
  {
    if(defined('BP_VERSION'))
    {
      $link = bp_core_get_userlink($userid, false, true);

      if(!empty($link))
      {
        wp_redirect($link);
        exit();
      }
    }
  }

  wp_redirect(get_bloginfo('url') . '/index.php');
  exit();
}

/**
 * Prints BoWoB HTML code for show the chat.
 * @return void.
 */
function bowob_code()
{
  include(dirname(realpath(__FILE__)) . '/bowob_api.php');

  bowob_get_options();

  echo bowob_api_get_code(BOWOB_APP_ID, BOWOB_SERVER_ADDRESS);
}

/**
 * Checks if current user is logued.
 * @return boolean User is logued.
 */
function bowob_is_user_logued()
{
  $user = wp_get_current_user();
  
  if($user->ID > 0)
  {
    return true;
  }
  else
  {
    return false;
  }
}

/**
 * Gets current user id.
 * @return int User id.
 */
function bowob_get_user_id()
{
  $user = wp_get_current_user();
  
  return $user->ID;
}

/**
 * Gets current user nick.
 * @return string User nick.
 */
function bowob_get_user_nick()
{
  $user = wp_get_current_user();

  if($user->ID > 0)
  {
    return $user->user_login;
  }
  else
  {
    return '';
  }
}

/**
 * Gets current user name.
 * @return string User name.
 */
function bowob_get_user_name()
{
  $user = wp_get_current_user();
  
  if($user->ID <= 0)
  {
    return '';
  }

  if(defined('BP_VERSION'))
  {
    $visiblename = bp_get_loggedin_user_fullname();
  }
  else
  {
    $visiblename = $user->display_name;
  }

  if($visiblename == $user->user_login)
  {
    return '';
  }
  else
  {
    return $visiblename;
  }
}

/**
 * Gets current user avatar url.
 * @return string User avatar.
 */
function bowob_get_user_avatar()
{
  $user = wp_get_current_user();

  if($user->ID > 0)
  {
    if(defined('BP_VERSION'))
    {
      return bp_get_loggedin_user_avatar('html=false');
    }
  }
  
  return '';
}

/**
 * Gets current user friends.
 * @param int $id User id.
 * @param string $separator Separator between nicks.
 * @return string User friends.
 */
function bowob_get_user_friends($id, $separator)
{
  if($id <= 0)
  {
    return '';
  }

  $output = '';
  
  if(defined('BP_VERSION'))
  {
    if(bp_has_members('user_id=' . $id))
    {
      while(bp_members())
      {
        bp_the_member();
        $output .= bp_get_member_user_login() . $separator;
      }
    }
  }
  
  return $output;
}

/**
 * Stores a synchronization record in database.
 * @param string $auth Record auth.
 * @param int $creation Record creation time.
 * @param int $user_id Record user id.
 * @param string $user_nick Record user nick.
 * @param string $user_name Record user name.
 * @param string $user_avatar Record user avatar.
 * @param int $user_type Record user type.
 * @return int Record id.
 */
function bowob_store_sync($auth, $creation, $user_id, $user_nick, $user_name, $user_avatar, $user_type)
{
  global $wpdb;
  
  $wpdb->query($wpdb->prepare('INSERT INTO ' . $wpdb->prefix . 'bowob (auth, creation, user_id, user_nick, user_name, user_avatar, user_type) VALUES (%s, %d, %d, %s, %s, %s, %d)', $auth, $creation, $user_id, $user_nick, $user_name, $user_avatar, $user_type));
  
  return $wpdb->get_var('SELECT LAST_INSERT_ID()');
}

/**
 * Extracts a synchronization record from database.
 * @param int $id Record id.
 * @param string $auth Record auth.
 * @param int $expiration Record expiration time.
 * @return array Record values.
 */
function bowob_extract_sync($id, $auth, $expiration)
{
  global $wpdb;
  
  $wpdb->query($wpdb->prepare('DELETE FROM ' . $wpdb->prefix . 'bowob WHERE creation < %d', $expiration));
  
  $rs = $wpdb->get_results($wpdb->prepare('SELECT auth, user_id, user_nick, user_name, user_avatar, user_type FROM ' . $wpdb->prefix . 'bowob WHERE id = %d', $id));
  
  if(!$rs || $rs[0]->auth != $auth)
  {
    return array();
  }
  else
  {
    $wpdb->query($wpdb->prepare('DELETE FROM ' . $wpdb->prefix . 'bowob WHERE id = %d', $id));

    return array(
      'user_id' => $rs[0]->user_id,
      'user_nick' => $rs[0]->user_nick,
      'user_name' => $rs[0]->user_name,
      'user_avatar' => $rs[0]->user_avatar,
      'user_type' => $rs[0]->user_type,
    );
  }
}

/**
 * Creates the BoWoB table and options.
 * @return void.
 */
function bowob_activate()
{
  global $wpdb;
  
  $charset_collate = '';

  if(!empty($wpdb->charset))
  {
    $charset_collate = 'DEFAULT CHARACTER SET ' . $wpdb->charset;
  }
  if(!empty($wpdb->collate))
  {
    $charset_collate .= ' COLLATE ' . $wpdb->collate;
  }

  $wpdb->query('DROP TABLE IF EXISTS ' . $wpdb->prefix . 'bowob');
  
  $wpdb->query('CREATE TABLE ' . $wpdb->prefix . 'bowob (
    id int(10) unsigned NOT NULL auto_increment,
    auth varchar(50) NOT NULL default \'\',
    creation int(10) unsigned NOT NULL default \'0\',
    user_id int(10) unsigned NOT NULL default \'0\',
    user_nick varchar(50) NOT NULL default \'\',
    user_name varchar(50) NOT NULL default \'\',
    user_avatar varchar(200) NOT NULL default \'\',
    user_type int(10) unsigned NOT NULL default \'0\',
    PRIMARY KEY (id)
  ) ' . $charset_collate);
  
  delete_site_option('bowob_network_activated');
}

/**
 * Deletes the BoWoB table and options.
 * @return void.
 */
function bowob_deactivate()
{
  global $wpdb;
  
  delete_option('bowob_options');
  delete_site_option('bowob_network_activated');

  $wpdb->query('DROP TABLE IF EXISTS ' . $wpdb->prefix . 'bowob');
}

/**
 * Gets current BoWoB configuration options.
 * @return void.
 */
function bowob_get_options()
{
  $blog_options = get_option('bowob_options');
  if(!$blog_options)
  {
    $blog_options = array(
      'app_id' => '',
      'server_address' => '',
    );

    update_option('bowob_options', $blog_options);
  }
  
  $site_options = get_site_option('bowob_netopts');
  if(!$site_options)
  {
    $site_options = array(
      'app_id' => '',
      'server_address' => '',
    );

    update_site_option('bowob_netopts', $site_options);
  }
  
  $network_activated = get_site_option('bowob_network_activated');
  if(!$network_activated)
  {
    if(!function_exists('is_plugin_active_for_network'))
    {
      require_once(ABSPATH . '/wp-admin/includes/plugin.php');
    }
    
    if(is_plugin_active_for_network('bowob/bowob.php'))
    {
      $network_activated = 'yes';
    }
    else
    {
      $network_activated = 'no';
    }
    
    update_site_option('bowob_network_activated', $network_activated);
  }

  define('BOWOB_BLOG_APP_ID', $blog_options['app_id']);
  define('BOWOB_BLOG_SERVER_ADDRESS', $blog_options['server_address']);
  
  define('BOWOB_SITE_APP_ID', $site_options['app_id']);
  define('BOWOB_SITE_SERVER_ADDRESS', $site_options['server_address']);
  
  if($network_activated == 'yes')
  {
    define('BOWOB_APP_ID', $site_options['app_id']);
    define('BOWOB_SERVER_ADDRESS', $site_options['server_address']);
  }
  else
  {
    define('BOWOB_APP_ID', ($blog_options['app_id'] == '' ? $site_options['app_id'] : $blog_options['app_id']));
    define('BOWOB_SERVER_ADDRESS', ($blog_options['server_address'] == '' ? $site_options['server_address'] : $blog_options['server_address']));
  }
  
  define('BOWOB_NETWORK_ACTIVATED', $network_activated);
}

/**
 * Sets settings.
 * @return void.
 */
function bowob_admin_init()
{
  register_setting('bowob_options', 'bowob_options', 'bowob_admin_options_validate');
  add_settings_section('bowob_main', '', 'bowob_admin_main_text', 'bowob');
  add_settings_field('bowob_app_id', 'App id', 'bowob_admin_app_id_text', 'bowob', 'bowob_main');
  add_settings_field('bowob_server_address', 'Server address', 'bowob_admin_server_address_text', 'bowob', 'bowob_main');
}

/**
 * Sets settings page.
 * @return void.
 */
function bowob_admin_menu()
{
  bowob_get_options();
  
  if(BOWOB_NETWORK_ACTIVATED != 'yes')
  {
    add_options_page('BoWoB settings', 'BoWoB', 'manage_options', 'bowob', 'bowob_admin_options');
  }
}

/**
 * Prints settings page.
 * @return void.
 */
function bowob_admin_options()
{
  echo '<div>' . "\n";
  echo '<h2>BoWoB settings</h2>' . "\n";
  echo '<form action="options.php" method="post">' . "\n";
  settings_fields('bowob_options');
  do_settings_sections('bowob');
  echo '<br /><input type="submit" value="' . esc_attr('Save Changes') . '" />' . "\n";
  echo '</form>' . "\n";
  echo '</div>' . "\n";
}

/**
 * Prints Main settings section text.
 * @return void.
 */
function bowob_admin_main_text()
{
  echo '';
}

/**
 * Prints App id settings field text.
 * @return void.
 */
function bowob_admin_app_id_text()
{
  echo '<input id="bowob_app_id" name="bowob_options[app_id]" size="40" type="text" value="' . BOWOB_BLOG_APP_ID . '" /> Provided by bowob.com';
}

/**
 * Prints Server address settings field text.
 * @return void.
 */
function bowob_admin_server_address_text()
{
  echo '<input id="bowob_server_address" name="bowob_options[server_address]" size="40" type="text" value="' . BOWOB_BLOG_SERVER_ADDRESS . '" /> Provided by bowob.com';
}

/**
 * Validates settings form values.
 * @param array $input Form values.
 * @return Cleaned values.
 */
function bowob_admin_options_validate($input)
{
  $newinput['app_id'] = trim($input['app_id']);
  $newinput['server_address'] = trim($input['server_address']);

  if(!preg_match('/^[0-9]+$/', $newinput['app_id']))
  {
    $newinput['app_id'] = '';
  }
  if(!preg_match('/^https?:\/\/[a-z0-9\.\/]+\/$/', $newinput['server_address']))
  {
    $newinput['server_address'] = '';
  }

  return $newinput;
}

/**
 * Prints activation notices.
 * @return void.
 */
function bowob_admin_notices()
{
  if(BOWOB_NETWORK_ACTIVATED != 'yes' && (BOWOB_APP_ID == '' || BOWOB_SERVER_ADDRESS == ''))
  {
    echo '<div id="message" class="updated fade">' . "\n";
    printf('<p>' . __('<strong>BoWoB is almost ready</strong>. You must <a href="%s">update your BoWoB settings</a> for it to work.') . '</p>' . "\n", admin_url('options-general.php?page=bowob'));
    echo '</div>' . "\n";
  }
}

/**
 * Sets network settings page.
 * @return void.
 */
function bowob_admin_network_menu()
{
  bowob_get_options();
  
  add_submenu_page('settings.php', 'BoWoB Network settings', 'BoWoB Network', 'manage_options', 'bowob_network', 'bowob_admin_network_settings');
}

/**
 * Prints network settings page.
 * @return void.
 */
function bowob_admin_network_settings()
{
  $app_id = BOWOB_SITE_APP_ID;
  $server_address = BOWOB_SITE_SERVER_ADDRESS;
  
  if(isset($_POST['bowob_netopts-submit']) && isset($_POST['bowob_netopts']))
  {
    if(!check_admin_referer('bowob_netopts'))
    {
      return false;
    }
    
    $app_id = $_POST['bowob_netopts']['app_id'];
    $server_address = $_POST['bowob_netopts']['server_address'];
    
    $options = array(
      'app_id' => $app_id,
      'server_address' => $server_address,
    );
    
    update_site_option('bowob_netopts', $options);
  }
  
  echo '<div class="wrap">' . "\n";
  echo '<h2>' . __('BoWoB Network settings') . '</h2>' . "\n";
  
  if(isset($_POST['bowob_netopts']))
  {
    echo '<div id="message" class="updated fade">' . "\n";
    echo '<p>' . __( 'Settings Saved') . '</p>' . "\n";
    echo '</div>' . "\n";
  }

  echo '<form action="" method="post" id="bowob_netopts-form">' . "\n";
    echo '<table class="form-table">' . "\n";
      echo '<tbody>' . "\n";
        echo '<tr>' . "\n";
          echo '<th scope="row"><p>App id:</p></th>' . "\n";
          echo '<td><input id="bowob_app_id" name="bowob_netopts[app_id]" size="40" type="text" value="' . $app_id . '" /> Provided by bowob.com</td>' . "\n";
        echo '</tr>' . "\n";
        echo '<tr>' . "\n";
          echo '<th scope="row"><p>Server address:</p></th>' . "\n";
          echo '<td><input id="bowob_server_address" name="bowob_netopts[server_address]" size="40" type="text" value="' . $server_address . '" /> Provided by bowob.com</td>' . "\n";
        echo '</tr>' . "\n";
      echo '</tbody>' . "\n";
    echo '</table>' . "\n";
    echo '<p class="submit"><input class="button-primary" type="submit" name="bowob_netopts-submit" id="bowob_netopts-submit" value="' . __('Save Settings') . '"/></p>' . "\n";
    wp_nonce_field('bowob_netopts');
  echo '</form>' . "\n";
  echo '</div>' . "\n";
}

/**
 * Prints network activation notices.
 * @return void.
 */
function bowob_admin_network_notices()
{
  if(BOWOB_SITE_APP_ID == '' || BOWOB_SITE_SERVER_ADDRESS == '')
  {
    echo '<div id="message" class="updated fade">' . "\n";
    printf('<p>' . __('<strong>BoWoB is almost ready</strong>. You must <a href="%s">update your BoWoB Network settings</a> for it to work.') . '</p>' . "\n", admin_url('network/settings.php?page=bowob_network'));
    echo '</div>' . "\n";
  }
}

?>
