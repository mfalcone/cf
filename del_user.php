<?php
echo "a";


include "wp-load.php";

ini_set('display_errors', 'On');
error_reporting(E_ALL);
set_time_limit(0);

if(!function_exists('wp_delete_user')) 
{
require_once(ABSPATH . "wp-admin/includes/user.php");
}
global $wpdb;

echo '<pre>';

echo "Borrando usuarios previamente cargados ...\n";

$role = "subscriber"; // The role to kill
$reassign = 1; // The user that all posts will fall back to, other wise they will be deleted

$sql = "SELECT user_id FROM {$wpdb->prefix}usermeta WHERE meta_key LIKE '{$wpdb->prefix}capabilities' AND meta_value LIKE '%$role%'";

if ( $users_of_this_role = $wpdb->get_results( $sql, ARRAY_N ) )
foreach ( $users_of_this_role as $user_id )
wp_delete_user( $user_id[0], $reassign );
