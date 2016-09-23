<?php
/******************************************************************************************************************
 
Plugin Name: cets_default_user_role

Plugin URI:

Description: WordPressMU plugin for site admin to set default role for new user on specific blogs. 

Version: 1.3

Author: Deanna Schneider

Copyright:

    Copyright 2008 Board of Regents of the University of Wisconsin System
	Cooperative Extension Technology Services
	University of Wisconsin-Extension

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

            
*******************************************************************************************************************/

class cets_default_user_role 
{
   
	
    function setup() 
    {
    	//only support version 3.0 or greater
    	if ( version_compare( $wp_version, '3.0', '>=' ) ) {
		
		// Set up the array of potential defaults
		$blogroles = array(1 => 'subscriber');
		
		$defaults = array(
			 'add_user_to_blog' => 0,
			 'blogroles' => $blogroles
			 );
			 
	 	// Add a site option so that we'll know set up ran
		add_site_option( 'cets_default_user_role_setup', 1 );
		add_site_option( 'cets_default_user_role_options', $defaults);
		
    	}		
    }
	
	

    
    
	function set_user_role($user_id)
    {
    	$options = get_site_option('cets_default_user_role_options');
			
		if ($options['add_user_to_blog'] == 1) {
			
			// for each of the blogs, add the user with the specified role
			if (is_array($options['blogroles'])){
				
				foreach ($options['blogroles'] as $key=>$value) {
					add_user_to_blog( $key, $user_id, $value );
					
					} //end foreach
				
				} //end if is_array
			} //end if add = 1
   }
	

	

	
	
	
	
	
	function update_defaults($ff){
		
		
		// create an array to hold the chosen options
		$newoptions = array();
		$newoptions['add_user_to_blog'] = ($_POST['add_user_to_blog'] == 1) ? 1 : 0;
		
		// Loop through all the values
		$blogroles = array();
		
		
		for ($i = 1; $i <= $_POST['count']; $i++){
			if (!isset($_POST['delete_role_' . $i]) && strlen($_POST['default_role_' . $i]) && $_POST['default_role_' . $i] != null && $_POST['blogid_' . $i] != null && strlen($_POST['blogid_' . $i])){
				$blogroles[$_POST['blogid_' . $i]] = $_POST['default_role_' . $i];	
			}
			
		}
		
		$newoptions['blogroles'] = $blogroles;
		
		// override the site option
		update_site_option ('cets_default_user_role_options', $newoptions); 
					
	}
    
   //Add the site-wide administrator menu  
	function add_siteadmin_page(){
		if (function_exists('is_network_admin')) {
			add_submenu_page('users.php', 'New User Default Role', 'New User Default role', 10, 'cets_default_role_management_page', array(&$this, 'cets_default_role_management_page'));
		}
		else{
			add_submenu_page('ms-admin.php', 'New User Default Role', 'New User Default role', 10, 'cets_default_role_management_page', array(&$this, 'cets_default_role_management_page'));
		}
       
     
	 }
	 
	 
	 
	 
	 function cets_default_role_management_page(){
	 	// Display the defaults that can be set by site admins
	 
	 	global $wpdb, $current_site;
		
		//Get the dashboard blog
		$dashblog = get_site_option('dashboard_blog');
		
		if(!is_numeric($dashblog) || !strlen($dashblog) || is_null($dashblog)) $dashblog = 1;
		
		$dashdetails = get_blog_details($dashblog);
		$blogname = $blogname = str_replace( '.', '', str_replace( $current_site->domain . $current_site->path, '', $dashdetails->domain . $dashdetails->path ) );
		if (! strlen($blogname)) $blogname = "the main blog";
		$defaultrole = get_site_option( 'default_user_role', 'subscriber' );
		
		// Get the list of all non-deleted, non-deactivated, non-spam blogs
		$bloglist = $wpdb->get_results( $wpdb->prepare("SELECT blog_id, domain, path FROM $wpdb->blogs WHERE site_id = %d  AND archived = '0'  AND spam = '0' AND deleted = '0' ORDER BY path", $wpdb->siteid), ARRAY_A );
		
		// only allow site admins to come here.
		if( is_site_admin() == false ) {
			wp_die( __('You do not have permission to access this page.') );
		}
		
			
		// process form submission    	
    	if ($_POST['action'] == 'update') {
			$this->update_defaults($_POST);
			$updated = true;
    	}
		
		// make sure we're using latest data
		$opt = get_site_option('cets_default_user_role_options');
		
		// get the primary blog
		
    	if ($updated) { ?>
        <div id="message" class="updated fade"><p><?php _e('Options saved.') ?></p></div>
        <?php	} 
        
		$file = WP_CONTENT_URL . '/mu-plugins/cets_default_user_role/script.js';
		
		?>
		<!-- This pulls in the add data script -->
		<SCRIPT LANGUAGE='JavaScript1.2' SRC='<?php echo $file; ?>'></SCRIPT>
		
		
		
        <h1>New User Default Role</h1>
		
		
        <form name="blogdefaultsform" action="" method="post">
        <table class="form-table">
        <tr>
        	<td colspan="2">The dashboard blog for all users is currently set to <?php echo $blogname ?> and the default role is set to <?php echo $defaultrole ?>. If you set a value here for the dashboard blog, it will override the settings from Site Admin -> Options. You can set additional blogs as well.</td>
		</tr>		
		<tr>
        <th valign="top">Add New Users to Blog(s):</th>
		<td valign="top"><input name="add_user_to_blog" type="checkbox" id="add_user_to_blog" value="1" <?php if ($opt['add_user_to_blog'] == 1) echo('checked="checked"'); ?> /> <?php _e('Yes') ?></label>
		</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="form-table" id="addRowTable">
					<tr>
						<th>Blog</th>
						<th>Role</th>
						<th>Delete</th>
					</tr>
					<?php 
					// figure out how many rows we need
					$count = 1;
					$blogroles = $opt['blogroles'];
					if(!is_array($blogroles) || sizeof($blogroles) < 1){
						$blogroles = array(1=>'subscriber');
					}
					foreach($blogroles as $blogid => $role){
						
					?>
					
					<tr id="startrow">
						<td><select name="blogid_<?php echo($count);?>" id="blogid_<?php echo($count);?>">
							<option value="">Select a Blog</option>
							<?php
							
							foreach ($bloglist as $blog){
								$blogname = ( constant( "VHOST" ) == 'yes' ) ? str_replace('.'.$current_site->domain, '', $blog['domain']) : $blog['path'];
									echo ('<option value="' . $blog['blog_id'] . '"');
									if ($blog['blog_id'] == $blogid) echo (' selected = "selected" ');
									
									echo ('>' . $blogname);
									if ($blogname == '/') {
										echo (' ( ' . $blog['blog_id'] . ')');
									}
									echo('</option>');
							}
							?>
							</select>
						</td>
						<td>
							<select name="default_role_<?php echo($count);?>" id="default_role_<?php echo($count);?>">
							<option value="">Select a Role</option>
							<option value="administrator"<?php if($role == 'administrator') echo ' selected="selected"';?>>Administator</option>
							<option value="editor"<?php if($role == 'editor') echo ' selected="selected"';?>>Editor</option>
							<option value="author"<?php if($role == 'author') echo ' selected="selected"';?>>Author</option>
							<option value="contributor"<?php if($role == 'contributor') echo ' selected="selected"';?>>Contributor</option>
							<option value="subscriber"<?php if($role == 'subscriber') echo ' selected="selected"';?>>Subscriber</option>				
							</select>
						</td>
					
						<td>
							<input type="checkbox" name="delete_role_<?php echo($count);?>">
						</td>
						</tr>	
						<?php
						$count = $count + 1;
						}// end loop
						?>	
				</table>
			</td>
		</tr>	
		
		</table>
		
		<p><a href="#" onClick="addFormField(); return false;">Add</a></p>
       <input type="hidden" name="count" id="id" value="<?php echo($count);?>">
         <p>  
         <input type="hidden" name="action" value="update" />
		 
        <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
          </p> 
		  </form>
		  
		  


        
        <?php
	 }
	
	
};


$cets_wpmunud = new cets_default_user_role();

// call set up if there's not option set yet

if( get_site_option( 'cets_default_user_role_setup' ) == null OR ($_GET['reset'] == 1 && $_GET['page'] == 'cets_default_role_management_page')) {
	
	// only allow site admins to run setup.
		//if( is_site_admin() == true ) {
			$cets_wpmunud->setup();
		//}

}

	
	
// When a user is activated, set the options 
if ( version_compare( $wp_version, '3.0', '<' ) ){
	add_action('wpmu_activate_user', array(&$cets_wpmunud, 'set_user_role'), 100, 2);
}
else {
	add_action('user_register', array(&$cets_wpmunud, 'set_user_role'), 100, 2);
}


// Add the site admin config page
if ( version_compare( $wp_version, '3.0', '>=' ) ) {
		if (function_exists('is_network_admin')) {
			// 3.1+
			add_action('network_admin_menu', array(&$cets_wpmunud, 'add_siteadmin_page'));
		}
		else{
			//-3.1
			add_action('admin_menu', array(&$cets_wpmunud, 'add_siteadmin_page'));
		}

}


	  

?>
