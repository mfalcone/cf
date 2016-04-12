<?php
/*
Plugin Name: Twitter Hash Tag Shortcode
Plugin URI: http://en.bainternet.info
Description: Displaying the most recent twitter status updates for a particular hash tag in your posts/pages using shortcode.
Version: 0.6.2
Author: bainternet
Author URI: http://www.bainternet.info
*/
/*  Copyright 2012  - 2013 Ohad Raz  (email : admin@bainternet.info)

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
/**
* tweets_by_hashtag class
*/
class tweets_by_hashtag{
    public $options = false;
    /**
     * __construct 
     * 
     * Class constructor
     * @since   0.5
     * @author  Ohad      Raz   <admin@bainternet.info>
     * @return Void
     */
    function __construct(){
        add_filter( 'plugin_row_meta', array($this ,'ba_tweets_my_plugin_links'), 10, 2 );
        add_shortcode("hashtag_tweets",  array($this ,"ba_tweets_by_hashtag_9867"));
        if(is_admin()){
           $this->admin_panel();
        }
    }

    function get_options(){
        if (!$this->options){
            $def = array(
                'api_key' => null,
                'api_secret' => null
            );
            $options = get_option('Twitter_HashTag',array());
            $this->options = array_merge($def,$options);
        }
        return $this->options;
    }

    function admin_panel(){
        include_once(plugin_dir_path( __FILE__ ).'inc/SimplePanelClass.php');

        $p = new SimplePanelTwitterHashtagPanel(
            array(
                'title'      => 'Twitter HashTag Shortcode',
                'name'       => 'Twitter HashTag',
                'capability' => 'manage_options',
                'option'     => 'Twitter_HashTag'
            )
        );
        //section
        $setting = $p->add_section(array(
            'option_group'      =>  'Twitter_HashTag',
            'sanitize_callback' => null,
            'id'                => 'main-section-id', 
            'title'             => 'API Keys'
            )
        );
        //text field
        $p->add_field(array(
            'label'   => 'API Key',
            'std'     => '',
            'id'      => 'api_key',
            'type'    => 'text',
            'section' => $setting
            )
        );
        //text field
        $p->add_field(array(
            'label'   => 'API Secret',
            'std'     => '',
            'id'      => 'api_secret',
            'type'    => 'text',
            'section' => $setting
            )
        );
        //text field
        $p->add_field(array(
            'p_tag'   => 'To Get your free api keys just create an Twitter Developers account <a href="https://apps.twitter.com/app/new" target="_blank">here</a>.',
            'label'   => '',
            'std'     => '',
            'id'      => '',
            'type'    => 'paragraph',
            'section' => $setting
            )
        );
    }

    function ba_tweets_my_plugin_links($links, $file) {  
        $plugin = plugin_basename(__FILE__);  
      
        if ($file == $plugin) // only for this plugin  
            return array_merge( $links,  
                array( '<a href="http://en.bainternet.info/category/plugins">' . __('Other Plugins by this author' ) . '</a>' ),  
                array( '<a href="http://wordpress.org/tags/twitter-hash-tag-shortcode?forum_id=10">' . __('Plugin Support') . '</a>' ),  
                array( '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=K4MMGF5X3TM5L" target="_blank">' . __('Donate') . '</a>' )  
            );  
        return $links;  
    }

    /**
     * ba_tweets_by_hashtag_9867
     * 
     * shortcode handler funciton 
     * 
     * [hashtag_tweets hashtag="YOUR_TAG" number="NUMBER_OF_TWEETS_TO_GET" images="on/off" cache="number of hours to cache output"]
     * 
     * example:
     *     [hashtag_tweets hashtag="bainternetsites" number="5" cache="5"]  
     */
    function ba_tweets_by_hashtag_9867($atts, $content = null){
        extract(shortcode_atts(array(
            "hashtag" => 'default_tag',
            "number" => 5,
            "cache" => 3,
            "images" => "on"
        ), $atts));
        
        $output = get_transient( 'tweets_has_'. $hashtag);
        if ($output === false ) {
            $options = $this->get_options();
            if (!isset($options['api_key']) || null === $options['api_key'])
                return 'Please Set an API key in the plugin settings panel.';
            $token = $this->twitter_authenticate();
            if ( is_wp_error($token) ) {
                $output = "<p>".__("Failed to update from Twitter! Token Issue")."</p>\n";
                $output .= "<!--{$token->errors['message']}-->\n";
                return $output;
            }
            $url = 'https://api.twitter.com/1.1/search/tweets.json?q=%23'.$hashtag.'&count='.$number;
            $raw_response = $this->twitter_request($url,$token);
            if ( is_wp_error($raw_response) ) {
                $output = "<p>".__("Failed to update from Twitter!")."</p>\n";
                $output .= "<!--{$raw_response->errors['http_request_failed'][0]}-->\n";
            } else {
                $response = get_object_vars(json_decode($raw_response['body']));
                for ( $i=0; $i < count($response['statuses']); $i++ ) {
                    $response['statuses'][$i] = get_object_vars($response['statuses'][$i]);
                }
                
                $output = "<div class='twitter-hash-tag'>\n";
                foreach ( (array) $response['statuses'] as $result ) {
                    $text = $result['text'];
                    $user = $result['user']->name;
                    $image = $result['user']->profile_image_url;
                    $user_url = $result['user']->url;
                    $source_url = "$user_url/status/{$result['id_str']}";

                    $text = preg_replace('|(https?://[^\ ]+)|', '<a href="$1">$1</a>', $text);
                    $text = preg_replace('|@(\w+)|', '<a href="http://twitter.com/$1">@$1</a>', $text);
                    $text = preg_replace('|#(\w+)|', '<a href="http://search.twitter.com/search?q=%23$1">#$1</a>', $text);

                    $output .= "<div>";

                    if ( isset($image) &&  $images == "on")
                        $output .= "<a href='$user_url'><img src='$image' alt='$user' /></a>";
                    $output .= "<a href='$user_url'>$user</a>: $text <a href='$source_url'>&raquo;</a></div>\n";
                }
                $output .= "<div class='view-all'><a href='http://search.twitter.com/search?q=%23$hashtag'>" . __('View All') . "</a></div>\n";
                $output .= "</div>\n";
                //store as transients
                set_transient( 'tweets_has_'. $hashtag, $output, 60*60*absint($cache) );
            }
        }
        

        return $output;
    }

    public function twitter_authenticate($force = false) {
        $options = $this->get_options();
        $api_key = $options['api_key'];
        $api_secret = $options['api_secret'];
        $token = false;
        
        if($api_key && $api_secret && ( !$token || $force )) {
            $bearer_token_credential = $api_key . ':' . $api_secret;
            $credentials = base64_encode($bearer_token_credential);
            
            $args = array(
                'method' => 'POST',
                'sslverify' => false,
                'httpversion' => '1.1',
                'blocking' => true,
                'headers' => array( 
                    'Authorization' => 'Basic ' . $credentials,
                    'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'
                ),
                'body' => array( 'grant_type' => 'client_credentials' )
            );

            $response = wp_remote_post( 'https://api.twitter.com/oauth2/token', $args );

            if (is_wp_error($response))return $response;

            $keys = json_decode($response['body']);

            if ($response['response']['code'] != 200)
                return  new WP_Error('broke', 'Something is Wrong With the API keys');

            
            if(isset($keys->access_token)) {
                return $keys->access_token;
            }

            return  new WP_Error('broke', 'Something is Wrong With the API keys');
        }
    }

    public function twitter_request($api_url,$token){
        $args = array(
            'sslverify' => false,
            'httpversion' => '1.1',
            'blocking' => true,
            'headers' => array( 
                'Authorization' => "Bearer $token"
            )
        );
        return  wp_remote_get( $api_url, $args );
    }
}//end class
new tweets_by_hashtag();