=== Plugin Name ===
Contributors: bainternet, adsbycb
Donate link: http://en.bainternet.info/donations
Donate link: 
Tags: twitter shortcode, tweets hashtag,twitter hashtag
Requires at least: 2.9.2
Tested up to: 4.0.0
Stable tag: 0.6.2

Displaying the most recent twitter status updates for a particular hash tag in your posts/pages using shortcode.

== Description ==
Displaying the most recent twitter status updates for a particular hash tag in your posts/pages using shortcode.

Usage: 
`[hashtag_tweets hashtag="YOUR_TAG" number="NUMBER_OF_TWEETS_TO_GET" cache="hours to cache"]`

Feuture relase will have a templating feature but for now i'll live the design to you with CSS

== Installation ==


Simple steps:  
  
1. Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation.  
  
2. Then activate the Plugin from Plugins page.  
  
3. Create a post/page and add the shortcode.

4. you are done.


== Frequently Asked Questions ==

= How to use the shortcode =

Simple, copy this line to your post or page:

`[hashtag_tweets hashtag="YOUR_TAG" number="NUMBER_OF_TWEETS_TO_GET"]`
and replace YOUR_TAG with your hashtag and UNMBER_OF_TWEETS_TO_GET with the number of tweets you want to get.
save and walla, you are done!

== Changelog ==
= 0.6.2 = 
* Fixed Invalid argument on line 160.

= 0.6.1 =
* activated transients.

= 0.6 =
* Updated to Twitter api V1.1
* Added an option panel to provide api keys.

= 0.5 =
* created as an oop class.
* added image on off option for shortcode.

= 0.4 =
* Added a mini caching feature to store data and refersh on set interval.
* Fixed image issue thanks to brasofilo.

= 3.0 =
* Inital release.
* fixed a few bugs.

= 0.1 =
* beta release.