=== WPMU Default User Role ===
Contributors: DeannaS, kgraeme
Tags: WPMU
Requires at least: 3.0
Tested up to: 3.1.1
Stable tag: trunk



Lets site admins define which blogs a user should automatically become a member of, and with what role. Multiple blogs supported.

== Description ==

When users are first created, they are automatically assigned to the primary blog. But, you may want to set them up on multiple blogs by default. This is especially helpful if you're using bbpress or other forum software where the user needs a role on that blog in order to participate. This plugin allows site admins to set the default role on as many blogs as desired for all new users.

== Installation ==

1. Place the cets\_default\_user\_role.php file and the cets\_default\_user\_role folder in the wp-content/mu-plugins folder.
1. Go to Site Admin - New User Default Role to activate the plugin and set default roles.


== Screenshots ==
1. Administrator view of setting new user default roles


== ChangeLog==
1.3 - Update for WP. 3.1 Network Admin Menu
1.2 - Changed action hook to fire on 3.0
1.1 - added blog id number for all blogs identified as "/" (useful for domain mapped blogs)
